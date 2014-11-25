<?php
/* @var $this MedewerkerController */
/* @var $model Medewerker */

    // horizontale menu direct onder de header uit het layout template:
    $mb = new MenuBuilder();
    echo $mb->buildMenu(null, null);

    $this->breadcrumbs=array(
        'Mijn startpagina'=>array('siteauthenticated/startapplicatiebeheerder'),
        'Medewerkers beheren' => array('medewerker/admin'),
        'Nieuwe medewerker',
    );
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
    ));
          
?>

<h1>Gegevens voor nieuwe medewerker invoeren</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>