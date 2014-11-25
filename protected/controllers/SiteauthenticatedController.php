<?php
class SiteauthenticatedController extends Controller
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
     * Displays a startpage for the logged in user with role budgetbeheerder
     * @param integer $id the ID of the model to be displayed
     */
    public function actionStartBeheerder()
    {
        if (    !( Yii::app()->user->checkAccess('budgetbeheerder' ))) 
        {
        throw new CHttpException(403,'U hebt niet de autorisatie "budgetbeheerder" die nodig is ' .
          'om de pagina "siteauthenticated/startbeheerder" te bekijken!' );
        }
        
        
        $this->layout = '//layouts/column1';
        $this->render('startbeheerder',array(
            
        ));
    }


     /**
     * Displays a startpage for the logged in user with role applicatiebeheerder
     * @param integer $id the ID of the model to be displayed
     */
    public function actionStartapplicatiebeheerder()
    {
        
        if (    !( Yii::app()->user->checkAccess('applicatiebeheerder' ))) 
        {
        throw new CHttpException(403,'U hebt niet de autorisatie "applicatiebeheerder" die nodig is ' .
          'om de pagina "siteauthenticated/startapplicatiebeheerder" te bekijken!' );
        }
        
        
        $this->layout = '//layouts/column1';
        $this->render('startapplicatiebeheerder',array(
            
        ));
    }
   
      /**
     * Displays a startpage for the logged in klant
     * @param integer $id the ID of the model to be displayed
     */
    public function actionStartKlant($klantnr)
    {
        $this->layout = '//layouts/column1';
        $klant = Klant::model()->with('user')->findByAttributes(array('klantnr' => $klantnr));
        $this->render('startklant',array(
             'klant' => $klant,
        ));
    }
   
    
    /**
     * Displays the klantcontact page
     */
    public function actionKlantContact($klantnr=null,$encodedReturnUrl=null)
    {
        if (is_null($klantnr))
        {
             throw new CHttpException(403,'403-99: Voor siteauthenticated/klantContact is de parameter klantnr verplicht');
        }
        $model=new KlantContactForm();
        $klant = Klant::model()->with('user')->findByAttributes(array('klantnr'=>$klantnr));
        if (is_null($klant))
        {
            throw new CHttpException(403,'403-98: Voor siteauthenticated/klantContact geen klant gevonden voor klantnr=' . $klantnr);
        }

         if(!is_null($encodedReturnUrl))
         {
             $decodedReturnUrl = base64_decode($encodedReturnUrl);
             Yii::app()->user->setReturnUrl($decodedReturnUrl);
         }
        
        $model->klantnaam = $klant->adresseernaam;
        $model->klantnr  = $klant->klantnr;
        $model->klantemail = $klant->email;
        
        if(isset($_POST['KlantContactForm']))
        {
            $model->attributes=$_POST['KlantContactForm'];
            if($model->validate())
            {
                $klantnaam='=?UTF-8?B?'.base64_encode($model->klantnaam).'?=';
                $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                
                // using swiftmailer

                require_once(Yii::app()->params['swiftmailerLib']);  
                
                //create the transport
                $transporter = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                    ->setUsername('bb1klantenservice@martiendegroot.eu')
                    ->setPassword('Bb1@234');
                
                $mailer = Swift_Mailer::newInstance($transporter);

                $myBody = "Onderwerp = " . $model->subject . "\r\n" .
                          "E-mail afzender = " . $model->klantemail . "\r\n" .
                          "Naam afzender = " . $model->klantnaam . "\r\n" .
                          "Klantnummer = " . $model->klantnr . "\r\n" .
                          "Bericht-inhoud :\r\n" . $model->body;
                
                $message = Swift_Message::newInstance($model->subject)
                    ->setFrom(array("mdegroot02@gmail.com" => "BB1-website-Contactformulier"))
                    ->setTo(array("mdegroot02@gmail.com" => "Martin de Groot"))
                    ->setBody($myBody)
                    ;
               // send the message
               $result =$mailer->send($message); 
                
                             
                if($result) {
                   Yii::app()->user->setFlash( "klantcontact", "Bedankt voor uw bericht, U krijgt binnen drie werkdagen antwoord.");
                }
                else {
                     $message = "Er is een fout opgetreden, uw bericht is helaas niet verzonden! " .
                                "De foutmelding luidt: " . $mailer->ErrorInfo;
                     Yii::app()->user->setFlash("klantcontact", $message);
                }
                $this->redirect(Yii::app()->user->returnUrl); 
                $this->refresh();
            }
        }
        $this->render("klantcontact", array("model" =>$model));
    }    
    
    
}  
?>
