<?php
/* @var $this DossiertypeController */
/* @var $model Dossiertype */

    // horizontale menu direct onder de header uit het layout template:
    $mb = new MenuBuilder();
    echo $mb->buildMenu(null, null);

    $breadcrumbsArr = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr); 
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=> $breadcrumbsArr,
    ));
         

?>

<h3>Gegevens voor nieuw dossiertype invoeren</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>