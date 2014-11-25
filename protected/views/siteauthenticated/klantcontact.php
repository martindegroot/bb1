<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

?>

<h1>Neem contact met ons op</h1>

<?php if(Yii::app()->user->hasFlash('klantcontact')): ?>

<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('klantcontact'); ?>
</div>

<?php else: ?>

<p>
U kunt het onderstaande formulier invullen om ons een bericht te sturen met uw vragen en/of opmerkingen. Bedankt.
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'klantcontact-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

    <p class="note">Velden gemarkeerd met <span class="required">*</span> moeten ingevuld worden.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'klantnaam'); ?>
        <?php echo $form->textField($model,'klantnaam',  array('readonly'=>true, 'size'=>66) ); ?>
        <?php echo $form->error($model,'klantnaam'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'klantnr'); ?>
        <?php echo $form->textField($model,'klantnr',  array('readonly'=>true, 'size'=>5)); ?>
        <?php echo $form->error($model,'klantnr'); ?>
    </div>
    
    
    <div class="row">
        <?php echo $form->labelEx($model,'klantemail'); ?>
        <?php echo $form->textField($model,'klantemail', array('readonly'=>true, 'size'=>30)); ?>
        <?php echo $form->error($model,'klantemail'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'subject'); ?>
        <?php echo $form->textField($model,'subject',array('size'=>66,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'subject'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'body'); ?>
        <?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'body'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Verzenden'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>