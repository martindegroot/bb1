<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Gebruikers'=>array('index'),
	'Beheren',
);

$this->menu=array(
	array('label'=>'Lijst van gebruikers', 'url'=>array('index')),
	array('label'=>'Gegevens nieuwe gebruiker invoeren', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Gebruikers-gegevens beheren</h3>
<p>
U kunt eventueel een vergelijkingsteken (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
of <b>=</b>) toevoegen voorafgaande aan uw zoekwaarden om te  specificeren hoe de vergelijking gedaan moet worden.
</p>

<?php echo CHtml::link('Geavanceerd zoeken','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		'password',
		'role',
		'klantnr',
		'last_login_time',
		/*
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
