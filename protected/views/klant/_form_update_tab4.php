
     <h4>Persoon 2 - overige gegevens</h4>




	<div class="row">
		<?php echo $form->labelEx($model,'geboortedatum_partner'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'geboortedatum_partner',
                'attribute' => 'geboortedatum_partner',
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

		<?php echo $form->error($model,'geboortedatum_partner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bsn_partner'); ?>
		<?php echo $form->textField($model,'bsn_partner'); ?>
		<?php echo $form->error($model,'bsn_partner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_partner_soort'); ?>
         <?php echo $form->dropDownList($model,'iddoc_partner_soort', $model->getSoortIDDocOptions()); ?>  
		<?php echo $form->error($model,'iddoc_partner_soort'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_partner_nummer'); ?>
		<?php echo $form->textField($model,'iddoc_partner_nummer',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'iddoc_partner_nummer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iddoc_partner_geldigtotdatum'); ?>		
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'iddoc_partner_geldigtotdatum',
        'attribute' => 'iddoc_partner_geldigtotdatum',
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

		<?php echo $form->error($model,'iddoc_partner_geldigtotdatum'); ?>
	</div>

