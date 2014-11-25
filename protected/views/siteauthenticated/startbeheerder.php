<?php   
    $thisPageUrl = Yii::app()->createUrl('siteauthenticated/startbeheerder', array( ));
    $encodedReturnUrl = base64_encode($thisPageUrl);
          
    $mb = new MenuBuilder();
    echo $mb->buildMenu(null, null);
    $labelMijnStartpagina = 'Mijn startpagina';
    $urlMijnStartpagina = Yii::app()->createUrl('siteauthenticated/startbeheerder');
    
    $breadcrumbsArr[0] = $labelMijnStartpagina . "#" . $urlMijnStartpagina;
    $breadcrumbsstr = implode("!",$breadcrumbsArr);
    $encodedBreadcrumbsstr = base64_encode($breadcrumbsstr);
    
    $arrayBreadcrumbs = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr);
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$arrayBreadcrumbs,
    ));


?>
<?php if(Yii::app()->user->hasFlash('klantcontact')) : ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('klantcontact'); ?>
    </div>
<?php endif; ?>
<h6>&nbsp;</h6>
<?php
    // assume authorization has taken place, loggedinUser has role budgetbeheerder
    $loggedInUser = User::loggedInUser();

?>
 <h3>Startpagina voor budgetbeheerder <?php echo $loggedInUser->medewerker->naam?></h3>
 <?php if(Yii::app()->user->hasFlash('successWachtwoordGewijzigd')) : ?>
    <div class="flash-success">
        <h4><?php echo Yii::app()->user->getFlash('successWachtwoordGewijzigd'); ?></h4>
    </div>
<?php endif; ?>
<?php

    // 
    // menu-item voor pagina Klantgegevens beheren route == 'klant/admin'
//    $label = 'Klanten beheren';
//    $url =  Yii::app()->createUrl('klant/admin');
//    
//    $breadcrumbsArr[] = $label . "#" . $url;
    $breadcrumbsstr = implode("!",$breadcrumbsArr);
    $encodedBreadcrumbsstr = base64_encode($breadcrumbsstr);
    
    
    $menuItems[] = array('label' => 'Klanten beheren',
     'url' => Yii::app()->createUrl('klant/admin', array('encodedBreadcrumbsstr' => $encodedBreadcrumbsstr)  ));
    // menu-item voor wijzigen eigen wachtwoord van de ingelogde user met role budgetbeheerder
    $menuItems[] = array('label' => 'Mijn wachtwoord wijzigen', 'url' =>Yii::app()->createUrl(
                         'user/updatePassword',
                         array( 'id' => $loggedInUser->id,
                        'encodedReturnUrl' => $encodedReturnUrl,
                        'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr
                        )));
    echo $mb->buildVerticalMenu($menuItems);
?>
