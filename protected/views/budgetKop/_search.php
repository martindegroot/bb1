<?php
/* @var $this BudgetKopController */
/* @var $model BudgetKop */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'klantnr'); ?>
		<?php echo $form->textField($model,'klantnr'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'begin_datum'); ?>
		<?php echo $form->textField($model,'begin_datum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eind_datum'); ?>
		<?php echo $form->textField($model,'eind_datum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'beginsaldo'); ?>
		<?php echo $form->textField($model,'beginsaldo',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_user_id'); ?>
		<?php echo $form->textField($model,'create_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_user_id'); ?>
		<?php echo $form->textField($model,'update_user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->