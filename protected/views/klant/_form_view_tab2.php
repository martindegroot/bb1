<?php
/* @var $this KlantController */
/* @var $model Klant */
/* @var $form CActiveForm */
?>

    
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$klant,
    'attributes'=>array(
        'achternaam_partner',
        'voorvoegsel_partner',
        'voorletters_partner',
        'titel_partner',
        'naamgebruik_partnerOmschrijving',
         'geboortedatum_partner',
        'bsn_partner',
        'iddocpartnersoortOmschrijving',
        'iddoc_partner_nummer',
        'iddoc_partner_geldigtotdatum',
    ),
)); ?>

