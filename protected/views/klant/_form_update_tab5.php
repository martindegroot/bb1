
     <h4>Klant - contactgegevens</h4>


	<div class="row">
		<?php echo $form->labelEx($model,'klantnr'); ?>
		<?php echo $form->textField($model,'klantnr', array('readonly'=>true)); ?>
		<?php echo $form->error($model,'klantnr'); ?>
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
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'telefoonnr'); ?>
        <?php echo $form->textField($model,'telefoonnr',array('size'=>15,'maxlength'=>15)); ?>
        <?php echo $form->error($model,'telefoonnr'); ?>
    </div>
