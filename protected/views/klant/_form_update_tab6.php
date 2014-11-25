
     <h4>Klant - overige gegevens</h4>
    
	<div class="row">
		<?php echo $form->labelEx($model,'intake_datum'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'intake_datum',
        'attribute' => 'intake_datum',
        'model'=>$model,
        'options'=> array(
          'dateFormat' =>'yy-mm-dd',
          'altFormat' =>'yy-mm-dd',
          'changeMonth' => true,
          'changeYear' => true,
          'yearRange' => "-1:+1",
          'appendText' => 'jjjj-mm-dd',
          'monthNamesShort' => array( "Jan", "Feb", "Mrt", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec" ),
          'dayNamesMin'   => array("Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za"),
          'dayNamesShort'  => array("Zon", "Maa", "Din", "Woe", "Don", "Vrij", "Zat"),
        ),
      )); 
        ?>  

		<?php echo $form->error($model,'intake_datum'); ?>
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
          'appendText' => 'jjjj-mm-dd',
          'monthNamesShort' => array( "Jan", "Feb", "Mrt", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec" ),
          'dayNamesMin'   => array("Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za"),
          'dayNamesShort'  => array("Zon", "Maa", "Din", "Woe", "Don", "Vrij", "Zat"),
        ),
      )); 
        ?>  

		<?php echo $form->error($model,'begin_datum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'einddatum'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'einddatum',
        'attribute' => 'einddatum',
        'model'=>$model,
        'options'=> array(
          'dateFormat' =>'yy-mm-dd',
          'altFormat' =>'yy-mm-dd',
          'changeMonth' => true,
          'changeYear' => true,
          'yearRange' => "-1:+1",
          'appendText' => 'jjjj-mm-dd',
          'monthNamesShort' => array( "Jan", "Feb", "Mrt", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec" ),
          'dayNamesMin'   => array("Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za"),
          'dayNamesShort'  => array("Zon", "Maa", "Din", "Woe", "Don", "Vrij", "Zat"),
        ),
      )); 
        ?>  
		<?php echo $form->error($model,'einddatum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'beheer_rek_nr'); ?>
		<?php echo $form->textField($model,'beheer_rek_nr',array('size'=>22,'maxlength'=>18)); ?>
		<?php echo $form->error($model,'beheer_rek_nr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prive_rek_nr'); ?>
		<?php echo $form->textField($model,'prive_rek_nr',array('size'=>22,'maxlength'=>18)); ?>
		<?php echo $form->error($model,'prive_rek_nr'); ?>
	</div>