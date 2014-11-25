<?php


      /* bepaal encodedredirecturl en geef deze mee als get parameter
         We willen terugkeren naar deze pagina klant/view id==
      */
    if ($klant->user->id == User::loggedInUser()->id)
    {
      $labelWachtwoord = "Mijn wachtwoord wijzigen";
      $labelGegevensBekijken = "Mijn gegevens bekijken";

    }
    /* als loggedInUser role budgetbeheerder heeft (eventueel via role admin , 
       dan ook menu optie maken voor wijzigen wachtwoord van de klant)*/
    elseif (Yii::app()->user->checkAccess('budgetbeheerder') )
    {
        $labelWachtwoord = "Wachtwoord wijzigen"  ;
        $labelGegevensBekijken = "Klantgegevens bekijken";

    }
    
    $thisPageUrl = Yii::app()->createUrl('siteauthenticated/startKlant', array('klantnr'=> $klant->klantnr, ));
    $encodedReturnUrl = base64_encode($thisPageUrl);
      
    //$menuItems = array();
    // menu-item voor terugkeer naar startpagina van klant, geen returnurl nodig
    $menuItems[0]['label'] =$labelGegevensBekijken;
    $menuItems[0]['url']  = Yii::app()->createUrl('klant/viewbyklantnr', array('klantnr'=>$klant->klantnr,));
    // menu-item voor updaten password , wel returnurl naar de startpagina
    $menuItems[1]['label'] = $labelWachtwoord;
    $menuItems[1]['url']   =   Yii::app()->createUrl('user/updatePassword', array( 'id'=>$klant->user->id,
                                                                                   'encodedReturnUrl' => $encodedReturnUrl  )); 
    // menu-item voor het versturen van een klantcontactformulier
    $menuItems[2]['label'] = 'Bericht versturen';
    $menuItems[2]['url'] = Yii::app()->createUrl('siteauthenticated/klantContact', array('klantnr' => $klant->klantnr,
                                                                                        'encodedReturnUrl' => $encodedReturnUrl ));
    $labelMijnStartpagina = 'Mijn startpagina';
    $urlMijnStartpagina = Yii::app()->createUrl('siteauthenticated/startklant',
                                                 array('klantnr' => $klant->klantnr));
    
    $breadcrumbsArr[0] = $labelMijnStartpagina . "#" . $urlMijnStartpagina;
    $breadcrumbsstr = implode("!",$breadcrumbsArr);
    $encodedBreadcrumbsstr = base64_encode($breadcrumbsstr);
    

                                                                                        
                                                                                        
                                                                                        
                                                                                        
    // menu-item voor Budgetposten beheren maken
    $menuItems[3]['label'] = 'Budget bekijken';
    $menuItems[3]['url'] = Yii::app()->createUrl(
        'budgetPost/admin',
        array('klantnr' => $klant->klantnr,
               'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr,
               'userIsKlant' => true, 
             )); 
                                                                                  
                                                                                        
                                                                                        
    $mb = new MenuBuilder();
    // build the array of menuItems which are to be added to the standard menu, 
    // specific for this page's menu.
    
    echo $mb->buildMenu(null, null);
    
    $this->breadcrumbs=array(
        'Mijn startpagina',
    );
    
    $breadcrumbsArr = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr);
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$breadcrumbsArr,
    ));
    
                                                                                                                             
?>
<?php if(Yii::app()->user->hasFlash('klantcontact')) : ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('klantcontact'); ?>
    </div>
<?php endif; ?>
<div>
<h6>&nbsp;</h6>

 <h3>Startpagina voor: <?php echo $klant->adresseernaam . ' (klantnr '. $klant->klantnr . ')'; ?></h3>
 <?php if(Yii::app()->user->hasFlash('successWachtwoordGewijzigd')) : ?>
    <div class="flash-success">
        <h4><?php echo Yii::app()->user->getFlash('successWachtwoordGewijzigd'); ?></h4>
    </div>
<?php endif; ?>
</div>
<?php
    // verticale menu maken:
    $mbv = new MenuBuilder();
    echo $mbv->buildVerticalMenu($menuItems);
?>
