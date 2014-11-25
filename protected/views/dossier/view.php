<?php
/* @var $this DossierController */
/* @var $model Dossier */

$this->breadcrumbs=array(
	'Dossiers'=>array('index'),
	$model->dossiernr,
);

$this->menu=array(
	array('label'=>'List Dossier', 'url'=>array('index')),
	array('label'=>'Create Dossier', 'url'=>array('create')),
	array('label'=>'Update Dossier', 'url'=>array('update', 'id'=>$model->dossiernr)),
	array('label'=>'Delete Dossier', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->dossiernr),'confirm'=>'Weet u zeker dat u dit item wilt verwijderen?')),
	array('label'=>'Manage Dossier', 'url'=>array('admin')),
);
?>

<h1>View Dossier #<?php echo $model->dossiernr; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'dossiernr',
		'klantnr',
		'dossiertype_code',
		'relatie_code',
		'volgnr',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
