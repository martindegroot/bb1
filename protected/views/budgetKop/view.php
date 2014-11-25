<?php
/* @var $this BudgetKopController */
/* @var $model BudgetKop */

$this->breadcrumbs=array(
	'Budget Kops'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BudgetKop', 'url'=>array('index')),
	array('label'=>'Create BudgetKop', 'url'=>array('create')),
	array('label'=>'Update BudgetKop', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BudgetKop', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Weet u zeker dat u dit item wilt verwijderen?')),
	array('label'=>'Manage BudgetKop', 'url'=>array('admin')),
);
?>

<h1>View BudgetKop #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'klantnr',
		'begin_datum',
		'eind_datum',
		'beginsaldo',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
