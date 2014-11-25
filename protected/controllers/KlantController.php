<?php

class KlantController extends Controller
{
    /*
      in plaats van model gebruik ik voor de duidelijkheid ook klant, bijv. in actionView
    */
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
		//	'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Displays a  Klant object.
	 * @param integer $id the ID of the object to be displayed
	 */
	public function actionView($id, $encodedRedirectLabel=null, $encodedRedirectUrl=null,
                               $encodedBreadcrumbsstr=null)
	{   
        if(is_null($encodedBreadcrumbsstr)) {
            throw new ErrorException('Call to KlantController/actionView requires' . 
                                    ' a non-null parameter $encodedBreadcrumbsstr!');
        }
        // 2013-12-28 alleen gebruiken voor ingelogde budgetbeheerder
        // Dit wordt een startpagina voor beheer van klant met id == invoerparameter $id
       
        $klant = Klant::model()->with('user')->findByPk($id);
        // 1 condition: 1) loggedinUser is beheerder
        if (    !( Yii::app()->user->checkAccess('budgetbeheerder' ))) 
        {
        throw new CHttpException(403,'403-06 U bent niet bevoegd om deze pagina te bekijken');
        }
        
        // als de parameters $encodedRedirectLabel en $encodedRedirectUrl null zijn, dan deze 
        // parameters zetten op route klant/admin  Klantgegevens beheren
        if (is_null($encodedRedirectLabel )) {
            $redirectLabel = 'Klantgegevens beheren';
            $encodedRedirectLabel = base64_encode($redirectLabel);
        }
        if (is_null($encodedRedirectUrl)) {
            $redirectUrl = Yii::app()->createUrl('klant/admin');
            $encodedRedirectUrl = base64_encode($redirectUrl);
        }

                
		$this->render('view',array(
			'klant'=>$klant,
            'encodedRedirectLabel' => $encodedRedirectLabel,
            'encodedRedirectUrl' => $encodedRedirectUrl,
            'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr,
		));
	}

    /**
     * Displays the Klant object which has value $klantnr for its property klantnr.
     * @param integer $klantnr the klantnr property of the object to be displayed
     */
    public function actionViewbyklantnr($klantnr, $encodedRedirectLabel=null, $encodedRedirectUrl=null)
    {
        // gebruik voor deze action's view page de eenkolom layout
        $this->layout = '//layouts/column1';
        // voor het geval dat de logged in user de role klant heeft toegekend gekregen
        // imoet gelden dat user->klantnr gelijk is aan klantnr attribuut van klant object met id == $id
        // als de user beheerder of admin role heeft dan zal user->klantnr == null zijn, dan mag deze user
        // ook de klant_view actie uitvoeren
        // de bovenstaande check zit in $klant->userBelongsToMe()
        $klant = Klant::model()->with('user')->findByAttributes(array('klantnr'=>$klantnr));
        // 2 conditions: 1) loggedinUser is beheerder/admin or is the user belonging to the klant
        //               2) de role of the loggedinUser has authorization for the operation klant_view
        if (    !( Yii::app()->user->checkAccess('klant_view' )
                    &&
                    $klant->userBelongsToMe()
                 )
           ) 
        {
        throw new CHttpException(403,'403-06 U bent niet bevoegd om deze pagina te bekijken');
        }

        // als de parameters $encodedRedirectLabel en $encodedRedirectUrl null zijn, dan deze 
        // parameters zetten op route klant/admin  Klantgegevens beheren
        if (is_null($encodedRedirectLabel )) {
            $redirectLabel = 'Klantgegevens beheren';
            $encodedRedirectLabel = base64_encode($redirectLabel);
        }
        if (is_null($encodedRedirectUrl)) {
            $redirectUrl = Yii::app()->createUrl('klant/admin');
            $encodedRedirectUrl = base64_encode($redirectUrl);
        }

                
        $this->render('_form_view_main',array(
            'klant'=>$klant,
            'encodedRedirectLabel' => $encodedRedirectLabel,
            'encodedRedirectUrl' => $encodedRedirectUrl,            
        ));
    }    
    
	/**
	 * Creates a new Klant model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($encodedReturnUrl=null,  
                                 $encodedBreadcrumbsstr = null)
    {
        if(is_null($encodedBreadcrumbsstr)) {
            throw new ErrorException('Call to KlantController/actionCreate requires '.
                                     'a non-null parameter $encodedBreadcrumbsstr!');
        }
        if(is_null($encodedReturnUrl)) {
            throw new ErrorException('Call to KlantController/actionCreate requires '.
                                     'a non-null parameter $encodedReturnUrl!');
        }
         $this->layout='//layouts/column1';
        if(!Yii::app()->user->checkAccess('klant_create' ) )
        {
        throw new CHttpException(403,'403-02 U bent niet bevoegd om deze pagina te bekijken.');
        }

        if(isset($_POST['page1']))
        {
           // We komen hier alleen via de terug button op _formpage2
           // dan ook input van _formpage2  valideren
          $model = new Klant('page2');
          
          $this->checkPageState($model, $_POST['Klant']);
          
          if ($model->validate())
          {
            $view = '_formpage1';
          }
          else
          {
              $view = '_formpage2';
          }
        }
        elseif(isset($_POST['page2']))
        { 
          $scenario = $_POST['page2'] == 'Verder' ? 'page1' : 'page3';  
          $model = new Klant($scenario);
          
          $this->checkPageState($model, $_POST['Klant']);
          if($model->validate())
          {
            $view = '_formpage2';
            $model->scenario = 'page2';
          }
          else
          {
            if ($_POST['page2'] == 'Verder')  // we kwamen hier vanaf pagina 1
            {
                $view = '_formpage1';
            }
            else // $_POST['page2] moet gelijk zijn aan 'Terug' we kwamen hier vanaf pagina 3
            {
                $view = '_formpage3';
            }
          }
        }
        else if(isset($_POST['page3']))
        {
            
          $scenario = $_POST['page3'] == 'Verder' ? 'page2' : 'page4';
          $model = new Klant($scenario);
         
          $this->checkPageState($model, $_POST['Klant']);
          if($model->validate())
          {
            $view = '_formpage3';
            $model->scenario = 'page3';
          }
          else
          {        
            if ($_POST['page3'] == 'Verder')  // we kwamen hier vanaf pagina 2
            {
                $view = '_formpage2';
            }
            else // $_POST['page3] moet gelijk zijn aan 'Terug' we kwamen hier vanaf pagina 4
            {
                $view = '_formpage4';
            }
            
          }
        }
        else if(isset($_POST['page4']))
        {
          $scenario = $_POST['page4'] == 'Verder' ? 'page3' : 'page5';            
          $model = new Klant($scenario);
          $this->checkPageState($model, $_POST['Klant']);
          if($model->validate())
          {
            $view = '_formpage4';
            $model->scenario = 'page4';
          }
          else
          {
            if ($_POST['page4'] == 'Verder')  // we kwamen hier vanaf pagina 3
            {
                $view = '_formpage3';
            }
            else // $_POST['page4] moet gelijk zijn aan 'Terug' we kwamen hier vanaf pagina 5
            {
                $view = '_formpage5';
                $model->setKlantnrToNextAvailableNr();
            }

          }
        } 
        else if(isset($_POST['page5']))
        {
          $scenario = $_POST['page5'] == 'Verder' ? 'page4' : 'page6';              
          $model = new Klant($scenario);
          $this->checkPageState($model, $_POST['Klant']);
          if($model->validate())
          {
            $view = '_formpage5';
            $model->setKlantnrToNextAvailableNr();
            $model->scenario = 'page5';
          }
          else
          {
            if ($_POST['page5'] == 'Verder')  // we kwamen hier vanaf pagina 4
            {
                $view = '_formpage4';
            }
            else // $_POST['page5] moet gelijk zijn aan 'Terug' we kwamen hier vanaf pagina 6
            {
                $view = '_formpage6';
            }

          }
        } 
         else if(isset($_POST['page6']))
        {
          $scenario = 'page5';   // we kunnen alleen via "verder"-button op pagina 5 hier gekomen zijn           
          $model = new Klant($scenario);
          $this->checkPageState($model, $_POST['Klant']);
          if($model->validate())
          {
            $view = '_formpage6';
          
            $model->scenario = 'page6';
          }
          else
          {
            // $_POST['page6'] kan alleen maar de waarde 'Verder'hebben
            $view = '_formpage5';
          }
        } 
       else if(isset($_POST['submit']))
        {
          $model = new Klant('page6');     // assuming page6 is the page on which the submit button is placed
          $model->attributes = $this->getPageState('page', array());
          $model->attributes = $_POST['Klant'];
          if($model->validate())
          {
            
            $model->save();
            // create new User object and fill its properties 
            $user = new User();
            $user->klantnr = $model->klantnr;
            $user->klant_id = $model->id;
            $user->role = 'klant';
            $user->username = 'klantnr_' . $model->klantnr;
            $user->password =  $user->hashPassword($user->username);

            $user->save(false);
            // Now add the authorization role == 'klant' to this new user:
            $auth = Yii::app()->authManager;
            $auth->assign('klant', $user->id);
            
            // create new BudgetKop object and fill the propery klantnr
            $budgetKop = new BudgetKop();
            $budgetKop->klant_id = $model->id;
            $validBudgetKop = $budgetKop->validate();
            if ($budgetKop->validate()) {
                 $budgetKop->save(false);
            }
                       
            $decodedReturnUrl = base64_decode($encodedReturnUrl);
            $this->redirect($decodedReturnUrl);
          }
          $view = '_formpage6';
        }
        else
        {
          $model = new Klant('page1');
        
          $view = '_formpage1';      
        }
        
        $this->render($view, array('model'=>$model,
                                   'encodedReturnUrl' => $encodedReturnUrl,                                  
                                   'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr,));
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id,
                                 $encodedReturnUrl,
                                 $encodedBreadcrumbsstr)
	{
        if(is_null($encodedReturnUrl)) {
            throw new ErrorException('Call to KlantController-actionUpdate requires a non-null' . 
                                     ' parameter $encodedReturnUrl!');
        }
        if(is_null($encodedBreadcrumbsstr)) {
            throw new ErrorException('Call to KlantController-actionUpdate requires a non-null' . 
                                     ' parameter $encodedBreadcrumbsstr!');
        }
        if(!Yii::app()->user->checkAccess('klant_update' ) )
        {
        throw new CHttpException(403,'403-05 U bent niet bevoegd om deze pagina te bekijken.');
        }
     BreadcrumbsBuilder::replacePlaceholder($encodedBreadcrumbsstr, 'klant-admin-encodedBreadcrumbsstr' );
     BreadcrumbsBuilder::replacePlaceholder($encodedReturnUrl, 'klant-admin-encodedReturnUrl');
        
        // vanwege de tabview wil ik de 1-column layout gebruiken:
        $this->layout='//layouts/column1';
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Klant']))
		{
			$model->attributes=$_POST['Klant'];
			if($model->save()) {
                $decodedReturnUrl = base64_decode($encodedReturnUrl);
                $this->redirect($decodedReturnUrl);
            }
				
		}

		$this->render('_form_update_main',array(
			'model'=>$model,
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
        if(!Yii::app()->user->checkAccess('klant_delete' ) )
        {
        throw new CHttpException(403,'403-03 U bent niet bevoegd om deze actie uit te voeren.');
        }
        
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($encodedRedirectLabel=null, $encodedRedirectUrl=null)
	{
        if(!Yii::app()->user->checkAccess('klant_index'))
        {
        throw new CHttpException(403,'403-04: U bent niet bevoegd om deze pagina te bekijken.');
        }
        
		$dataProvider=new CActiveDataProvider('Klant');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'encodedRedirectLabel' => $encodedRedirectLabel,
            'encodedRedirectUrl' => $encodedRedirectUrl,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($encodedBreadcrumbsstr=null)
	{
        if(is_null($encodedBreadcrumbsstr)) {
            throw new ErrorException('KlantController,actionAdmin requires a not-null parameter $encodedBreadcrumbstr!');
        }
        $this->layout='//layouts/column1';
        $message = '1. start of actionAdmin' ;
        Yii::trace($message, 'klantcontroller.actionadmin') ;
        if(!Yii::app()->user->checkAccess('klant_admin') )
        {
            throw new CHttpException(403,'403-01 U bent niet bevoegd om deze pagina te bekijken.');
        }
         
		$model = new Klant('search');
        $model->unsetAttributes();  // clear any default values
		if(isset($_GET['Klant']))
			$model->attributes=$_GET['Klant'];

		$this->render('admin',array(
			'model'=>$model,
            'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr,
		));
	}

    public function actionUpload() 
   {
        $dir = Yii::getPathOfAlias('application.uploads');
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
    
    
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Klant the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Klant::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Klant $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='klant-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
private function checkPageState(&$model, $data)
{
  $model->attributes = $this->getPageState('page',array());
  $model->attributes = $data;
  $this->setPageState('page', $model->attributes);
}    
    
}
