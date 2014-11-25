<?php
/* @var $this DossierController */
/* @var $model Dossier */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dossier-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'klantnr'); ?>
		<?php echo $form->dropDownList($model,'klantnr', $model->getKlantOptions()); ?>
		<?php echo $form->error($model,'klantnr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dossiertype_code'); ?>
		<?php echo $form->dropDownList($model,'dossiertype_code', $model->getDossiertypeOptions()); ?>
		<?php echo $form->error($model,'dossiertype_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'relatie_code_label'); ?>
		<?php echo $form->dropDownList($model,'relatie_code', $model->getRelatieOptions() ); ?>
		<?php echo $form->error($model,'relatie_code'); ?>
	</div>
    

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Toevoegen' : 'Opslaan'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->