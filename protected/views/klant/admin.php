<?php
     // toevoegen breadcrumb aan bestaande breadcrumbs, namelijk de breadcrumb die verwijst naar de huidige route/view
     // dat is klant/admin en de huidige viewfile = klant\admin.php
     // de url moet ook een encodedBreadcrumbsstr hebben, die gelijk is aan de huidige $encodedBreadcrumbsstr
     $labelKlantAdmin = 'Klanten beheren';
     $urlKlantAdmin   = Yii::app()->createUrl('klant/admin', array('encodedBreadcrumbsstr' => $encodedBreadcrumbsstr));
     $newEncodedBreadcrumbsstr = BreadcrumbsBuilder::getExpandedBreadcrumbsstr($encodedBreadcrumbsstr,
                                                                                $labelKlantAdmin,
                                                                                $urlKlantAdmin);
 
     $encodedReturnUrlKlantAdmin = base64_encode($urlKlantAdmin);     
     
     // verwijder een eventueel aanwezige record
     // en voeg daarna nieuwe record toe in tabel instellingen
     $sleutel = 'klant-admin-encodedBreadcrumbsstr';
     $waarde = $newEncodedBreadcrumbsstr;
     BreadcrumbsBuilder::insertEncodedBreadcrumbsStr($sleutel, $waarde);

     // verwijder een eventueel aanwezige record
     // en voeg daarna nieuwe record toe in tabel instellingen
     $sleutel = 'klant-admin-encodedReturnUrl';
     $waarde = $encodedReturnUrlKlantAdmin;
     BreadcrumbsBuilder::insertEncodedBreadcrumbsStr($sleutel, $waarde);

    $mb = new MenuBuilder();
    $menuItems = array();
    
    if(Yii::app()->user->checkAccess('klant_create'))
    {
        $urlKlantCreate = Yii::app()->createUrl('klant/create',
                                                 array('encodedReturnUrl' => $encodedReturnUrlKlantAdmin,                                                      
                                                       'encodedBreadcrumbsstr' => $newEncodedBreadcrumbsstr,  ));
        $menuItems[]= array('label'=>'Nieuwe klant',
                             'url'=>$urlKlantCreate);
     } 
     echo $mb->buildMenu(null, null, $menuItems);
    
     $breadcrumbsArr = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr);

     $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$breadcrumbsArr,
     ));
 

         
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#klant-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
</br>
<h3><?php echo $labelKlantAdmin;?></h3>

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
	'id'=>'klant-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'klantnr',
        'sorteernaam',
        'straathuisnr',
        'postcode',
        'woonplaats',
		array(
			'class'=>'CButtonColumn',
            'template' => '{beheer}{update}{delete}',
            'buttons' => array
            (
                'beheer' => array
                (
                  'label' => 'Beheren',
                  'url' => 'Yii::app()->createUrl("klant/view",
                                                  array("id"=>$data->id,
                                                  "encodedBreadcrumbsstr" => "klant-admin-encodedBreadcrumbsstr",  ))',
                  'imageUrl'=> Yii::app()->request->baseUrl.'/images/manage_16x16.png',
                  'options' => array
                               (
                                 'title' => 'Beheren'
                               )
                ),
                   'update' => array
                (
                  'label' => 'Klantgegevens wijzigen',
                  'url' => 'Yii::app()->createUrl("klant/update",
                                                  array("id"=>$data->id,
                                                  "encodedReturnUrl" => "klant-admin-encodedReturnUrl",
                                                  "encodedBreadcrumbsstr" => "klant-admin-encodedBreadcrumbsstr",  ))',
                  'options' => array
                               (
                                 'title' => 'Klantgegevens wijzigen',
                               )
                ),   
            ),
		),
	),
)); ?>
