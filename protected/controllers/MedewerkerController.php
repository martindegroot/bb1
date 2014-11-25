<?php

class MedewerkerController extends Controller
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($encodedRedirectUrl=null, $encodedRedirectLabel = null)
	{
        $this->layout='//layouts/column1';
        if(!Yii::app()->user->checkAccess('medewerker_create' ) )
        {
        throw new CHttpException(403,'403-13 U bent niet bevoegd om de actie "Nieuwe medewerker" uit te voeren.');
        }
        
        
        
		$medewerker=new Medewerker;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($medewerker);

		if(isset($_POST['Medewerker']))
		{
			$medewerker->attributes=$_POST['Medewerker'];
			if($medewerker->save()) {

            // create new User object and fill its properties 
            $user = new User();
            
            $user->medewerker_id = $medewerker->id;
            $user->role = $medewerker->role;
            $user->username = $medewerker->username;
            $user->password =  $user->hashPassword($user->username);

            $user->save(false);
            // Now add the authorization role to this new user:
            $auth = Yii::app()->authManager;
            $auth->assign($user->role, $user->id);

                
            $this->redirect(array('admin','id'=>$medewerker->id));
                
            }
		}

		$this->render('create',array(
			'model'=>$medewerker,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        $this->layout='//layouts/column1';
        if(!Yii::app()->user->checkAccess('medewerker_update' ) )
        {
        throw new CHttpException(403,'403-16 U bent niet bevoegd om de actie "Medewerker wijzigen" uit te voeren.');
        }
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Medewerker']))
		{
			$model->attributes=$_POST['Medewerker'];
			if($model->save()) {
                
               // $model->role kan gewijzigd zijn, daarom moet in tabel auth_assignment
               // dezelfde waarde geupdate worden voor het record waarvan de userid gelijk is
               // aan het user record dat als medewerker_id veld de waarde $model->id heeft
               //LET OP! de kolom user->role moet ook aangepast worden net als itemnate van tabel auth_assignment
               // gebruik nu de querybuilder om een update command te maken:
               $cmd = Yii::app()->db->createCommand();
               $numRecsAffected = $cmd->update(
                            'auth_assignment',
                            array('itemname' => $model->role,),
                            'userid=:userid',
                            array(':userid' => $model->user->id));  
               
               $numRecsAffected += 0; 
               $cmd->reset();
               $numRecsAffected = $cmd->update(
                    'user',
                    array('role' => $model->role,),
                    'id = :userid',
                    array(':userid' => $model->user->id));
                if(Yii::app()->user->checkAccess('medewerker_admin' ) ) 
               {
                 $this->redirect(array('admin','id'=>$model->id)); 
               }  
               else
               {
                   // role is no longer applicatiebeheerder, has to be budgetbeheerder
                   // redirect to startpage budgetbeheerder
                    $this->redirect(Yii::app()->createUrl('siteauthenticated/startbeheerder'));
               } 
            }
				
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
		$dataProvider=new CActiveDataProvider('Medewerker');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($encodedReturnUrl = null)
	{
        
        
        if(!Yii::app()->user->checkAccess('medewerker_admin' ) )
        {
        throw new CHttpException(403,'403-14 U bent niet bevoegd om de actie "Medewerkers beheren" uit te voeren.');
        }
        
		$model=new Medewerker('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Medewerker']))
			$model->attributes=$_GET['Medewerker'];

		$this->render('admin',array(
			'model'=>$model,
            'encodedReturnUrl' => $encodedReturnUrl,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Medewerker the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Medewerker::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Medewerker $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='medewerker-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
