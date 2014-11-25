<?php
/* @var $this MedewerkerController */
/* @var $model Medewerker */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'naam'); ?>
		<?php echo $form->textField($model,'naam',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
	</div>
<!-- naam -> role en email -> username wijzigen nog te doen -->
    <div class="row">
        <?php echo $form->label($model,'username'); ?>
        <?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'role'); ?>
        <?php echo $form->textField($model,'role',array('size'=>45,'maxlength'=>45)); ?>
    </div>
    
    
	<div class="row buttons">
		<?php echo CHtml::submitButton('Zoeken'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->