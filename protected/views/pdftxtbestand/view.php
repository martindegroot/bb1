<?php
/* @var $this PdftxtbestandController */
/* @var $model Pdftxtbestand */

$this->breadcrumbs=array(
	'Pdftxtbestands'=>array('index'),
	$model->filename,
);

$this->menu=array(
	array('label'=>'List Pdftxtbestand', 'url'=>array('index')),
	array('label'=>'Create Pdftxtbestand', 'url'=>array('create')),
	array('label'=>'Update Pdftxtbestand', 'url'=>array('update', 'id'=>$model->filename)),
	array('label'=>'Delete Pdftxtbestand', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->filename),'confirm'=>'Weet u zeker dat u dit item wilt verwijderen?')),
	array('label'=>'Manage Pdftxtbestand', 'url'=>array('admin')),
);
?>

<h1>View Pdftxtbestand #<?php echo $model->filename; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'dirpath',
		'filename',
	),
)); ?>
