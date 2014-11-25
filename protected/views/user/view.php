<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Gebruikers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Lijst van gebruikers', 'url'=>array('index')),
	array('label'=>'Gegevens nieuwe gebruiker invoeren', 'url'=>array('create')),
	array('label'=>'Wijzigen gebruiker-gegevens', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Gebruiker-gegevens verwijderen', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Weet u zeker dat u dit item wilt verwijderen?')),
	array('label'=>'Gebruikers-gegevens beheren', 'url'=>array('admin')),
);
?>

<h3>Gegevens bekijken van gebruiker met id = #<?php echo $model->id; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'role',
		'klantnr',
		'last_login_time',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
