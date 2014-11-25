<?php
/* @var $this SiteController */
/* deze view file toont de output van de controller/action combinatie site/index */
$this->pageTitle=Yii::app()->name;
?>
<?php
     // kijk of flash-message passwordreset aanwezig is 
     // en zo ja toon de flash message
     if(Yii::app()->user->hasFlash('successPasswordReset')) : ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('successPasswordReset'); ?>
    </div>
    <?php endif; ?>
<?php
     // kijk of flash-message wwresetemailverstuurd aanwezig is 
     // en zo ja toon de flash message
     if(Yii::app()->user->hasFlash('wwresetemailverstuurd')) : ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('wwresetemailverstuurd'); ?>
    </div>
    <?php endif; ?>

<?php
    // horizontale menu:
    $mb = new MenuBuilder();
    echo $mb->buildMenu(null,null);  

    $loggedInUser = User::loggedInUser();
    if (is_null($loggedInUser)) {
        $roleLoggedInUser = 'bezoeker';
    }
    else {
       $roleLoggedInUser = $loggedInUser->role;  
    }
    
    switch ($roleLoggedInUser)  {
        case 'bezoeker':
            $this->breadcrumbs=array();      
            break;
        case 'klant':
            $this->breadcrumbs= array(
                'Mijn startpagina' => array('siteauthenticated/startklant', 
                                             'klantnr' => $loggedInUser->klantnr));
            break;
        case 'budgetbeheerder':
            $this->breadcrumbs=array(
                'Mijn startpagina'=>array('siteauthenticated/startbeheerder'));
            break;                                   
        case 'applicatiebeheerder':
            $this->breadcrumbs=array(
                'Mijn startpagina'=>array('siteauthenticated/startapplicatiebeheerder'));
            break;                                   
    }
    
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
    ));

?>

<h1></br>Welkom op de <i><?php echo CHtml::encode(Yii::app()->name); ?> van Martin de Groot</i></h1>
<?php if(!Yii::app()->user->isGuest):?>
<p>
   Uw vorige aanmelding was op <?php echo Yii::app()->user->lastLogin; ?>.  
</p>
<?php endif;?>
<p>Deze startpagina is nog voorlopig, hier wordt nog aan gewerkt.</p>
<div>
     <img src=<?php
               echo   Yii::app()->request->baseUrl.'/images/manage_16x16.png'                                                                                              
              ?>
               alt="Alt text voor manage picture">
</div>
