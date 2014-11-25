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

<h1>Gegevens voor een nieuwe Relatie invoeren</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>