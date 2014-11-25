<?php
/* @var $this BudgetKopController */
/* @var $data BudgetKop */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('klantnr')); ?>:</b>
	<?php echo CHtml::encode($data->klantnr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('begin_datum')); ?>:</b>
	<?php echo CHtml::encode($data->begin_datum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eind_datum')); ?>:</b>
	<?php echo CHtml::encode($data->eind_datum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('beginsaldo')); ?>:</b>
	<?php echo CHtml::encode($data->beginsaldo); ?>
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