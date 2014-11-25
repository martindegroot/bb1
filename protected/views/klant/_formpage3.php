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
     <h3>Gegevens voor nieuwe klant invoeren, pagina 3 van 6</h3>
         
	 <p class="note">Gegevens met een <span class="required">*</span> moeten ingevuld worden.</p>

	<?php echo $form->errorSummary($model); ?>


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


	<div class="row buttons">
        <?php echo CHtml::submitButton('Terug', array('name'=>'page2')); ?>
        <?php echo CHtml::submitButton('Verder', array('name'=>'page4')); ?>		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->