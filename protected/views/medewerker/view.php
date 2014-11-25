<?php
/* @var $this MedewerkerController */
/* @var $model Medewerker */

$this->breadcrumbs=array(
	'Medewerkers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Medewerker', 'url'=>array('index')),
	array('label'=>'Create Medewerker', 'url'=>array('create')),
	array('label'=>'Update Medewerker', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Medewerker', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Weet u zeker dat u dit item wilt verwijderen?')),
	array('label'=>'Manage Medewerker', 'url'=>array('admin')),
);
?>

<h1>View Medewerker #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'naam',
		'email',
	),
)); ?>
