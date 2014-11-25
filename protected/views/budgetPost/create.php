<?php
/* @var $this BudgetPostController */
/* @var $model BudgetPost */

    $mb = new MenuBuilder();
    $menuItems = null;
    
     echo $mb->buildMenu(null, null, $menuItems);

    $breadcrumbsArr = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr);
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$breadcrumbsArr,
    ));
?> 
 <h3>Nieuwe budgetpost maken voor klant: <?php echo $klant->klantnr . ' ' . $klant->adresseernaam ?></h3>

<?php
 echo $this->renderPartial('_form', array('model'=>$model));
  ?>