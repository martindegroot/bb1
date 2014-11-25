<?php

class RelatieController extends Controller
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the page indicated by $encodedReturnUrl.
	 */
	public function actionCreate($encodedReturnUrl, $encodedBreadcrumbsstr)
	{
	    BreadcrumbsBuilder::replacePlaceholder($encodedBreadcrumbsstr, 'relatie-admin-encodedBreadcrumbsstr');
        BreadcrumbsBuilder::replacePlaceholder($encodedReturnUrl, 'relatie-admin-encodedReturnUrl' );
        
        $this->layout='//layouts/column1';      
        
	    $model=new Relatie;
        $lastcode = TabelId::getLastUsedCode('relatie');
        $nextCode = TabelId::incrementCode($lastcode);
        $model->code = $nextCode;
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Relatie']))
		{
			$model->attributes=$_POST['Relatie'];
			if($model->validate())  {
                $model->save(false);
                // zet lastcode of tabel tabel_id record tabelnaam = 'relatie' to $nextCode
                TabelId::updateLastCode('relatie', $nextCode);
                
                $decodedReturnUrl = base64_decode($encodedReturnUrl);
                $this->redirect($decodedReturnUrl);                
            }
		}

		$this->render('create',array(
			'model'=>$model,
            'encodedReturnUrl' => $encodedReturnUrl,
            'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($code, $encodedReturnUrl, $encodedBreadcrumbsstr)
	{
        BreadcrumbsBuilder::replacePlaceholder($encodedBreadcrumbsstr, 'relatie-admin-encodedBreadcrumbsstr');
        BreadcrumbsBuilder::replacePlaceholder($encodedReturnUrl, 'relatie-admin-encodedReturnUrl' );
        
		$model=$this->loadModel($code);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Relatie']))
		{
			$model->attributes=$_POST['Relatie'];
			if($model->validate())  {
                $model->save(false);
                $decodedReturnUrl = base64_decode($encodedReturnUrl); 
                $this->redirect($decodedReturnUrl); 
                
            }
		}

		$this->render('update',array(
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
		$dataProvider=new CActiveDataProvider('Relatie');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($encodedBreadcrumbsstr)
	{
        if (is_null($encodedBreadcrumbsstr)) {
            throw new ErrorException('Call to RelatieController/actionAdmin requires ' .
                'a non-null parameter $encodedBreadcrumbsstr!') ;
        }

        if(!Yii::app()->user->checkAccess('relatie_admin' ) )
        {
            throw new CHttpException(403,'403-17 U bent niet bevoegd om de actie "Relaties beheren" uit te voeren.');
        }
        
		$model=new Relatie('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Relatie']))
			$model->attributes=$_GET['Relatie'];

		$this->render('admin',array(
			'model'=>$model,
            'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Relatie the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Relatie::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Relatie $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='relatie-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
