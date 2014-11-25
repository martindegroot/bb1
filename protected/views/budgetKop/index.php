<?php
/* @var $this BudgetKopController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Budget Kops',
);

$this->menu=array(
	array('label'=>'Create BudgetKop', 'url'=>array('create')),
	array('label'=>'Manage BudgetKop', 'url'=>array('admin')),
);
?>

<h1>Budget Kops</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
