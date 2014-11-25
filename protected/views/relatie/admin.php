<?php
/* @var $this RelatieController */
/* @var $model Relatie */

     // toevoegen breadcrumb aan bestaande breadcrumbs, namelijk de breadcrumb die verwijst naar de huidige route/view
     // dat is relatie/admin en de huidige viewfile = relatie\admin.php
     // de url moet ook een encodedBreadcrumbsstr hebben, die gelijk is aan de huidige $encodedBreadcrumbsstr
     $labelRelatieAdmin = 'Relaties beheren';
     $urlRelatieAdmin   = Yii::app()->createUrl('relatie/admin',
                                                        array('encodedBreadcrumbsstr' => $encodedBreadcrumbsstr));
     $newEncodedBreadcrumbsstr = BreadcrumbsBuilder::getExpandedBreadcrumbsstr($encodedBreadcrumbsstr,
                                                                                $labelRelatieAdmin,
                                                                                $urlRelatieAdmin);
 
     $encodedReturnUrlRelatieAdmin = base64_encode($urlRelatieAdmin);     

     // verwijder een eventueel aanwezige record
     // en voeg daarna nieuwe record toe in tabel instellingen
     $sleutel = 'relatie-admin-encodedBreadcrumbsstr';
     $waarde = $newEncodedBreadcrumbsstr;
     BreadcrumbsBuilder::insertEncodedBreadcrumbsStr($sleutel, $waarde);

     // verwijder een eventueel aanwezige record
     // en voeg daarna nieuwe record toe in tabel instellingen
     $sleutel = 'relatie-admin-encodedReturnUrl';
     $waarde = $encodedReturnUrlRelatieAdmin;
     BreadcrumbsBuilder::insertEncodedBreadcrumbsStr($sleutel, $waarde);


     $mb = new MenuBuilder();
     $menuItems = array();     

    if(Yii::app()->user->checkAccess('relatie_create'))
    {
        $urlRelatieCreate = Yii::app()->createUrl('relatie/create',
                                                 array('encodedReturnUrl' => $encodedReturnUrlRelatieAdmin,                                                      
                                                       'encodedBreadcrumbsstr' => $newEncodedBreadcrumbsstr,  ));
        $menuItems[]= array('label'=>'Nieuwe relatie',
                             'url'=>$urlRelatieCreate);
     } 
     echo $mb->buildMenu(null, null, $menuItems);

     $breadcrumbsArr = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr);
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=> $breadcrumbsArr,
    ));
    
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#relatie-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Relaties beheren</h3>

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
	'id'=>'relatie-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'code',
		'naam',
		'naamregel2',
		'straathuisnr',
		'postcode',
		'woonplaats',
		array(
			'class'=>'CButtonColumn',
            'template' => '{update} {delete}',
            'buttons' => array
                (
                       'update' => array
                    (
                      'url' => 'Yii::app()->createUrl("relatie/update",
                                                  array("code"=>$data->code,
                                                  "encodedReturnUrl" => "relatie-admin-encodedReturnUrl",
                                                  "encodedBreadcrumbsstr" => "relatie-admin-encodedBreadcrumbsstr",  ))',
                    ),   
                ),             
		),
	),
)); ?>
