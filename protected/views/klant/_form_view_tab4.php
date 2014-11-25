<?php
/* @var $this KlantController */
/* @var $model Klant */
/* @var $form CActiveForm */
?>

    
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$klant,
    'attributes'=>array(
         'klantnr',
        'intake_datum',
        'begin_datum',
        'einddatum',
        'displayBeheerRekNr',
        'displayPriveRekNr',

    ),
)); ?>

