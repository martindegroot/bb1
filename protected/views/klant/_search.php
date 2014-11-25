<?php
/* @var $this KlantController */
/* @var $model Klant */
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
		<?php echo $form->label($model,'intake_datum'); ?>
		<?php echo $form->textField($model,'intake_datum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'begin_datum'); ?>
		<?php echo $form->textField($model,'begin_datum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'einddatum'); ?>
		<?php echo $form->textField($model,'einddatum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'beheer_rek_nr'); ?>
		<?php echo $form->textField($model,'beheer_rek_nr',array('size'=>18,'maxlength'=>18)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prive_rek_nr'); ?>
		<?php echo $form->textField($model,'prive_rek_nr',array('size'=>18,'maxlength'=>18)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'achternaam'); ?>
		<?php echo $form->textField($model,'achternaam',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'voorvoegsel'); ?>
		<?php echo $form->textField($model,'voorvoegsel',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'voorletters'); ?>
		<?php echo $form->textField($model,'voorletters',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'titel'); ?>
		<?php echo $form->textField($model,'titel',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'naamgebruik'); ?>
		<?php echo $form->textField($model,'naamgebruik',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'geboortedatum'); ?>
		<?php echo $form->textField($model,'geboortedatum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bsn'); ?>
		<?php echo $form->textField($model,'bsn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'achternaam_partner'); ?>
		<?php echo $form->textField($model,'achternaam_partner',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'voorvoegsel_partner'); ?>
		<?php echo $form->textField($model,'voorvoegsel_partner',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'voorletters_partner'); ?>
		<?php echo $form->textField($model,'voorletters_partner',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'titel_partner'); ?>
		<?php echo $form->textField($model,'titel_partner',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'naamgebruik_partner'); ?>
		<?php echo $form->textField($model,'naamgebruik_partner',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'geboortedatum_partner'); ?>
		<?php echo $form->textField($model,'geboortedatum_partner'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bsn_partner'); ?>
		<?php echo $form->textField($model,'bsn_partner'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefoonnr'); ?>
		<?php echo $form->textField($model,'telefoonnr',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iddoc_soort'); ?>
		<?php echo $form->textField($model,'iddoc_soort'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iddoc_nummer'); ?>
		<?php echo $form->textField($model,'iddoc_nummer',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iddoc_geldigtotdatum'); ?>
		<?php echo $form->textField($model,'iddoc_geldigtotdatum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iddoc_partner_soort'); ?>
		<?php echo $form->textField($model,'iddoc_partner_soort'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iddoc_partner_nummer'); ?>
		<?php echo $form->textField($model,'iddoc_partner_nummer',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iddoc_partner_geldigtotdatum'); ?>
		<?php echo $form->textField($model,'iddoc_partner_geldigtotdatum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'straathuisnr'); ?>
		<?php echo $form->textField($model,'straathuisnr',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'woonplaats'); ?>
		<?php echo $form->textField($model,'woonplaats',array('size'=>45,'maxlength'=>45)); ?>
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
		<?php echo $form->label($model,'update_user_id'); ?>
		<?php echo $form->textField($model,'update_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->