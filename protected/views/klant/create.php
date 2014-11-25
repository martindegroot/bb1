<?php
    // model = Klant
    // horizontale menu direct onder de header uit het layout template:
    $mb = new MenuBuilder();
    echo $mb->buildMenu(null, null);

    $this->breadcrumbs=array(
        'Mijn startpagina'=>array('siteauthenticated/startbeheerder'),
        'Klanten beheren' => array('klant/admin'),
        'Nieuwe klant',
    );
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
    ));
          


$this->menu=array(
	array('label'=>'List Klant', 'url'=>array('index')),
	array('label'=>'Manage Klant', 'url'=>array('admin')),
);
?>

<h1>Create Klant</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>