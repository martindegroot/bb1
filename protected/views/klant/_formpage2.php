<?php
/* @var $this KlantController */
/* @var $model Klant */
/* @var $form CActiveForm */

    // model = Klant
    // horizontale menu direct onder de header uit het layout template:
    $mb = new MenuBuilder();
    echo $mb->buildMenu(null, null);

    $breadcrumbsArr = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr);

    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $breadcrumbsArr,
    ));    

?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'klant-form',
	'enableAjaxValidation'=>false,
     'stateful'=>true,
)); ?>
     <h3></br>Gegevens voor nieuwe klant invoeren, pagina 2 van 6</h3>

	 <p class="note">Gegevens met een <span class="required">*</span> moeten ingevuld worden.</p>

 	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'geboortedatum'); ?>
                <!-- voorbeeld overgenomen van Yii Rapid Application Development Hotshot -->
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'geboortedatum',
                'attribute' => 'geboortedatum',
                'model'=>$model,
                'options'=> array(
                  'dateFormat' =>'yy-mm-dd',
                  'altFormat' =>'yy-mm-dd',
                  'changeMonth' => true,
                  'changeYear' => true,
                  'yearRange' => "-100:+00",
                  'appendText' => 'jjjj-mm-dd',
                  'monthNamesShort' => array( "Jan", "Feb", "Mrt", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec" ),
                  'dayNamesMin'   => array("Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za"),
                  'dayNamesShort'  => array("Zon", "Maa", "Din", "Woe", "Don", "Vrij", "Zat"),
                ),
              )); 
        ?>  
        <?php echo $form->error($model,'geboortedatum'); ?>
    </div>    
    
    
	<div class="row">
		<?php echo $form->labelEx($model,'bsn'); ?>
		<?php echo $form->textField($model,'bsn'); ?>
		<?php echo $form->error($model,'bsn'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_soort'); ?>
        <?php echo $form->dropDownList($model,'iddoc_soort', $model->getSoortIDDocOptions()); ?>  
		<?php echo $form->error($model,'iddoc_soort'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_nummer'); ?>
		<?php echo $form->textField($model,'iddoc_nummer',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'iddoc_nummer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_geldigtotdatum'); ?>
                <!-- voorbeeld overgenomen van Yii Rapid Application Development Hotshot -->
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'iddoc_geldigtotdatum',
                'attribute' => 'iddoc_geldigtotdatum',
                'model'=>$model,
                'options'=> array(
                  'dateFormat' =>'yy-mm-dd',
                  'altFormat' =>'yy-mm-dd',
                  'changeMonth' => true,
                  'changeYear' => true,
                  'yearRange' => "-1:+10",
                  'appendText' => 'jjjj-mm-dd',
                  'monthNamesShort' => array( "Jan", "Feb", "Mrt", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec" ),
                  'dayNamesMin'   => array("Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za"),
                  'dayNamesShort'  => array("Zon", "Maa", "Din", "Woe", "Don", "Vrij", "Zat"),
                ),
              )); 
        ?>  

		<?php echo $form->error($model,'iddoc_geldigtotdatum'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Terug', array('name'=>'page1')); ?>
        <?php echo CHtml::submitButton('Verder', array('name'=>'page3')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->