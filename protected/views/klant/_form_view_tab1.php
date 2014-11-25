<?php
/* @var $this KlantController */
/* @var $model Klant */
/* @var $form CActiveForm */
?>

    
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$klant,
    'attributes'=>array(
        'achternaam',
        'voorvoegsel',
        'voorletters',
        'titel',
        'naamgebruikOmschrijving',
         'geboortedatum',
        'bsn',
        'iddocsoortOmschrijving',
        'iddoc_nummer',
        'iddoc_geldigtotdatum',
    ),
)); ?>

