<?php
/* @var $this RelatieController */
/* @var $model Relatie */

    // horizontale menu direct onder de header uit het layout template:
    $mb = new MenuBuilder();
    echo $mb->buildMenu(null, null);

 
    $breadcrumbsArr = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr);
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=> $breadcrumbsArr,
    ));



?>

<h3>Gegevens wijzigen voor Relatie met code = <?php echo $model->code; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>