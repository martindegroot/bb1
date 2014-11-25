<?php
/* @var $this BudgetPostController */
/* @var $model BudgetPost */

    $mb = new MenuBuilder();

    $labelBudgetpostUpdate = 'Budgetpost wijzigen (ID = ' . $model->id . ')';
    $urlBudgetpostUpdate =  Yii::app()->createUrl(
                           "budgetPost/update",
                           array("id"=>$model->id,
                                 "encodedReturnUrl" => "budgetPost-admin-encodedReturnUrl",
                                "encodedBreadcrumbsstr" => "budgetPost-admin-encodedBreadcrumbsstr",  ));
                                
     $newEncodedBreadcrumbsstr = BreadcrumbsBuilder::getExpandedBreadcrumbsstr($encodedBreadcrumbsstr,
                                                                            $labelBudgetpostUpdate,
                                                                            $urlBudgetpostUpdate);

           
     echo $mb->buildMenu(null, null, $menuItems);

    $breadcrumbsArr = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr);
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=> $breadcrumbsArr,
    ));

?>

<h3>Budgetpost wijzigen (ID = <?php echo $model->id .')'; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>