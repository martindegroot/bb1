<?php
/* @var $this MedewerkerController */
/* @var $model Medewerker */

$this->breadcrumbs=array(
	'Medewerkers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Medewerkers beheren', 'url'=>array('admin')),
);
?>

<h1>Wijzigen medewerker met id = <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>