<?php
/* @var $this KlantController */
/* @var $model Klant */
/* @var $form CActiveForm */
?>

    
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$klant,
    'attributes'=>array(
            'straathuisnr',
        'postcode',
        'woonplaats',
        'telefoonnr',
        'email',
    ),
)); ?>

