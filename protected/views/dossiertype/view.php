<?php
/* @var $this DossiertypeController */
/* @var $model Dossiertype */

$this->breadcrumbs=array(
	'Dossiertypes'=>array('index'),
	$model->code,
);

$this->menu=array(
	array('label'=>'List Dossiertype', 'url'=>array('index')),
	array('label'=>'Create Dossiertype', 'url'=>array('create')),
	array('label'=>'Update Dossiertype', 'url'=>array('update', 'id'=>$model->code)),
	array('label'=>'Delete Dossiertype', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->code),'confirm'=>'Weet u zeker dat u dit item wilt verwijderen?')),
	array('label'=>'Manage Dossiertype', 'url'=>array('admin')),
);
?>

<h1>View Dossiertype #<?php echo $model->code; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
         'volgorde',
		'code',
		'type',
		'subtype',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
