<?php
/* @var $this BudgetKopController */
/* @var $model BudgetKop */

$this->breadcrumbs=array(
	'Budget Kops'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BudgetKop', 'url'=>array('index')),
	array('label'=>'Manage BudgetKop', 'url'=>array('admin')),
);
?>

<h1>Create BudgetKop</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>