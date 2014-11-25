<?php

class BudgetPostController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
	public function actionView($id, $encodedBreadcrumbsstr)
	{
        BreadcrumbsBuilder::replacePlaceholder($encodedBreadcrumbsstr,'budgetPost-admin-encodedBreadcrumbsstr');
        $budgetPost = $this->loadModel($id);
        $budgetKop = $budgetPost->budgetkop;
        $klant = $budgetKop->klant;
        
		$this->render('view',array(
			'model'=>$budgetPost,
            'budgetKop' => $budgetKop,
            'klant' => $klant,
            'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr,
		));
	}

	/**
	 * Maakt een nieuwe budgetpost. Een budgetpost wordt altijd gemaakt voor een bijbehorende budgetkop
     * waarvoor een budgetkop->id en een budgetkop->klantnr bestaan.
     * Klantnr bepaalt eenduidig de andere waarden, neem dit als verplichte input parameter 
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($klantnr=null,
                                 $encodedReturnUrl=null,
                                 $encodedBreadcrumbsstr=null)
	{
        if(is_null($klantnr))  {
            throw new ErrorException("Fout in aanroep BudgetPostController-actionCreate: klantnr argument mag niet null zijn!");
        }
        if (is_null($encodedBreadcrumbsstr)) 
        {                                                                   
            throw new ErrorException('Call to BudgetPostController/actionCreate requires "
                                     . "a non-null parameter $encodedBreadcrumbsstr!');
        }       
        if (is_null($encodedReturnUrl)) 
        {                                                                   
            throw new ErrorException('Call to BudgetPostController/actionCreate requires "
                                     . "a non-null parameter $encodedReturnUrl!');
        }  		$model=new BudgetPost;

        $klant = Klant::model()->findByAttributes(array('klantnr' => $klantnr));
        $budgetkop = $klant->budgetkop;
        $budgetKopId = $budgetkop->id;
        
        //vul columns budgetKop_id en budgetcat_ink_of_uitg
        $model->budgetcat_ink_of_uitg = 'U';
		$model->budgetkop_id = $budgetKopId; 
        $model->bedragpermaand = 0.00;
        $model->begin_datum = $budgetkop->begin_datum;
        $model->eind_datum = $budgetkop->eind_datum;
        
        // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BudgetPost']))
		{
			$model->attributes=$_POST['BudgetPost'];
            // copy dossiertype->volgorde to model->dossiertype_volgorde ($model is BudgetPost)
            $model->dossiertype_volgorde = $model->dossiertype->volgorde;

            if($model->validate()) {
                
                // negatieve bedragen in positieve omzetten en op twee decimalen afronden:
                $model->bedrag = round(abs($model->bedrag), 2);
            
               switch ($model->frequentie)
               {
                 case 'wekelijks':
                    $periodenPerMaand = (13.0/3.0);
                    break;
                 case 'twee-wekelijks':
                    $periodenPerMaand = (13.0/6.0);
                    break;    
                 case 'vier-wekelijks':
                    $periodenPerMaand = (13.0/12.0);
                    break;
                 case 'maandelijks':
                    $periodenPerMaand = 1.0;
                    break;  
                 case 'twee-maandelijks':
                    $periodenPerMaand = 0.5;
                    break;
                 case 'per kwartaal':
                     $periodenPerMaand = 1.0/3.0;
                     break; 
                 case 'half-jaarlijks':
                    $periodenPerMaand = 1.0/6.0;
                    break;
                 case 'jaarlijks':
                 case 'eenmalig':
                    $periodenPerMaand = 1.0/12.0;
                    break;  
                 default:
                    $periodenPerMaand = 0.000001;
                    break;
                  
               }
               
               $model->bedragpermaand = $model->bedrag * $periodenPerMaand; 
                
               // column budgetcat_ink_of_uitg zetten op basis van budgetcat_volgnrnaam:
               if ($model->budgetcat_volgnrnaam > '199z') {
                   $model->budgetcat_ink_of_uitg = 'U';
               }
               else {
                   $model->budgetcat_ink_of_uitg = 'I';
               }
                
               $model->save(false);
               $decodedReturnUrl = base64_decode($encodedReturnUrl);
			   $this->redirect($decodedReturnUrl);
		    } //END if($model->validate())


        } // END if(isset($_POST['BudgetPost']))
        $this->render('create',array(
            'model'=>$model,
            'klant'=> $klant,
            'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr,
            
        ));
    } // end of function actionCreate
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id,
                                $encodedReturnUrl=null,
                                $encodedBreadcrumbsstr=null)
	{
        $this->layout='//layouts/column1';
		$model=$this->loadModel($id);
        $budgetKop = $model->budgetkop;
        $klant = $budgetKop->klant;
        
        BreadcrumbsBuilder::replacePlaceholder($encodedReturnUrl, 'budgetPost-admin-encodedReturnUrl');
        BreadcrumbsBuilder::replacePlaceholder($encodedBreadcrumbsstr, 'budgetPost-admin-encodedBreadcrumbsstr');
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BudgetPost']))
		{
			$model->attributes=$_POST['BudgetPost'];

            // copy dossiertype->volgorde to model->dossiertype_volgorde ($model is BudgetPost)
            $model->dossiertype_volgorde = $model->dossiertype->volgorde;

			if($model->validate()) {
                
                // negatieve bedragen in positieve omzetten en op 2 decimalen afronden
                $model->bedrag = round(abs($model->bedrag), 2);
                  
                
               switch ($model->frequentie)
               {
                 case 'wekelijks':
                    $periodenPerMaand = (13.0/3.0);
                    break;
                 case 'twee-wekelijks':
                    $periodenPerMaand = (13.0/6.0);
                    break;    
                 case 'vier-wekelijks':
                    $periodenPerMaand = (13.0/12.0);
                    break;
                 case 'maandelijks':
                    $periodenPerMaand = 1.0;
                    break;  
                 case 'twee-maandelijks':
                    $periodenPerMaand = 0.5;
                    break;
                 case 'per kwartaal':
                     $periodenPerMaand = 1.0/3.0;
                     break; 
                 case 'half-jaarlijks':
                    $periodenPerMaand = 1.0/6.0;
                    break;
                 case 'jaarlijks':
                 case 'eenmalig':
                    $periodenPerMaand = 1.0/12.0;
                    break;  
                 default:
                    $periodenPerMaand = 0.000001;
                    break;
                  
               }
               
               $model->bedragpermaand = $model->bedrag * $periodenPerMaand; 
                
               // column budgetcat_ink_of_uitg zetten op basis van budgetcat_volgnrnaam:
               if ($model->budgetcat_volgnrnaam > '199z') {
                   $model->budgetcat_ink_of_uitg = 'U';
               }
               else {
                   $model->budgetcat_ink_of_uitg = 'I';
               }
                 
               $model->save(false);
               $decodedReturnUrl = base64_decode($encodedReturnUrl);
               $this->redirect($decodedReturnUrl); 
            }
				
		}

		$this->render('update',array(
			'model'=>$model,
            'budgetKop' => $budgetKop,
            'klant' => $klant,
            'encodedReturnUrl' => $encodedReturnUrl,
            'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr,
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
		$dataProvider=new CActiveDataProvider('BudgetPost');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Beheren van budgetposten, altijd gekoppeld aan een klantnr, als actionAdmin aangeroepen wordt
     * zonder geldig klantnr in de getparameters moet een exception geraised worden
     * op basis van klantnr eerst budgetkop opzoeken
	 */
	public function actionAdmin($klantnr=null, $encodedBreadcrumbsstr=null)
	{   
        $this->layout='//layouts/column1';
        if(is_null($klantnr))  {
            throw new ErrorException("Fout in aanroep BudgetPostController-actionAdmin: ". 
                                     "klantnr argument mag niet null zijn!");
        }
        if(is_null($encodedBreadcrumbsstr))  {
            throw new ErrorException("Fout in aanroep BudgetPostController-actionAdmin: " .
                                     "encodedBreadcrumbsstr argument mag niet null zijn!");
        }
        $klant = Klant::model()->findByAttributes(array('klantnr'=>$klantnr));
        // bepalen of de loggedin-user klant is:
        // Dit is zo als in het user object van de loggedin user attribuut klantnr een niet-null
        // waarde heeft die gelijk is aan $klant->klantnr
      
        $userIsKlant = User::loggedInUserHeeftKlantnr($klantnr);
        $budgetKop = BudgetKop::model()->findByAttributes(array('klant_id' => $klant->id));
        $budgetKopID = $budgetKop->id;
		$model=new BudgetPost('search');

		$model->unsetAttributes();  // clear any default values
        $model->budgetkop_id = $budgetKopID;
		if(isset($_GET['BudgetPost']))
			$model->attributes=$_GET['BudgetPost'];

        // bepaal totaal inkomsten, uitgaven en over_tekort 
        $query = 'SELECT SUM(bp.bedragpermaand) AS inkomsten '
              . ' FROM budget_post bp, dossiertype dt'
              . ' WHERE budgetkop_id = ' . $budgetKopID
             .  ' AND bp.dossiertype_code = dt.code'
              . " AND dt.type = 'Inkomsten'";
        $cmd = Yii::app()->db->createCommand($query);
        $inkomsten = $cmd->queryScalar();
        if(is_null($inkomsten)) {
            $inkomsten = 0.00;
        }
        $query = 'SELECT SUM(bp.bedragpermaand) AS uitgaven '
              . ' FROM budget_post bp, dossiertype dt'
              . ' WHERE bp.budgetkop_id = ' . $budgetKopID
              . ' AND bp.dossiertype_code = dt.code'
              . " AND ( (dt.type = 'Uitgaven')"
              . "       OR"
              . "       (dt.type = 'Schulden')"
              . "     )";
        $cmd = Yii::app()->db->createCommand($query);
        $uitgaven = $cmd->queryScalar();
        if(is_null($uitgaven)) {
            $uitgaven = 0.00;
        }
        $over_tekort = round($inkomsten - $uitgaven, 2 );
        if ($over_tekort >= 0) {
            $over_tekortTekst = "Over: &euro;" . $over_tekort;
        } 
        else {
            $over_tekortTekst = '<span class="tekort">Tekort: &euro;' . (-1* $over_tekort) . '</span>';
        }
          
            
		$this->render('admin',array(
			'model'=>$model,
            'budgetKop' => $budgetKop,
            'dossiertype' => $model->dossiertype,
            'klant' => $klant,
            'inkomsten' => $inkomsten,
            'uitgaven' => $uitgaven,
            'over_tekortTekst' => $over_tekortTekst,
            'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr,
            'userIsKlant' => $userIsKlant,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BudgetPost the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BudgetPost::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BudgetPost $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='budget-post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
