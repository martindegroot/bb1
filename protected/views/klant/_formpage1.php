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
    <h3></br>Gegevens voor nieuwe klant invoeren, pagina 1 van 6</h3>
    
	 <p class="note">Gegevens met een <span class="required">*</span> moeten ingevuld worden.</p>

	<?php echo $form->errorSummary($model); ?>

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

	<div class="row buttons">
		<?php echo CHtml::submitButton('Verder', array('name' => 'page2')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->