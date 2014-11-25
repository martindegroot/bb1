<?php
/* @var $this RelatieController */
/* @var $model Relatie */

$this->breadcrumbs=array(
	'Relaties'=>array('index'),
	$model->code,
);

$this->menu=array(
	array('label'=>'List Relatie', 'url'=>array('index')),
	array('label'=>'Create Relatie', 'url'=>array('create')),
	array('label'=>'Update Relatie', 'url'=>array('update', 'id'=>$model->code)),
	array('label'=>'Delete Relatie', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->code),'confirm'=>'Weet u zeker dat u dit item wilt verwijderen?')),
	array('label'=>'Manage Relatie', 'url'=>array('admin')),
);
?>

<h1>View Relatie #<?php echo $model->code; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'code',
		'naam',
		'naamregel2',
		'straathuisnr',
		'postcode',
		'woonplaats',
		'telefoonnr',
		'faxnr',
		'email',
		'bank_rek_nr',
		'omschrijving',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
