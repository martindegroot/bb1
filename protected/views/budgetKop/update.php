<?php
/* @var $this BudgetKopController */
/* @var $model BudgetKop */

    $breadcrumbs = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr);
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=> $breadcrumbs,
    ));

?>

<h3>Budget-kop wijzigen van klantnr <?php echo $klant->klantnr . ' ' . $klant->adresseernaam; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>