<?php
/* @var $this KlantController */
/* @var $model Klant */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'klant-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'klantnr'); ?>
		<?php echo $form->textField($model,'klantnr'); ?>
		<?php echo $form->error($model,'klantnr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'intake_datum'); ?>
		<?php echo $form->textField($model,'intake_datum'); ?>
		<?php echo $form->error($model,'intake_datum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'begin_datum'); ?>
		<?php echo $form->textField($model,'begin_datum'); ?>
		<?php echo $form->error($model,'begin_datum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'einddatum'); ?>
		<?php echo $form->textField($model,'einddatum'); ?>
		<?php echo $form->error($model,'einddatum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'beheer_rek_nr'); ?>
		<?php echo $form->textField($model,'beheer_rek_nr',array('size'=>18,'maxlength'=>18)); ?>
		<?php echo $form->error($model,'beheer_rek_nr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prive_rek_nr'); ?>
		<?php echo $form->textField($model,'prive_rek_nr',array('size'=>18,'maxlength'=>18)); ?>
		<?php echo $form->error($model,'prive_rek_nr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'achternaam'); ?>
		<?php echo $form->textField($model,'achternaam',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'achternaam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'voorvoegsel'); ?>
		<?php echo $form->textField($model,'voorvoegsel',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'voorvoegsel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'voorletters'); ?>
		<?php echo $form->textField($model,'voorletters',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'voorletters'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'titel'); ?>
		<?php echo $form->textField($model,'titel',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'titel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'naamgebruik'); ?>
		<?php echo $form->textField($model,'naamgebruik',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'naamgebruik'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'geboortedatum'); ?>
		<?php echo $form->textField($model,'geboortedatum'); ?>
		<?php echo $form->error($model,'geboortedatum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bsn'); ?>
		<?php echo $form->textField($model,'bsn'); ?>
		<?php echo $form->error($model,'bsn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'achternaam_partner'); ?>
		<?php echo $form->textField($model,'achternaam_partner',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'achternaam_partner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'voorvoegsel_partner'); ?>
		<?php echo $form->textField($model,'voorvoegsel_partner',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'voorvoegsel_partner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'voorletters_partner'); ?>
		<?php echo $form->textField($model,'voorletters_partner',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'voorletters_partner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'titel_partner'); ?>
		<?php echo $form->textField($model,'titel_partner',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'titel_partner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'naamgebruik_partner'); ?>
		<?php echo $form->textField($model,'naamgebruik_partner',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'naamgebruik_partner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'geboortedatum_partner'); ?>
		<?php echo $form->textField($model,'geboortedatum_partner'); ?>
		<?php echo $form->error($model,'geboortedatum_partner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bsn_partner'); ?>
		<?php echo $form->textField($model,'bsn_partner'); ?>
		<?php echo $form->error($model,'bsn_partner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefoonnr'); ?>
		<?php echo $form->textField($model,'telefoonnr',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'telefoonnr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_soort'); ?>
		<?php echo $form->textField($model,'iddoc_soort'); ?>
		<?php echo $form->error($model,'iddoc_soort'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_nummer'); ?>
		<?php echo $form->textField($model,'iddoc_nummer',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'iddoc_nummer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_geldigtotdatum'); ?>
		<?php echo $form->textField($model,'iddoc_geldigtotdatum'); ?>
		<?php echo $form->error($model,'iddoc_geldigtotdatum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_partner_soort'); ?>
		<?php echo $form->textField($model,'iddoc_partner_soort'); ?>
		<?php echo $form->error($model,'iddoc_partner_soort'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_partner_nummer'); ?>
		<?php echo $form->textField($model,'iddoc_partner_nummer',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'iddoc_partner_nummer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_partner_geldigtotdatum'); ?>
		<?php echo $form->textField($model,'iddoc_partner_geldigtotdatum'); ?>
		<?php echo $form->error($model,'iddoc_partner_geldigtotdatum'); ?>
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
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_user_id'); ?>
		<?php echo $form->textField($model,'create_user_id'); ?>
		<?php echo $form->error($model,'create_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_user_id'); ?>
		<?php echo $form->textField($model,'update_user_id'); ?>
		<?php echo $form->error($model,'update_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
		<?php echo $form->error($model,'update_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->