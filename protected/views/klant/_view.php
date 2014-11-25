<?php
/* @var $this KlantController */
/* @var $data Klant */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('klantnr')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->klantnr), array('viewbyklantnr', 'klantnr'=>$data->klantnr)); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('intake_datum')); ?>:</b>
	<?php echo CHtml::encode($data->intake_datum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('begin_datum')); ?>:</b>
	<?php echo CHtml::encode($data->begin_datum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('einddatum')); ?>:</b>
	<?php echo CHtml::encode($data->einddatum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('beheer_rek_nr')); ?>:</b>
	<?php echo CHtml::encode($data->beheer_rek_nr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prive_rek_nr')); ?>:</b>
	<?php echo CHtml::encode($data->prive_rek_nr); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('achternaam')); ?>:</b>
	<?php echo CHtml::encode($data->achternaam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voorvoegsel')); ?>:</b>
	<?php echo CHtml::encode($data->voorvoegsel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voorletters')); ?>:</b>
	<?php echo CHtml::encode($data->voorletters); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titel')); ?>:</b>
	<?php echo CHtml::encode($data->titel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('naamgebruik')); ?>:</b>
	<?php echo CHtml::encode($data->naamgebruik); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('geboortedatum')); ?>:</b>
	<?php echo CHtml::encode($data->geboortedatum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bsn')); ?>:</b>
	<?php echo CHtml::encode($data->bsn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('achternaam_partner')); ?>:</b>
	<?php echo CHtml::encode($data->achternaam_partner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voorvoegsel_partner')); ?>:</b>
	<?php echo CHtml::encode($data->voorvoegsel_partner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voorletters_partner')); ?>:</b>
	<?php echo CHtml::encode($data->voorletters_partner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titel_partner')); ?>:</b>
	<?php echo CHtml::encode($data->titel_partner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('naamgebruik_partner')); ?>:</b>
	<?php echo CHtml::encode($data->naamgebruik_partner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('geboortedatum_partner')); ?>:</b>
	<?php echo CHtml::encode($data->geboortedatum_partner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bsn_partner')); ?>:</b>
	<?php echo CHtml::encode($data->bsn_partner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefoonnr')); ?>:</b>
	<?php echo CHtml::encode($data->telefoonnr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iddoc_soort')); ?>:</b>
	<?php echo CHtml::encode($data->iddoc_soort); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iddoc_nummer')); ?>:</b>
	<?php echo CHtml::encode($data->iddoc_nummer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iddoc_geldigtotdatum')); ?>:</b>
	<?php echo CHtml::encode($data->iddoc_geldigtotdatum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iddoc_partner_soort')); ?>:</b>
	<?php echo CHtml::encode($data->iddoc_partner_soort); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iddoc_partner_nummer')); ?>:</b>
	<?php echo CHtml::encode($data->iddoc_partner_nummer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iddoc_partner_geldigtotdatum')); ?>:</b>
	<?php echo CHtml::encode($data->iddoc_partner_geldigtotdatum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('straathuisnr')); ?>:</b>
	<?php echo CHtml::encode($data->straathuisnr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('postcode')); ?>:</b>
	<?php echo CHtml::encode($data->postcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('woonplaats')); ?>:</b>
	<?php echo CHtml::encode($data->woonplaats); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->create_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	*/ ?>

</div>