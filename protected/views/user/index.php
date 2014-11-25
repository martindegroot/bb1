<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gebruikers',
);

$this->menu=array(
	array('label'=>'Gegevens nieuwe gebruiker invoeren', 'url'=>array('create')),
	array('label'=>'Gebruikers-gegevens beheren', 'url'=>array('admin')),
);
?>

<h1>Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
