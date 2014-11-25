<?php

class DocumentController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        // attribuut tekstinhoud is base64_encoded opgeslagen
        // doe daarom eerst een base64_decode
//        $model->tekstinhoud = base64_decode($model->tekstinhoud);
        $this->render('view',array(
            'model'=> $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($encodedPdfPadNaam=null)
    {
        if (is_null($encodedPdfPadNaam))  {
            throw new ErrorException('Call to DocumentController/actionCreate requires a non-null ' .
                                     'input parameter $encodedPdfPadNaam!');
        }
        $padNaam = base64_decode($encodedPdfPadNaam);
        $bestandsNaam = basename($padNaam);
        $dirpdffiles = dirname($padNaam);
        $padNaamTxtFile = $dirpdffiles . "/" . basename($padNaam, '.pdf') . ".txt";
        $contentsTekstBestand = Utils::file_get_contents_utf8($padNaamTxtFile);
        
        $model=new Document;
        
        // zet zoveel mogelijk gegevens al in het form voordat het getoond wordt:
        // 1) scandatum:       
        $scanDatum = $this->getScandatumFromBestandsnaam($bestandsNaam);
        if (is_null($scanDatum)) {
            $scanDatum = date('Y-m-d');
        }
        $model->scandatumtijd = $scanDatum;
        
        // 2) padnaam
        $lastid = TabelId::getLastUsedId('document');  // remember, lastid in table tabel_id
                                                       // record with tabelnaam == 'document' has not yet been
                                                       // incremented
        $nextid = $lastid + 1;
        $model->id = $nextid;
        
        // make sure the correct subdirectories under pdffiles exist
       
        $strJaar = substr($scanDatum, 0, 4);
        $dirJaar = $dirpdffiles . "/" . $strJaar;
        if (!file_exists($dirJaar)) {
            mkdir($dirJaar);
        }
        $strMaand = substr($scanDatum, 5, 2);
        $dirMaand = $dirJaar . "/"  . $strMaand;
        if (!file_exists($dirMaand)) {
            mkdir($dirMaand);
        }
        $strDag = substr($scanDatum, 8, 2);
        $dirDag = $dirMaand . "/" . $strDag;
        if (!file_exists($dirDag)) {
            mkdir($dirDag);
        }
        $movedPadNaam = $dirDag . "/" . "doc_" . $nextid . ".pdf";
        $model->padnaam = $movedPadNaam;
        
        // 3) tekstinhoud
        
        $model->tekstinhoud = $contentsTekstBestand;
         
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Document']))
        {
            $model->attributes=$_POST['Document'];       
            if($model->dossiernr=='')
            {
                $model->dossiernr = null; // to prevent violation of foreignkey constraint
                                          // a null value is not checked as foreign key, an empty value is
                                          // checked.
            }
            
            // controleer dat $nextid == $model->id , zo niet maak $model->id gelijk aan $nextid
            // en maak dan ook $model->padnaam gelijk aan $movedPadNaam
            if($model->id != $nextid) {
                $model->id = $nextid;
                $model->padnaam = $movedPadNaam;
            }
            
            
            if($model->save())
            {
                // verplaats het bestand door de rename functie:
                rename($padNaam, $movedPadNaam);
                // zet lastid of tabel tabel_id record tabelnaam = 'document' to $nextid
                TabelId::updateLastId('document', $nextid);
                // verwijder het tekstbestand, dit zit nu in het veld tekstinhoud
                unlink($padNaamTxtFile);
                                
                $this->redirect(array('pdftxtbestand/admin'));
            }    
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    private function getScandatumFromBestandsnaam($bestandsnaam)    
    {
        // aanname: $bestandsnaam begint met lettertekens, gevolgd door _, daarna
        // gevolgd door de datum in format yyyymmdd
        // als geen geldige datum kan worden gevonden wordt null geretourneerd
        $pos_underscore = strpos($bestandsnaam, "_"); 
        $strJaar = substr($bestandsnaam, $pos_underscore + 1, 4);
        $strMaand = substr($bestandsnaam, $pos_underscore + 5, 2 )  ;
        $strDag = substr($bestandsnaam, $pos_underscore + 7, 2 );
        $intJaar = intval($strJaar);
        $intMaand = intval($strMaand);
        $intDag = intval($strDag);
        $isValidDate = checkdate($intMaand, $intDag, $intJaar);
        if ($isValidDate) {
            $result = $strJaar . "-" . $strMaand . "-" . $strDag;
        }
        else {
            $result = null;
        }
        return $result;
    }
    
    
    private function handlePdfAndTxtFiles($padNaam,
                                          $document)
    {
        // het pdfbestand $padnaam verplaatsen naar juiste subdirectory van protected/
        $dirpdffiles = dirname($padNaam);
        //bepaal de directory op grond van jaar, maand en dag van document->scandatum
        $scandatumtijd = $document->scandatumtijd;    // format 2014-04-05 16:21:00
        
        $yearstr = substr($scandatumtijd, 0, 4);
        $monthstr = substr($scandatumtijd, 5, 2);
        $daystr = substr($scandatumtijd, 8, 2 );
        $dirBasisnaam_Dir = $dirScans . "/" . $basisnaam . "_Dir" ;
        $fullHtmBasisBestandsnaam = $dirBasisnaam_Dir . "/" . $basisnaam;
        $fullHtmBestandsnaam = $fullHtmBasisBestandsnaam . "_Page1.htm";
        
        $fullTekstBestandsnaam = $dirScans . "/" . $basisnaam . ".txt";
        // throw an exception if one or both of these files don't exist
        $htmBestandExists = file_exists($fullHtmBestandsnaam);
        $tekstBestandExists = file_exists($fullTekstBestandsnaam);
        if (!$htmBestandExists)
        {
            throw new ErrorException('Bestand ' . $fullHtmBestandsnaam .'is niet aanwezig!');
        }
        if ( !$tekstBestandExists)
        {
            throw new ErrorException('Bestand ' . $fullTekstBestandsnaam .'is niet aanwezig!');
        }
        
        $contentsHtmBestand = file_get_contents($fullHtmBestandsnaam);
        $contentsTekstBestand = file_get_contents($fullTekstBestandsnaam);
        
        
        // remove first reference to the index file:
        $strTextToFind1 =   '<TD align="center" ><A href="../' .
                            $basisnaam .
                            '.htm" title="Toc">Index</A></TD>';
        $posIndexLine = strpos($contentsHtmBestand, $strTextToFind1);
        if(!($posIndexLine===false)) {           
            $contentsHtmBestand = substr_replace($contentsHtmBestand, '', $posIndexLine, strlen($strTextToFind1)) ;  
        }
        // remove second reference to index file:
        $strTextToFind2 =  '<A href="../' .
                                $basisnaam .
                                 '.htm" title="Toc">Index</A></TD>';
       
        $posIndexLine2 = strpos($contentsHtmBestand, $strTextToFind2);
        if(!($posIndexLine2===false)) {
            $haystack = substr($contentsHtmBestand, 0, $posIndexLine2);
            $strTextToFind3 = '<TD align="center"  char=';
            $posIndexLine3 = strrpos($haystack, $strTextToFind3);
            if (!($posIndexLine3===false)) {
                $fullTextToFind = substr($contentsHtmBestand, $posIndexLine3, $posIndexLine2 - $posIndexLine3) 
                                  . $strTextToFind2;
                $contentsHtmBestand = substr_replace($contentsHtmBestand, '', $posIndexLine3, strlen($fullTextToFind));
            }                        
        }
        // replace reference to .css file by reference to general scanhtm.css in css directory
        $textcssreference = $basisnaam . ".css";
        $posCssReference = strpos($contentsHtmBestand, $textcssreference);
        if(!($posCssReference===false)) {
            $generalcssreference = "../../../css/scan0000.css";           
            $contentsHtmBestand = substr_replace($contentsHtmBestand, $generalcssreference,
                                                $posCssReference, strlen($textcssreference)) ;  
        }
        $docId = $document->id;
        // nu nog eventueel aanwezige .gif bestanden naar kopieren naar protected/images_gif
        $dirImages_gif = Yii::getPathOfAlias('application.images_gif');

        $arrGifFiles = glob($dirBasisnaam_Dir . '/*.gif');
       
        if (count($arrGifFiles) > 0) { 
            // make sure the array has something in it
            foreach ($arrGifFiles as $aGifFile) {
        
                $fileName = basename($aGifFile, ".gif" );
                // determine  Picture nr
                $fileNameUntilEndPicture = $basisnaam . "_Picture";
                $startNr = strlen($fileNameUntilEndPicture);
                $pictureNr = substr($fileName, $startNr );
        
                $destinationFilename = "doc_" . $docId . "_" . $pictureNr . ".gif";
                $destinationFile = $dirImages_gif . "/" . $destinationFilename;
                $sourceFile = $aGifFile;
                copy($sourceFile, $destinationFile);
                // tekst in htm bestand aanpassen:
                $fileNameSourceFile = basename($aGifFile);
                $replaceFileNameSourceFile = "../../images_gif/" . $destinationFilename;
                // zoek pos start $fileNameSourceFile
                $posStartSourceFile = strpos($contentsHtmBestand, $fileNameSourceFile);
                $contentsHtmBestand = substr_replace($contentsHtmBestand,
                                                    $replaceFileNameSourceFile,
                                                    $posStartSourceFile,
                                                    strlen($fileNameSourceFile));
            }
        }
        
        $oldTitle = "<TITLE>Recognized HTML document</TITLE>";
        $newTitle  = "<TITLE>Documentnr " . $docId . " - " ;
        $newTitle .= $document->postdatum . " VAN ";
        if($document->van_naam == 'klant')  {
            $document->van_naam = $document->klant->getSorteernaam();
        }
        $newTitle .= $document->van_naam . " - AAN ";
        $newTitle .= $document->aan_naam . " - ONDERWERP. ";
        $newTitle .= $document->onderwerp;
        $newTitle .= "</TITLE>";
        $posOldTitle = strpos($contentsHtmBestand, $oldTitle);
        $contentsHtmBestand = substr_replace($contentsHtmBestand,
                                            $newTitle,
                                            $posOldTitle,
                                            strlen($oldTitle));
        // for testing try to save $contentHtmBestand to new file $fullHtmBestandsnaamChanged
        $dirDocument = Yii::getPathOfAlias('application.views.document');
        $fullHtmBestandsnaamChanged = $dirDocument . "/doc_" . $docId . ".htm";
         $fullTekstBestandsnaamChanged =  $dirDocument . "/doc_" . $docId . ".txt";
        file_put_contents($fullHtmBestandsnaamChanged, $contentsHtmBestand);
        file_put_contents($fullTekstBestandsnaamChanged, $contentsTekstBestand);
 
 // een test om te kijken of ik met een op internet gevonden php class de tekst zelf beter uit de html variabele
 // kan halen.
 
         // Include the class definition file.
         require_once('class.html2text.inc');
         
        // Instantiate a new instance of the class. Passing the string
        // variable automatically loads the HTML for you.
        $h2t = new html2text($contentsHtmBestand);
        $extractedTekst = $h2t->get_text();     
        $fullTekstBestandsnaamExtracted =  $dirDocument . "/doc_" . $docId . "_extracted.txt";
         file_put_contents($fullTekstBestandsnaamExtracted, $extractedTekst);
 
 
        
        // nu $contentsTekstBestand opslaan in $document
       
        // wijziging MdeGroot : sla nu als proef $extractedTekst op i.p.v. $contentsTekstBestand
        // en kijk wat er dan in de database tabel document, attribuut tekstinhoud opgeslagen wordt.
        //$document->tekstinhoud = $contentsTekstBestand;
        // de tekst in de database wordt nu afgekapt zodra het ö teken in Kröller er is
        // probeer base64_encode eerst toe te passen voor het opslaan, en dan in de view een decode toe te passen.
 //       $document->tekstinhoud = base64_encode($extractedTekst);
       $document->tekstinhoud = $extractedTekst;
        $document->save();
    }
    
    /**
     * Updates a particular document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Document']))
        {
            $model->attributes=$_POST['Document'];
            if ($model->dossiernr=='')
            {
                $model->dossiernr = null;
            }
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Document');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Document('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Document']))
            $model->attributes=$_GET['Document'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Document the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Document::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Document $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='document-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
