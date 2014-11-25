<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Gebruikers'=>array('index'),
	'Gegevens nieuwe gebruiker invoeren',
);

$this->menu=array(
	array('label'=>'Lijst van gebruikers', 'url'=>array('index')),
	array('label'=>'Gebruikers beheren', 'url'=>array('admin')),
);
?>

<h3>Gegevens nieuwe gebruiker invoeren</h3>

<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>false,
)); ?>

     <p class="note">Gegevens met een <span class="required">*</span> moeten ingevuld worden.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password_repeat'); ?>
        <?php echo $form->passwordField($model,'password_repeat',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'password_repeat'); ?>
      </div>    
    
    <div class="row">
        <?php echo $form->labelEx($model,'role'); ?>
        <?php echo $form->textField($model,'role',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'role'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'klantnr'); ?>
        <?php echo $form->textField($model,'klantnr'); ?>
        <?php echo $form->error($model,'klantnr'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->