<?php
/* @var $this DossierController */
/* @var $data Dossier */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('dossiernr')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->dossiernr), array('view', 'id'=>$data->dossiernr)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('klantnr')); ?>:</b>
	<?php echo CHtml::encode($data->klantnr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dossiertype_code')); ?>:</b>
	<?php echo CHtml::encode($data->dossiertype_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('relatie_code')); ?>:</b>
	<?php echo CHtml::encode($data->relatie_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('volgnr')); ?>:</b>
	<?php echo CHtml::encode($data->volgnr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->create_user_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_id); ?>
	<br />

	*/ ?>

</div>