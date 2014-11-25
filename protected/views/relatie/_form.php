<?php
/* @var $this RelatieController */
/* @var $model Relatie */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'relatie-form',
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Velden met een <span class="required">*</span> zijn verplicht.</p>
    
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>4,
                                                        'maxlength'=>4,
                                                        'readonly' => true)); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'naam'); ?>
		<?php echo $form->textField($model,'naam',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'naam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'naamregel2'); ?>
		<?php echo $form->textField($model,'naamregel2',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'naamregel2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'straathuisnr'); ?>
		<?php echo $form->textField($model,'straathuisnr',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'straathuisnr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'postcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'woonplaats'); ?>
		<?php echo $form->textField($model,'woonplaats',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'woonplaats'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefoonnr'); ?>
		<?php echo $form->textField($model,'telefoonnr',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'telefoonnr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'faxnr'); ?>
		<?php echo $form->textField($model,'faxnr',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'faxnr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bank_rek_nr'); ?>
		<?php echo $form->textField($model,'bank_rek_nr',array('size'=>22,'maxlength'=>18)); ?>
		<?php echo $form->error($model,'bank_rek_nr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'omschrijving'); ?>
		<?php echo $form->textField($model,'omschrijving',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'omschrijving'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Opslaan' : 'Wijzigingen opslaan'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->