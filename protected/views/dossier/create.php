<?php
/* @var $this DossierController */
/* @var $model Dossier */

$this->breadcrumbs=array(
	'Dossiers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Dossier', 'url'=>array('index')),
	array('label'=>'Manage Dossier', 'url'=>array('admin')),
);
?>

<h1>Create Dossier</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>