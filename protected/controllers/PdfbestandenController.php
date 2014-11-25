<?php
Yii::import('application.vendors.*');
$currentIncludePath = get_include_path();
$vendorsDir = Yii::getPathOfAlias('application.vendors');
set_include_path($currentIncludePath . PATH_SEPARATOR . $vendorsDir) ;
$currentIncludePath2 = get_include_path();
//require_once('Zend/Pdf.php');
//require_once('Zend/Search/Lucene.php');

class PdfbestandenController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionListHtm()
	{
        $dir = Yii::getPathOfAlias('application') . '/../../scans';
        $globOut = glob($dir . '/*.htm');
        if (count($globOut) > 0) { // make sure the glob array has something in it
            $files = array();
            foreach ($globOut as $filename) {
                $files[] = $filename;
            }
            $message = null;
        } else {
            $message = 'Geen pdf bestanden gevonden.<br />';
            $files = null;  
        }        
		$this->render('list', array(
                              'files' => $files,
                              'message' => $message
        ));
	}

    public function actionListPdf()
    {
        $dir = Yii::getPathOfAlias('application') . '/pdffiles';
        $globOut = glob($dir . '/*.pdf');
        if (count($globOut) > 0) { // make sure the glob array has something in it
            $files = array();
            foreach ($globOut as $filename) {
                $files[] = $filename;
            }
            $message = null;
        } else {
            $message = 'Geen pdf bestanden gevonden.<br />';
            $files = null;  
        }        
        $this->render('list2', array(
                              'files' => $files,
                              'message' => $message
        ));
    }

    public function actionTest01()
    {
        $this->render('test01', array());

    }    

    public function actionTest02($pdfbestand=null)    
    {
        if(!is_null($pdfbestand))
        {
            $pdfbestand = base64_decode($pdfbestand);
            $file = $pdfbestand;
            //$file = Yii::getPathOfAlias('application') . '/pdffiles/' .$pdfbestand;
            if(!file_exists($file)) {
                $line = "<html>";
                $line .= "<body>";
                $line .= "<h5>Het bestand '" . basename($file) . "' is niet aanwezig!</h5>";
                $line .= "</body>";
                $line .= "</html>";
                echo $line;                
            }
            else {
               $filename = basename($file);
             
                header('Content-type: application/pdf');
                header('Content-Disposition: inline; filename="' . $filename . '"');
                header('Content-Transfer-Encoding: binary');
                header('Content-Length: ' . filesize($file));
                header('Accept-Ranges: bytes');
                 
                @readfile($file);               
            }

        } 
        else {
            $line = "<html>";
            $line .= "<body>";
            $line .= "<h5>PdfbestandenController/actionTest02 vereist een niet-null parameter pdfbestand!</h5>";
            $line .= "</body>";
            $line .= "</html>";
            echo $line;
        }     
    }
    
	public function actionUpload()
	{
        $dir = Yii::getPathOfAlias('application.pdffiles');
        $uploaded = false;
        
        $model = new Upload();
        
        if(isset($_POST['Upload']))
        {
            $model->attributes = $_POST['Upload'];
            $model->file=CUploadedFile::getInstance($model, 'file');
            if ($model->validate())
                $uploaded = $model->file->saveAs($dir.'/'.$model->file->getName());
        }
       
       $this->render('upload', array(
                                     'model' => $model,
                                     'uploaded' => $uploaded,
                                     'dir' => $dir,
        )); 
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}