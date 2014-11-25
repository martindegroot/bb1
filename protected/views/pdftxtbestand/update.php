<?php
/* @var $this PdftxtbestandController */
/* @var $model Pdftxtbestand */

$this->breadcrumbs=array(
	'Pdftxtbestands'=>array('index'),
	$model->filename=>array('view','id'=>$model->filename),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pdftxtbestand', 'url'=>array('index')),
	array('label'=>'Create Pdftxtbestand', 'url'=>array('create')),
	array('label'=>'View Pdftxtbestand', 'url'=>array('view', 'id'=>$model->filename)),
	array('label'=>'Manage Pdftxtbestand', 'url'=>array('admin')),
);
?>

<h1>Update Pdftxtbestand <?php echo $model->filename; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>