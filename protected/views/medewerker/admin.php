<?php
/* @var $this MedewerkerController */
/* @var $model Medewerker */


/* Deze view hoort bij de route medewerker/admin en alleen een gebruiker met role == applicatiebeheerder
   is voor deze route geautoriseerd. Omdat dit al gechecked is kan $decodeReturnUrl direkt
   verwijzen naar siteauthenticated/startapplicatiebeheerder
*/

    if(!is_null($encodedReturnUrl))
    {
        $decodedReturnUrl = base64_decode($encodedReturnUrl);
        Yii::app()->user->setReturnUrl($decodedReturnUrl);
    }
    else {
        $decodedReturnUrl = Yii::app()->createUrl('siteauthenticated/startapplicatiebeheerder');
    }

    // horizontale menu direct onder de header uit het layout template:
    $mb = new MenuBuilder();
    echo $mb->buildMenu(null,null);
    
    
    $this->breadcrumbs=array(
        'Mijn startpagina'=> $decodedReturnUrl,
        'Medewerkers beheren',
    );
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
    ));
$this->menu=array(
	array('label'=>'Nieuwe medewerker', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#medewerker-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Medewerkers beheren</h1>

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
	'id'=>'medewerker-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'naam',
		'email',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
