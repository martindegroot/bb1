<?php
/* @var $this DocumentController */
/* @var $model Document */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'document-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
    <div class="row">
        <?php echo $form->labelEx($model,'id'); ?>
        <?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($model,'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'padnaam'); ?>
        <?php echo $form->textField($model,'padnaam',array('size'=>100,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'padnaam'); ?>
    </div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'scandatumtijd'); ?>
		<?php echo $form->textField($model,'scandatumtijd'); ?>
		<?php echo $form->error($model,'scandatumtijd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postdatum'); ?>
		<?php echo $form->textField($model,'postdatum'); ?>
		<?php echo $form->error($model,'postdatum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'van_naam'); ?>
		<?php echo $form->textField($model,'van_naam',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'van_naam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aan_naam'); ?>
		<?php echo $form->textField($model,'aan_naam',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'aan_naam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'onderwerp'); ?>
		<?php echo $form->textField($model,'onderwerp',array('size'=>100,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'onderwerp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'keywords'); ?>
		<?php echo $form->textField($model,'keywords',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'klantnr'); ?>
		<?php echo $form->textField($model,'klantnr'); ?>
		<?php echo $form->error($model,'klantnr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dossiernr'); ?>
		<?php echo $form->textField($model,'dossiernr',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'dossiernr'); ?>
	</div>

	<div class="row">
		<?php
            echo $form->labelEx($model,'tekstinhoud');
          ?>
		<?php
             //$model->tekstinhoud = substr($model->tekstinhoud, 0, 102);
             //$model->tekstinhoud = "Beetje tekst één €.";
             echo $form->textArea($model,'tekstinhoud', array('rows'=>20, 'cols'=>100));
         ?>
		<?php echo $form->error($model,'tekstinhoud'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Document toevoegen' : 'Wijzigingen opslaan'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->