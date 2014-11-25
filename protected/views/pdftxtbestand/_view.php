<?php
/* @var $this PdftxtbestandController */
/* @var $data Pdftxtbestand */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('filename')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->filename), array('view', 'id'=>$data->filename)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dirpath')); ?>:</b>
	<?php echo CHtml::encode($data->dirpath); ?>
	<br />


</div>