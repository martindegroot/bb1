<?php

class UserController extends Controller
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
	public function actionCreate()
	{
        if(!Yii::app()->user->checkAccess('user_create' ) )
        {
        throw new CHttpException(403,'403-08 U bent niet bevoegd om deze pagina te bekijken.');
        }
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
            if ($model->validate())
            {
                $model->password = $model->hashPassword($model->password);    
           
			    if($model->save(false))
				    $this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        if(!Yii::app()->user->checkAccess('user_update' ) )
        {
        throw new CHttpException(403,'403-11 U bent niet bevoegd om deze pagina te bekijken.');
        }
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
            if ($model->validate() )
            {
               if($model->save(false))
                  $this->redirect(array('view','id'=>$model->id));     
            }
		
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
    /**
     * Updates the password of the user with id == $id
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdatePassword($id, $encodedReturnUrl=null, $encodedBreadcrumbsstr=null)
    {    /* 
            Als de role van de loggedinuser == klant dan mag deze user alleen het wachtwoord wijzigen
            van zichzelf 
            Als de role van de loggedinuser == budgetbeheerder of admin dan mag de loggedinuser
            elk password updaten van een user die role klant heeft en als de role budgetbeheerder is
            ook het password van zichzelf
            alleen als de role van de loggedinuser == admin, dan mag het password van elke user geupdate worden
         */

         if (is_null($encodedBreadcrumbsstr)) {
             throw new ErrorException(
              'UserController/actionUpdatePassword requires a non-null parameter $encodedBreadcrumbsstr!');
         }
         
         if(!is_null($encodedReturnUrl))
         {
             $decodedReturnUrl = base64_decode($encodedReturnUrl);
             Yii::app()->user->setReturnUrl($decodedReturnUrl);
         }
         $model = User::model()->with('klant')->with('medewerker')->findByPk($id);
         
        if(!$model->allowLoggedInUserToUpdateMyPassword()) 
        {
        throw new CHttpException(403,'403-12 U bent niet bevoegd om deze pagina te bekijken.');
        }
                     
        $model->password = null;
        $model->password_repeat = null;
        $model->setScenario('updatePassword');
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
            if ($model->validate() )
            {
               $unhashedPassword = $model->password; 
               $model->password = $model->hashPassword($model->password);
               
               
                 
               if($model->save(false)){
                   // hier code om het nieuwe wachtwoord in een a-mail naar de klant te sturen
                   // als de user tenminste een klant is
                   
                   $msgSucces = 'Het gewijzigde wachtwoord is opgeslagen.';
                   
                       $klant = $model->klant;
                       $subject = 'Uw wachtwoord is gewijzigd';
                       if (!is_null($klant)) {
                            $toName = $klant->adresseernaam;                        
                       }
                       else {
                           if (is_null($model->medewerker))  {
                              $toName = 'Medewerker met gebruikersnaam = ' . $model->username;
                           }
                           else {
                               $toName =' Medewerker ' . $model->medewerker->naam;
                           }
                       }
                       
                       $klantEmailFilled = (!is_null($klant) && !is_null($klant->email)
                         && trim($klant->email) != '');
                       $medewerkerEmailFilled = (!is_null($model->medewerker) 
                                                 && !is_null($model->medewerker->email));
                       if ($klantEmailFilled)  {
                           $toEmail = $klant->email; 
                       }
                       elseif ($medewerkerEmailFilled)  {
                           $toEmail = $model->medewerker->email;
                       }
                       else {
                           $toEmail = 'mdegroot02@gmail.com';
                       }
                      
                       
                       $body = '';
                       if (!is_null($klant))  {
                           $loggedInUser = User::loggedInUser();
                           if (is_null( $loggedInUser->medewerker)) {
                              $gewijzigdDoor = 'uzelf'; 
                           }
                           else {
                               $gewijzigdDoor = $loggedInUser->medewerker->naam;
                           }
                           
                           // bericht aan klant:
                           $body .= 'Aan: ' . $klant->adresseernaam . "\r\n\r\n";
                           $body .= "Uw wachtwoord voor inloggen bij onze website is gewijzigd.\r\n";
                           $body .= "Het wachtwoord is gewijzigd door " . $gewijzigdDoor   . ".\r\n";
                           $body .= "Het gewijzigde wachtwoord is: " . $unhashedPassword . "\r\n\r\n";
                           
                           $body .= "Uw klantnummer is " . $klant->klantnr . ".\r\n";
                           $body .= "Uw gebruikersnaam voor aanmelden op de website is: " . $model->username . ".\r\n\r\n" ;
                           
                           $body .= "Met vriendelijke groet,\r\n\r\nBB1-website";
                       }
                       else {
                           // bericht aan medewerker met role budgetbeheerder of applicatiebeheerder
                           // bepaal wie het wachtwoord gewijzigd heeft
                           // dit is de loggedinuser
                           $loggedInUser = User::loggedInUser();
                           $naamLoggedInUser = $loggedInUser->medewerker->naam;
                           if ($loggedInUser->id == $model->id) {
                               $naamLoggedInUser = 'u';                       
                           } 
                           else {
                               $naamLoggedInUser = 'medewerker ' . $naamLoggedInUser;
                           }
                           $body .= 'Aan: ' . $toName .  "\r\n\r\n";
                           $body .= "Uw wachtwoord om in te loggen is gewijzigd door " .
                                      $naamLoggedInUser .".\r\n"; 
                           $body .= "Het gewijzigde wachtwoord is: " . $unhashedPassword . "\r\n\r\n";
                           $body .= "Met vriendelijke groet,\r\n\r\nBB1-website"; 
                       }
                
                        // using swiftmailer
                        // see "The Yii Book" by Larry Ullman chapter 20 
                        // section "Using Swift Mailer"
                        Yii::import('application.vendor.swiftmailer.lib.*');
                        spl_autoload_unregister(array('YiiBase', 'autoload'));
                        require_once 'swift_required.php';
                        spl_autoload_register(array('YiiBase', 'autoload'));
                
                
                       //create the transport
                       $transporter = Swift_SmtpTransport::newInstance('mail.martiendegroot.eu', 465, 'ssl')
                            ->setUsername('bb1klantenservice@martiendegroot.eu')
                            ->setPassword('Bb1@234');
                
                       $mailer = Swift_Mailer::newInstance($transporter);
                       $message = Swift_Message::newInstance($subject)
                            ->setFrom(array('bb1klantenservice@martiendegroot.eu' => 'BB1-website'))
                            ->setTo(array($toEmail => $toName))
                            ->setBody($body);
                        // send the message
                        $result =$mailer->send($message); 
                   
                        if($result) {
                            $msgSucces = "Het gewijzigde wachtwoord is opgeslagen en er is een e-mail " .
                                         "gestuurd naar het e-mail-adres: " . $toEmail . ".";
                        }                                                                    
                   
                   Yii::app()->user->setFlash('successWachtwoordGewijzigd',$msgSucces);
                   $this->redirect(Yii::app()->user->returnUrl); 
               }    
            }
        
        }

        $this->render('updatePassword',array(
            'model'=>$model,
            'encodedReturnUrl' =>$encodedReturnUrl,
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
        if(!Yii::app()->user->checkAccess('user_delete' ) )
        {
        throw new CHttpException(403,'403-09 U bent niet bevoegd om deze pagina te bekijken.');
        }
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
        if(!Yii::app()->user->checkAccess('user_index' ) )
        {
        throw new CHttpException(403,'403-10 U bent niet bevoegd om deze pagina te bekijken.');
        }
        
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    
    public function actionTest01($email)
    {
        // only run in debug mode
        $gezochteUser = User::getUserByEmail($email);
        if (is_null($gezochteUser)) {
            $userName = 'Email not found';
        }
        else {
            $userName = $gezochteUser->username;
        }
    }
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{       
        if(!Yii::app()->user->checkAccess('user_admin' ) )
        {
        throw new CHttpException(403,'403-07 U bent niet bevoegd om deze pagina te bekijken.');
        }
        
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
