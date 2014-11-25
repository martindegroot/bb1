<?php
/* @var $this KlantController */
/* @var $model Klant */

$this->breadcrumbs=array(
	'Klants'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Klant', 'url'=>array('index')),
	array('label'=>'Create Klant', 'url'=>array('create')),
	array('label'=>'View Klant', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Klant', 'url'=>array('admin')),
);
?>

<h1>Update Klant <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form_update_main', array('model'=>$model)); ?>
<?php /* echo $this->renderPartial('_form', array('model'=>$model)); */ ?>R