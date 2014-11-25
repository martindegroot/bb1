<?php
/* @var $this KlantController */
/* @var $model Klant */
/* @var $form CActiveForm */
    // model = Klant
    // horizontale menu direct onder de header uit het layout template:
    $mb = new MenuBuilder();
    echo $mb->buildMenu(null, null);

    $breadcrumbsArr = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr);

    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $breadcrumbsArr,
    ));
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'klant-form',
	'enableAjaxValidation'=>false,
     'stateful'=>true,
)); ?>
     <h6>&nbsp;</h6>
     <h3>Gegevens voor nieuwe klant invoeren, pagina 5 van 6</h3>

	 <p class="note">Gegevens met een <span class="required">*</span> moeten ingevuld worden.</p>

	<?php echo $form->errorSummary($model); ?>

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

    


	<div class="row buttons">
        <?php echo CHtml::submitButton('Terug', array('name'=>'page4')); ?>
        <?php echo CHtml::submitButton('Verder', array('name'=>'page6')); ?>    
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->