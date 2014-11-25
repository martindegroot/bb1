<?php

class PdftxtbestandController extends Controller
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
	public function actionView($encodedhtmfile)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Pdftxtbestand;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pdftxtbestand']))
		{
			$model->attributes=$_POST['Pdftxtbestand'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->filename));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

    public function actionToonpdfbestand($encodedpdfbestand=null)    
    {
        if(!is_null($encodedpdfbestand))
        {
            $pdfbestand = base64_decode($encodedpdfbestand);
            
            
            if(!file_exists($pdfbestand)) {
                $line = "<html>";
                $line .= "<body>";
                $line .= "<h5>Het bestand '" . basename($pdfbestand) . "' is niet aanwezig!</h5>";
                $line .= "</body>";
                $line .= "</html>";
                echo $line;                
            }
            else {
               $filename = basename($pdfbestand);
             
                header('Content-type: application/pdf');
                header('Content-Disposition: inline; filename="' . $filename . '"');
                header('Content-Transfer-Encoding: binary');
                header('Content-Length: ' . filesize($pdfbestand));
                header('Accept-Ranges: bytes');
                 
                @readfile($pdfbestand);               
            }

        } 
        else {
            $line = "<html>";
            $line .= "<body>";
            $line .= "<h5>PdftxtbestandController/actionToon vereist een niet-null parameter encodedpdfbestand!</h5>";
            $line .= "</body>";
            $line .= "</html>";
            echo $line;
        }     
    }
    
    
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pdftxtbestand']))
		{
			$model->attributes=$_POST['Pdftxtbestand'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->filename));
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
		$dataProvider=new CActiveDataProvider('Pdftxtbestand');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dir = Yii::getPathOfAlias('application.pdffiles');
		$globOut = glob($dir . '/*.pdf');
        Pdftxtbestand::emptyTable();
		if (count($globOut) > 0) { 
            // make sure the glob array has something in it
			$files = array();
			foreach ($globOut as $aFile) {
				$dirpPath = dirname($aFile);
				$fileName = basename($aFile);
				$objBestand = new Pdftxtbestand();
                $objBestand->dirpath = $dirpPath;
                $objBestand->filename = $fileName;
                $objBestand->save();
			}
		}
		
		$model=new Pdftxtbestand('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pdftxtbestand']))
			$model->attributes=$_GET['Pdftxtbestand'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pdftxtbestand the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pdftxtbestand::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Pdftxtbestand $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pdftxtbestand-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
