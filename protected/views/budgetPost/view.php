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

<h3>Budgetpost bekijken (ID = <?php echo $model->id; ?>)</h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'budgetcat_ink_of_uitg',
		'budgetcat_volgnrnaam',
		'omschrijving',
		'tegenrek_naam',
		'tegenrek_nr',
		'bedrag',
        'eerste_datum',
		'bedragpermaand',
		'begin_datum',
		'eind_datum',
		'frequentie',
	),
)); ?>
