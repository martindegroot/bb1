<?php
/* @var $this DossierController */
/* @var $model Dossier */

$this->breadcrumbs=array(
	'Dossiers'=>array('index'),
	$model->dossiernr=>array('view','id'=>$model->dossiernr),
	'Update',
);

$this->menu=array(
	array('label'=>'List Dossier', 'url'=>array('index')),
	array('label'=>'Create Dossier', 'url'=>array('create')),
	array('label'=>'View Dossier', 'url'=>array('view', 'id'=>$model->dossiernr)),
	array('label'=>'Manage Dossier', 'url'=>array('admin')),
);
?>

<h1>Update Dossier <?php echo $model->dossiernr; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>