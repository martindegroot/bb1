<?php
/* @var $this PdftxtbestandController */
/* @var $model Pdftxtbestand */

$this->breadcrumbs=array(
	'Pdftxtbestands'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Pdftxtbestand', 'url'=>array('index')),
	array('label'=>'Create Pdftxtbestand', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pdftxtbestand-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Documenten toevoegen</h3>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php
       $buttonArr =array(
                'class'=>'CButtonColumn',
                'template' => '{viewpdf}{toevoegen}',
                'buttons' => array
                (
                    'viewpdf' => array(
                            'label' => 'Bekijken',  
                            'url' => 'Yii::app()->createUrl("pdftxtbestand/toonpdfbestand",
                                                             array(
                                                                "encodedpdfbestand" => base64_encode(
                                                                                          $data->dirpath . "/" .
                                                                                          $data->filename),
                                                             ))',                           
                             'imageUrl'=> Yii::app()->request->baseUrl.'/images/view.png',  
                             'options' => array(
                                 'title' => 'Toon het pdf bestand in nieuwe tab',
                                 'target' => "_blank"  
                             ),
                    ) ,                                                           
                    
                    'toevoegen' => array(
                           
                            'url' => 'Yii::app()->createUrl("document/create",
                                                             array(
                                                                "encodedPdfPadNaam" => base64_encode(
                                                                $data->dirpath . "/" .
                                                                $data->filename),
                                                             ))',
                             'imageUrl'=> Yii::app()->request->baseUrl.'/images/Document_Add_Icon_16.png',  
                             'options' => array(
                                 'title' => 'Document toevoegen voor dit .pdf bestand',                           
                             ),
                    ) ,

                ),
            ); 
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pdftxtbestand-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(	
		'filename',
		$buttonArr,
	),
)); ?>
