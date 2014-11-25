<?php
/* @var $this RelatieController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Relaties',
);

$this->menu=array(
	array('label'=>'Create Relatie', 'url'=>array('create')),
	array('label'=>'Manage Relatie', 'url'=>array('admin')),
);
?>

<h1>Relaties</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
