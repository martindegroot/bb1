
     <h4>Persoon 2 - naamgegevens</h4>

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
         <?php echo $form->dropDownList($model,'titel_partner', $model->getTitelOptions()); ?> 
		<?php echo $form->error($model,'titel_partner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'naamgebruik_partner'); ?>
        <?php echo $form->dropDownList($model,'naamgebruik_partner', $model->getNaamgebruikOptions()); ?>
		<?php echo $form->error($model,'naamgebruik_partner'); ?>
	</div>
