<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php' test git added some words
        // added a third comment line in actionIndex of SiteController
         
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';                
                
                
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
                //create the transport
//                $transporter = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
//                      ->setUsername('mdegroot02@gmail.com')
//                      ->setPassword('zwa98hjk');
                
                $mailer = Swift_Mailer::newInstance($transporter);

                $myBody = '<b>Onderwerp = ' . $model->subject . "</b><br>\r\n" .
                          '<b>E-mail afzender = ' . $model->email . "</b><br>\r\n" .
                          '<b>Naam afzender = ' . $model->name . "</b><br>\r\n" .
                          "<b>Bericht-inhoud :</b><br>\r\n" . $model->body;
                
                $message = Swift_Message::newInstance($model->subject)
                    ->setFrom(array($model->email => 'BB1-website-Contactformulier'))
                    ->setTo(array('bb1klantenservice@martiendegroot.eu' => 'BB1 Klantenservice'))
                    ->setBody($myBody, 'text/html')
                    ;
               // send the message
               $result =$mailer->send($message); 
                
                             
                if($result) {
                   Yii::app()->user->setFlash('contact','Bedankt voor uw bericht.'); 
                }
                else {
                     $message = 'Er is een fout opgetreden, uw bericht is helaas niet verzonden! ' .
                                'De foutmelding luidt: ' . $mailer->ErrorInfo;
                     Yii::app()->user->setFlash('contact', $message); 
                }
				
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
            // how to test which of the two submitbuttons was clicked?
            if (isset($_POST['wwvergetenbutton']))
            {
               $this->redirect(Yii::app()->createUrl('site/wachtwoordVergeten'));
            }
            // if we're here, the inlogbutton was clicked
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
            {
               $loggedInUser = User::loggedInUser();
               $klantnr = $loggedInUser->klantnr;
               if (is_null($klantnr)) 
               {
                   switch ($loggedInUser->role)
                   {
                     case 'budgetbeheerder' :
                        $this->redirect(Yii::app()->createUrl('siteauthenticated/startbeheerder'));
                        break;
                     case 'applicatiebeheerder' :
                        $this->redirect(Yii::app()->createUrl('siteauthenticated/startapplicatiebeheerder'));   
                        break;
                   }
               }
               else
               {
                    // nu redirect naar de startpagina voor de klant
                    $returnUrl = Yii::app()->createUrl('siteauthenticated/startklant',
                                                       array('klantnr' => $klantnr));
                 $this->redirect($returnUrl);                                            
               }
            }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

    /**
     * Displays the wachtwoordvergeten page
     */
    public function actionWachtwoordVergeten()
    {
        $model=new UsersEmailForm();

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='users-email-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['UsersEmailForm']))
        {

            $model->attributes=$_POST['UsersEmailForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate())
            {
                // determine column values for record to be inserted in table password_reset
                $userWithEmail = User::getUserByEmail($model->email);
                $user_id = $userWithEmail->id;
                $authorizationcode = Utils::guid();
                 $expire_dt = new DateTime('now');
                 // expire_dt zetten op drie uur na nu door 3 uur erbij te tellen
                 $expire_dt->add(new DateInterval('PT3H'));
                 $expire_dt_string = $expire_dt->format('Y-m-d H:i:s'); 
                 
                 // record in tabel password_reset aanmaken
                 // eerst eventueel aanwezig record met zelfde user_id primary key deleten
                $sql = "DELETE FROM password_reset WHERE user_id = "
                        . $user_id;
                $cmd = Yii::app()->db->createCommand($sql);
                $cmd->execute();                    
                // nieuw record aanmaken:                 
                $sql =  "INSERT INTO password_reset (user_id, authorizationcode, expire_dt) VALUES("
                        . $user_id . " , '" 
                        . $authorizationcode . "', '" 
                        . $expire_dt_string. "')";
                $cmd = Yii::app()->db->createCommand($sql);
                $cmd->execute();                    
                 // link tekst aanmaken
                 $linkTekst = Yii::app()->createAbsoluteUrl(
                     'site/passwordReset',
                     array('authorizationCode' => $authorizationcode));
                 // I have just now tested that the linktekst works correctly by copying the linktekst
                 // from the debugger session straight into the address bar of the browser, and it works correctly!
                 // next step is creating the e-mail with the linktekst and sending it to the e-mail address    
                 // e-mail bericht met daarin de link-tekst aanmaken
                 
               $subject = 'Wachtwoord vergeten voor inloggen op de BB1 website';
               if (!is_null($userWithEmail->klant)) {
                    $toName = $userWithEmail->klant->adresseernaam;                        
               }
               else {
                    // assumed: a User object has either a non-null klant object or a non-null medewerker object
                    // a medewerker object has a non-null attribute naam
                    $toName = $userWithEmail->medewerker->naam;
               }
               $toEmail = $model->email;        
               $body = '';
               $body .= 'Aan: ' . $toName .  "\r\n\r\n";
               $body .= "Met onderstaande link kunt u op onze website een nieuw wachtwoord opgeven.\r\n\r\n";
               $body .= $linkTekst . "\r\n\r\n";
               $body .= "Als klikken op de bovenstaande link niet werkt kunt u de tekst kopiëren en daarna ";
               $body .= "in de adresbalk van uw internet browser plakken.\r\n\r\n";
               
               $body .= "Met vriendelijke groet,\r\n\r\nBB1-website";
                
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
                    ->setFrom(array('bb1klantenservice@martiendegroot.eu' => 'Klantenservice BB1'))
                    ->setTo(array($toEmail => $toName))
                    ->setBody($body);
                // send the message
                $result =$mailer->send($message); 
                // flash message zetten om gebruiker te melden dat de e-mail verstuurd is
                 
                $msgFlash = "Er is een e-mail verstuurd naar het e-mail adres '";
                $msgFlash .= $model->email . "' met een link om een nieuw wachtwoord op te geven.";
                Yii::app()->user->setFlash('wwresetemailverstuurd',$msgFlash);
                $this->redirect(Yii::app()->createUrl('site/index')); 
            }
        }
        // display the UsersEmailForm form
        $this->render('wachtwoordvergeten',array('model'=>$model));
    }    
    
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
    
    /**
    * Action which allows a user who has forgotten his password to set a new password
    * The url for this route has been sent to the user in an e-mail and it contains the 
    * get parameter authorizationCode
    * 
    * @param string authorizationCode
    * 
    */
    public function actionPasswordReset($authorizationCode=null)
    {
        $errorRedirectUrl = Yii::app()->createUrl('site/index');
        if (is_null($authorizationCode)) {        
            $this->redirect($errorRedirectUrl);
        } 
        // when we are here, $authorizationCode has a non-null value
        // try to retrieve a record from table password_reset based on the authorizationcode
        // if a record is not found, redirect to $redirectUrl (site/index) 
        // if a record is found, display a form for the user to enter a new password and password repeat
         $sql = "SELECT user_id, expire_dt FROM password_reset " .
                " WHERE authorizationcode = '" . $authorizationCode ."'";  
         $cmd = Yii::app()->db->createCommand($sql);
         $row = $cmd->queryRow(); 
         // $row will be the boolean false if no row was found
         if(!$row)  {
              $this->redirect($errorRedirectUrl);
         }
         // when we're here a row is found
         $user_id = $row['user_id'];
         $expire_dt = $row['expire_dt'];
         $dummy = 0;
         // if current datetime is after expire_dt, redirect to $errorRedirectUrl
         $nowString = date("Y-m-d H:i:s");
         if ($nowString >= $expire_dt)  {
             // it is now at or after the expire_datetime
             $this->redirect($errorRedirectUrl);        
         }
         // when we're here, we have the user and the time has not yet expired 
         // for the user to reset his password   
         $model = User::model()->with('klant')->with('medewerker')->findByPk($user_id);
         // maak het password veld leeg
         $model->password = null;
         
         $model->password_repeat = null;
        $model->setScenario('updatePassword');
         
         // display the login form

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
                   
                   $msgSucces = 'Het nieuwe wachtwoord is opgeslagen.';
                   
                       $klant = $model->klant;
                       $subject = 'Uw heeft een nieuw wachtwoord opgegeven';
                       if (!is_null($klant)) {
                            $toName = $klant->adresseernaam;                        
                       }
                       else {
                           if (is_null($model->medewerker))  {
                              $toName = 'Medewerker met gebruikersnaam = ' . $model->username;
                           }
                           else {
                               $toName = $model->medewerker->naam;
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
                           // bericht aan klant:
                           $body .= 'Aan: ' . $klant->adresseernaam . "\r\n\r\n";
                           $body .= "U heeft op onze website een nieuw wachtwoord opgegeven.\r\n";
                           $body .= "Het nieuwe wachtwoord is: " . $unhashedPassword . "\r\n\r\n";
                           
                           $body .= "Uw klantnummer is " . $klant->klantnr . ".\r\n";
                           $body .= "Uw gebruikersnaam voor aanmelden op de website is: " . $model->username . ".\r\n\r\n" ;
                           
                           $body .= "Met vriendelijke groet,\r\n\r\nBB1-website";
                       }
                       else {
                           // bericht aan medewerker met role budgetbeheerder of applicatiebeheerder
                           // bepaal wie het wachtwoord gewijzigd heeft
                           // dit is de loggedinuser
                           $body .= 'Aan: ' . $toName .  "\r\n\r\n";
                           $body .= "U heeft een nieuw wachtwoord opgegeven om in te loggen op onze website.\r\n"; 
                           $body .= "Het nieuwe wachtwoord is: " . $unhashedPassword . "\r\n\r\n";
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
                            ->setFrom(array('bb1klantenservice@martiendegroot.eu' => 'Klantenservice BB1'))
                            ->setTo(array($toEmail => $toName))
                            ->setBody($body);
                        // send the message
                        $result =$mailer->send($message); 
                   
                        if($result) {
                            $msgFlash = "Het nieuwe wachtwoord is opgeslagen. U kunt nu inloggen met uw nieuwe "
                            . "wachtwoord. Er is ook een e-mail met uw inloggegevens " .
                                         "gestuurd naar het e-mail-adres: " . $toEmail . ".";
                        }                                                                    
                   
                   Yii::app()->user->setFlash('successPasswordReset',$msgFlash);
                   $this->redirect(Yii::app()->user->returnUrl); 
               }    
            }
        }   
                 
         
         
        $this->render('resetPassword',array('model'=>$model));
    }
}