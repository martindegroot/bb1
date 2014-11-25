<?php
/* @var $this PdftxtbestandController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pdftxtbestands',
);

$this->menu=array(
	array('label'=>'Create Pdftxtbestand', 'url'=>array('create')),
	array('label'=>'Manage Pdftxtbestand', 'url'=>array('admin')),
);
?>

<h1>Pdftxtbestands</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
