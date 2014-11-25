<?php
/* @var $this KlantController */
/* @var $model Klant */
/* @var $form CActiveForm */
?>
     <h4>Persoon 1 - overige gegevens</h4>

    <div class="row">
        <?php echo $form->labelEx($model,'geboortedatum'); ?>
                <!-- voorbeeld overgenomen van Yii Rapid Application Development Hotshot -->
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'geboortedatum',
                'attribute' => 'geboortedatum',
                'model'=>$model,
                'options'=> array(
                  'dateFormat' =>'yy-mm-dd',
                  'altFormat' =>'yy-mm-dd',
                  'changeMonth' => true,
                  'changeYear' => true,
                  'yearRange' => "-100:+00",
                  'appendText' => 'jjjj-mm-dd',
                  'monthNamesShort' => array( "Jan", "Feb", "Mrt", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec" ),
                  'dayNamesMin'   => array("Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za"),
                  'dayNamesShort'  => array("Zon", "Maa", "Din", "Woe", "Don", "Vrij", "Zat"),
                ),
              )); 
        ?>  
        <?php echo $form->error($model,'geboortedatum'); ?>
    </div>    
    
    
	<div class="row">
		<?php echo $form->labelEx($model,'bsn'); ?>
		<?php echo $form->textField($model,'bsn'); ?>
		<?php echo $form->error($model,'bsn'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_soort'); ?>
        <?php echo $form->dropDownList($model,'iddoc_soort', $model->getSoortIDDocOptions()); ?>  
		<?php echo $form->error($model,'iddoc_soort'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_nummer'); ?>
		<?php echo $form->textField($model,'iddoc_nummer',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'iddoc_nummer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_geldigtotdatum'); ?>
                <!-- voorbeeld overgenomen van Yii Rapid Application Development Hotshot -->
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'iddoc_geldigtotdatum',
                'attribute' => 'iddoc_geldigtotdatum',
                'model'=>$model,
                'options'=> array(
                  'dateFormat' =>'yy-mm-dd',
                  'altFormat' =>'yy-mm-dd',
                  'changeMonth' => true,
                  'changeYear' => true,
                  'yearRange' => "-1:+10",
                  'appendText' => 'jjjj-mm-dd',
                  'monthNamesShort' => array( "Jan", "Feb", "Mrt", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec" ),
                  'dayNamesMin'   => array("Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za"),
                  'dayNamesShort'  => array("Zon", "Maa", "Din", "Woe", "Don", "Vrij", "Zat"),
                ),
              )); 
        ?>  

		<?php echo $form->error($model,'iddoc_geldigtotdatum'); ?>
	</div>

