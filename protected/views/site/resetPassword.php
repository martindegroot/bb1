<?php
/* @var $form CActiveForm */

      $thisPageLabel = 'Nieuw wachtwoord opgeven';

?>          

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>false,
)); ?>
<?php
    // $model = User
    
    if(!is_null($model->klant))
    {
        $omschrijving = $model->klant->adresseernaam;
    }
    else
    {
        $omschrijving = $model->medewerker->naam;
    }
?>   <h3>Welkom, <?php echo $omschrijving ?></h3>
     <h3>U kunt op deze pagina een nieuw wachtwoord opgeven.</h3>
     <p class="note">Gegevens met een <span class="required">*</span> moeten ingevuld worden.</p>

    <?php echo $form->errorSummary($model); ?>


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
    


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Opslaan' : 'Opslaan'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->