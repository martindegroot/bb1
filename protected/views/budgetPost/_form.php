<?php
/* @var $this BudgetPostController */
/* @var $model BudgetPost */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'budget-post-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="note">Velden met een <span class="required">*</span> zijn verplicht.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo "Budget Categorie<br>"; ?>
        <?php echo $form->dropDownList($model,'dossiertype_code', $model->getDossiertypeOptions()); ?>
        <?php echo $form->error($model,'dossiertype_code'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'omschrijving'); ?>
        <?php echo $form->textField($model,'omschrijving',array('size'=>50,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'omschrijving'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'tegenrek_naam'); ?>
        <?php echo $form->textField($model,'tegenrek_naam',array('size'=>50,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'tegenrek_naam'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'tegenrek_nr'); ?>
        <?php echo $form->textField($model,'tegenrek_nr',array('size'=>22,'maxlength'=>18)); ?>
        <?php echo $form->error($model,'tegenrek_nr'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'bedrag'); ?>
        <?php echo $form->textField($model,'bedrag',array('size'=>8,'maxlength'=>8)); ?>
        <?php echo $form->error($model,'bedrag'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'eerste_datum'); ?>
        <?php /* echo $form->textField($model,'eerste_datum'); */ ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'eerste_datum',
                'attribute' => 'eerste_datum',
                'model'=>$model,
                'options'=> array(
                  'dateFormat' =>'yy-mm-dd',
                  'altFormat' =>'yy-mm-dd',
                  'changeMonth' => true,
                  'changeYear' => true,
                  'yearRange' => "-1:+1",
                /*  'appendText' => 'jjjj-mm-dd',   */
                  'monthNamesShort' => array( "Jan", "Feb", "Mrt", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec" ),
                  'dayNamesMin'   => array("Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za"),
                  'dayNamesShort'  => array("Zon", "Maa", "Din", "Woe", "Don", "Vrij", "Zat"),
                ),
              )); 
        ?>  
        <?php echo $form->error($model,'eerste_datum'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'frequentie'); ?>
        <?php /* echo $form->textField($model,'frequentie'); */  ?>
         <?php echo $form->dropDownList($model,'frequentie', $model->getFrequentieOptions()); ?> 
        <?php echo $form->error($model,'frequentie'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'begin_datum'); ?>
       <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'begin_datum',
                'attribute' => 'begin_datum',
                'model'=>$model,
                'options'=> array(
                  'dateFormat' =>'yy-mm-dd',
                  'altFormat' =>'yy-mm-dd',
                  'changeMonth' => true,
                  'changeYear' => true,
                  'yearRange' => "-1:+1",
                /*  'appendText' => 'jjjj-mm-dd',   */
                  'monthNamesShort' => array( "Jan", "Feb", "Mrt", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec" ),
                  'dayNamesMin'   => array("Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za"),
                  'dayNamesShort'  => array("Zon", "Maa", "Din", "Woe", "Don", "Vrij", "Zat"),
                ),
              )); 
        ?>         
        <?php echo $form->error($model,'begin_datum'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'eind_datum'); ?>
       <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'eind_datum',
                'attribute' => 'eind_datum',
                'model'=>$model,
                'options'=> array(
                  'dateFormat' =>'yy-mm-dd',
                  'altFormat' =>'yy-mm-dd',
                  'changeMonth' => true,
                  'changeYear' => true,
                  'yearRange' => "-1:+1",
                /*  'appendText' => 'jjjj-mm-dd',   */
                  'monthNamesShort' => array( "Jan", "Feb", "Mrt", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec" ),
                  'dayNamesMin'   => array("Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za"),
                  'dayNamesShort'  => array("Zon", "Maa", "Din", "Woe", "Don", "Vrij", "Zat"),
                ),
              )); 
        ?>         
        <?php echo $form->error($model,'eind_datum'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Opslaan' : 'Opslaan'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->