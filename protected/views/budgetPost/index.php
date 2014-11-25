<?php
/* @var $this BudgetPostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Budget Posts',
);

$this->menu=array(
	array('label'=>'Create BudgetPost', 'url'=>array('create')),
	array('label'=>'Manage BudgetPost', 'url'=>array('admin')),
);
?>

<h1>Budget Posts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
