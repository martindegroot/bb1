<?php
/* @var $this PdftxtbestandController */
/* @var $model Pdftxtbestand */

$this->breadcrumbs=array(
	'Pdftxtbestands'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pdftxtbestand', 'url'=>array('index')),
	array('label'=>'Manage Pdftxtbestand', 'url'=>array('admin')),
);
?>

<h1>Create Pdftxtbestand</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>