<?php
/*
    Als de klant details bekeken worden door de user van de klant dan moet de menu-optie / route user/updatePassword/id/NNuser_id 
    actief zijn. De voorwaarde is $klant->user->id  == $loggedInUser->id
    Hiervoor moet $klant als variabele vanuit de klantController beschikbaar zijn, en moet het user-object via
    eager loading geladen zijn bij het laden van $klant
*/

      /* bepaal encodedredirecturl en geef deze mee als get parameter
         We willen terugkeren naar deze pagina klant/view id==
      */
    // als klant net aangemaakt is door budgetbeheerder is er tot nu toe (2013-11-07) nog geen user aangemaakt
    // dan is $klant->user == null en kan er geen user->id worden opgevraagd.
    // voorlopig oplossen door eerst te checken of $klant->user ongelijk null is
    // later meteen bij aanmaken klant ook user maken met username == 'klantnr_NNN' waarin NNN het klantnr voorstelt,
    // wachtwoord ook gelijk maken aan klantnr_NNN, en bij inloggen van de klant met dit wachtwoord ervoor zorgen
    // dat de klant het wachtwoord moet wijzigen in iets dat ongelijk is aan klantnr_NNN
    if ( !is_null($klant->user) && ($klant->user->id == User::loggedInUser()->id)     )
    {
      $label = "Mijn wachtwoord wijzigen";
    }
    /* als loggedInUser role budgetbeheerder heeft (eventueel via role admin , 
       dan ook menu optie maken voor wijzigen wachtwoord van de klant)*/
    elseif (Yii::app()->user->checkAccess('budgetbeheerder') )
    {
        $label = "Wachtwoord wijzigen"  ;
    }
          
    //$menuItems = array();
    // menu-item voor terugkeer naar startpagina van klant
    $menuItems[0]['label'] = 'Mijn startpagina';
    $menuItems[0]['url']  = Yii::app()->createUrl('siteauthenticated/startKlant', array('klantnr'=> $klant->klantnr, ));
    // menu-item voor updaten password
    // menu-item wachtwoord wijzigen alleen tonen als $klant->user al bestaat, d.w.z. ongelijk null is
    if(!is_null($klant->user))
     {   
    $menuItems[1]['label'] = $label;
    $menuItems[1]['url']   =   Yii::app()->createUrl('user/updatePassword', array( 'id'=>$klant->user->id,
                                                                                   'encodedRedirectUrl' => $encodedRedirectUrl  ));                                                           
    }
    $mb = new MenuBuilder();
    // build the array of menuItems which are to be added to the standard menu, 
    // specific for this page's menu.
    
    echo $mb->buildMenu($encodedRedirectLabel, $encodedRedirectUrl);

    $loggedInUser = User::loggedInUser();
    if (is_null($loggedInUser)) {
        $roleLoggedInUser = 'bezoeker';
    }
    else {
       $roleLoggedInUser = $loggedInUser->role;  
    }
    
    switch ($roleLoggedInUser)  {
        case 'klant':
            $this->breadcrumbs= array(
                'Mijn startpagina' => array('siteauthenticated/startklant', 
                                             'klantnr' => $loggedInUser->klantnr),
                'Mijn gegevens bekijken',
            );
            break;
        case 'budgetbeheerder':
            $this->breadcrumbs=array(
                'Mijn startpagina'=>array('siteauthenticated/startbeheerder'),
                'Klanten beheren' => array('klant/admin'),
                'Bekijken gegevens klantnr ' .  $klant->klantnr,
           );     
            break;                                   
    }    
    
//    $this->breadcrumbs=array(
//        'Mijn startpagina'=>array('siteauthenticated/startbeheerder'),
//        'Klantgegevens beheren' => array('klant/admin'),
//        'Bekijken gegevens klantnr ' .  $klant->klantnr,
//    );
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
    ));                                                           
?>

<?php if(Yii::app()->user->hasFlash('successWachtwoordGewijzigd')) : ?>
    <div class="flash-success">
        <h4><?php echo Yii::app()->user->getFlash('successWachtwoordGewijzigd'); ?></h4>
    </div>
<?php endif; ?>
<?php  if(isset($skipHeader) && $skipHeader) : ?>
<h4>Gegevens bekijken</h4>    
<?php  else:  ?>    
 </br><h3>Gegevens van <?php
  echo $klant->adresseernaam; 
  ?> (klantnr = <?php echo $klant->klantnr; ?>)</h3>   
<?php endif;  ?>


<div class="form">

 

 
<?php  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'klant-form-update',
	'enableAjaxValidation'=>false,
));  ?>

 <?php
    $activeTab = 0;
        
    $tabs = array();
    
    $tabs['Persoon&nbsp;1']  = array(
         'id' => 'tab1_persoon1',
         'content' => $this->renderPartial('application.views.klant._form_view_tab1', array(
                     'form'  => $form,
                     'klant' => $klant,
         ),
         true),          
    );

    $tabs['Persoon&nbsp;2']  = array(
         'id' => 'tab2_persoon2',
         'content' => $this->renderPartial('application.views.klant._form_view_tab2', array(
                     'form'  => $form,
                     'klant' => $klant,
         ),
         true),          
    );
    

   $tabs['Contactgegevens']  = array(
         'id' => 'tab3_contactgegevens',
         'content' => $this->renderPartial('application.views.klant._form_view_tab3', array(
                     'form'  => $form,
                     'klant' => $klant,
         ),
         true),          
    );
    
    $tabs['Overige&nbsp;gegevens']  = array(
         'id' => 'tab4_overige',
         'content' => $this->renderPartial('application.views.klant._form_view_tab4', array(
                     'form'  => $form,
                     'klant' => $klant,
         ),
         true),          
    );

    
    $this->widget('zii.widgets.jui.CJuiTabs', array(  
            'tabs' => $tabs, 
            'options' => array( 
                    'collapsible' => false, 
                    'active' => $activeTab,    //zero based index to set active tab on rendering
            ), 
    ));     
    
    
?>

	<div class="row buttons">
		<?php /* echo CHtml::submitButton('Opslaan', array('name' => 'page1')); */ ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->