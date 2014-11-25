<?php
/* @var $this DossiertypeController */
/* @var $model Dossiertype */

     // toevoegen breadcrumb aan bestaande breadcrumbs, namelijk de breadcrumb die verwijst naar de huidige route/view
     // dat is dossiertype/admin en de huidige viewfile = dossiertype\admin.php
     // de url moet ook een encodedBreadcrumbsstr hebben, die gelijk is aan de huidige $encodedBreadcrumbsstr
     $labelDossiertypeAdmin = 'Dossier typen beheren';
     $urlDossierTypeAdmin   = Yii::app()->createUrl('dossiertype/admin',
                                                        array('encodedBreadcrumbsstr' => $encodedBreadcrumbsstr));
     $newEncodedBreadcrumbsstr = BreadcrumbsBuilder::getExpandedBreadcrumbsstr($encodedBreadcrumbsstr,
                                                                                $labelDossiertypeAdmin,
                                                                                $urlDossierTypeAdmin);
 
     $encodedReturnUrlDossierTypeAdmin = base64_encode($urlDossierTypeAdmin);     

     // verwijder een eventueel aanwezige record
     // en voeg daarna nieuwe record toe in tabel instellingen
     $sleutel = 'dossiertype-admin-encodedBreadcrumbsstr';
     $waarde = $newEncodedBreadcrumbsstr;
     BreadcrumbsBuilder::insertEncodedBreadcrumbsStr($sleutel, $waarde);

     // verwijder een eventueel aanwezige record
     // en voeg daarna nieuwe record toe in tabel instellingen
     $sleutel = 'dossiertype-admin-encodedReturnUrl';
     $waarde = $encodedReturnUrlDossierTypeAdmin;
     BreadcrumbsBuilder::insertEncodedBreadcrumbsStr($sleutel, $waarde);
     

    $mb = new MenuBuilder();
    $menuItems = array();
    
    if(Yii::app()->user->checkAccess('dossiertype_create'))
    {
        $urlDossierTypeCreate = Yii::app()->createUrl('dossiertype/create',
                                                 array('encodedReturnUrl' => $encodedReturnUrlDossierTypeAdmin,                                                      
                                                       'encodedBreadcrumbsstr' => $newEncodedBreadcrumbsstr,  ));
        $menuItems[]= array('label'=>'Nieuw dossiertype',
                             'url'=>$urlDossierTypeCreate);
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
	$('#dossiertype-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Dossier typen beheren</h3>

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
	'id'=>'dossiertype-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        'volgorde',
		'code',
		'type',
		'subtype',

		array(
			'class'=>'CButtonColumn',
            'template' => '{update} {delete}',
             'buttons' => array
                (
                       'update' => array
                    (
                      'url' => 'Yii::app()->createUrl("dossiertype/update",
                                                  array("code"=>$data->code,
                                                  "encodedReturnUrl" => "dossiertype-admin-encodedReturnUrl",
                                                  "encodedBreadcrumbsstr" => "dossiertype-admin-encodedBreadcrumbsstr",  ))',
                    ),   
                ),            
		),
	),
)); ?>
