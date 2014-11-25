<?php
/* @var $this DossiertypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dossiertypes',
);

$this->menu=array(
	array('label'=>'Create Dossiertype', 'url'=>array('create')),
	array('label'=>'Manage Dossiertype', 'url'=>array('admin')),
);
?>

<h1>Dossiertypes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
