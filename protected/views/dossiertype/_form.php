<?php
/* @var $this DossiertypeController */
/* @var $model Dossiertype */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dossiertype-form',
	'enableAjaxValidation'=>false,
)); ?>
    <p class="note">Velden met een <span class="required">*</span> zijn verplicht.</p>

	<?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model,'volgorde'); ?>
        <?php echo $form->textField($model,'volgorde',array('size'=>4,
                                                       'title' => 'volgorde',
                                                    )); ?>
        <?php echo $form->error($model,'volgorde'); ?>
    </div>


	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
        <!-- hier moet dropdownlist komen met vaste waarden voor type 
             Inkomsten Uitgaven Schulden Administratief -->
        <?php echo $form->dropDownList($model,
                                      'type', $model->getDsrTypeOptions(),
                                       array('title' => "dossier type", )
        
        );  //  array('readonly'=>true, 'size'=>5) kan gebruikt worden voor readonly textfield ?>             
		<?php /* echo $form->textField($model,'type',array('size'=>45,'maxlength'=>45)); */ ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,'code'); ?>
        <?php echo $form->textField($model,'code',array('size'=>4,
                                                       'maxlength'=>4,
                                                       'title' => 'vier cijferige code',
                                                    )); ?>
        <?php echo $form->error($model,'code'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'subtype'); ?>
		<?php echo $form->textField($model,'subtype',array('size'=>45,
                                                            'title' => 'bijv. Salaris, Huur',
                                                            'maxlength'=>45)); ?>
		<?php echo $form->error($model,'subtype'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Opslaan' : 'Opslaan'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->