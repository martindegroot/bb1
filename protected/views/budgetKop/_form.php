<?php
/* @var $this BudgetKopController */
/* @var $model BudgetKop */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'budget-kop-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php 
    echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'begin_datum'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'begin_datum',
                'attribute' => 'begin_datum',
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
		<?php echo $form->error($model,'begin_datum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'eind_datum'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'eind_datum',
                'attribute' => 'eind_datum',
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

		<?php echo $form->error($model,'eind_datum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'beginsaldo'); ?>
		<?php echo $form->textField($model,'beginsaldo',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'beginsaldo'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Opslaan' : 'Opslaan'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->