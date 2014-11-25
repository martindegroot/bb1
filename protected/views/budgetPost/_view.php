<?php
/* @var $this BudgetPostController */
/* @var $data BudgetPost */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('budgetkop_id')); ?>:</b>
	<?php echo CHtml::encode($data->budgetkop_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('budgetcat_ink_of_uitg')); ?>:</b>
	<?php echo CHtml::encode($data->budgetcat_ink_of_uitg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('budgetcat_volgnummer')); ?>:</b>
	<?php echo CHtml::encode($data->budgetcat_volgnummer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('omschrijving')); ?>:</b>
	<?php echo CHtml::encode($data->omschrijving); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tegenrek_naam')); ?>:</b>
	<?php echo CHtml::encode($data->tegenrek_naam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tegenrek_nr')); ?>:</b>
	<?php echo CHtml::encode($data->tegenrek_nr); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('bedrag')); ?>:</b>
	<?php echo CHtml::encode($data->bedrag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bedragpermaand')); ?>:</b>
	<?php echo CHtml::encode($data->bedragpermaand); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('begin_datum')); ?>:</b>
	<?php echo CHtml::encode($data->begin_datum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eind_datum')); ?>:</b>
	<?php echo CHtml::encode($data->eind_datum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('frequentie')); ?>:</b>
	<?php echo CHtml::encode($data->frequentie); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eerste_datum')); ?>:</b>
	<?php echo CHtml::encode($data->eerste_datum); ?>
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