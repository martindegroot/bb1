<?php
/* @var $this DocumentController */
/* @var $data Document */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scandatumtijd')); ?>:</b>
	<?php echo CHtml::encode($data->scandatumtijd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('postdatum')); ?>:</b>
	<?php echo CHtml::encode($data->postdatum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('van_naam')); ?>:</b>
	<?php echo CHtml::encode($data->van_naam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aan_naam')); ?>:</b>
	<?php echo CHtml::encode($data->aan_naam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('onderwerp')); ?>:</b>
	<?php echo CHtml::encode($data->onderwerp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keywords')); ?>:</b>
	<?php echo CHtml::encode($data->keywords); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('klantnr')); ?>:</b>
	<?php echo CHtml::encode($data->klantnr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dossiernr')); ?>:</b>
	<?php echo CHtml::encode($data->dossiernr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tekstinhoud')); ?>:</b>
	<?php echo CHtml::encode($data->tekstinhoud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->create_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_id); ?>
	<br />

	*/ ?>

</div>