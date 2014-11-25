<?php
/* @var $this KlantController */
/* @var $model Klant */
/* @var $form CActiveForm */
?>

    <h4>Persoon 1 - naamgegevens</h4>
    
	<div class="row">
		<?php echo $form->labelEx($model,'achternaam'); ?>
		<?php echo $form->textField($model,'achternaam',array('size'=>30,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'achternaam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'voorvoegsel'); ?>
		<?php echo $form->textField($model,'voorvoegsel',array('size'=>15,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'voorvoegsel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'voorletters'); ?>
		<?php echo $form->textField($model,'voorletters',array('size'=>15,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'voorletters'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'titel'); ?>
         <?php echo $form->dropDownList($model,'titel', $model->getTitelOptions()); ?> 
		<?php echo $form->error($model,'titel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'naamgebruik'); ?>
		<?php echo $form->dropDownList($model,'naamgebruik', $model->getNaamgebruikOptions()); ?>
		<?php echo $form->error($model,'naamgebruik'); ?>
	</div>

