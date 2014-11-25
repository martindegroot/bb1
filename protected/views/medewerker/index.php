<?php
/* @var $this MedewerkerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Medewerkers',
);

$this->menu=array(
	array('label'=>'Create Medewerker', 'url'=>array('create')),
	array('label'=>'Manage Medewerker', 'url'=>array('admin')),
);
?>

<h1>Medewerkers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
