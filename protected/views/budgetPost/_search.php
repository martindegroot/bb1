<?php
/* @var $this BudgetPostController */
/* @var $model BudgetPost */
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
		<?php echo $form->label($model,'budgetkop_id'); ?>
		<?php echo $form->textField($model,'budgetkop_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'budgetcat_ink_of_uitg'); ?>
		<?php echo $form->textField($model,'budgetcat_ink_of_uitg'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'budgetcat_volgnrnaam'); ?>
		<?php echo $form->textField($model,'budgetcat_volgnrnaam'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'omschrijving'); ?>
		<?php echo $form->textField($model,'omschrijving',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tegenrek_naam'); ?>
		<?php echo $form->textField($model,'tegenrek_naam',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tegenrek_nr'); ?>
		<?php echo $form->textField($model,'tegenrek_nr',array('size'=>18,'maxlength'=>18)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bedrag'); ?>
		<?php echo $form->textField($model,'bedrag',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bedragpermaand'); ?>
		<?php echo $form->textField($model,'bedragpermaand',array('size'=>8,'maxlength'=>8)); ?>
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
		<?php echo $form->label($model,'frequentie'); ?>
		<?php echo $form->textField($model,'frequentie'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eerste_datum'); ?>
		<?php echo $form->textField($model,'eerste_datum'); ?>
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