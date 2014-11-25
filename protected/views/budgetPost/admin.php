<?php
/* @var $this BudgetPostController */
/* @var $model BudgetPost */

    $mb = new MenuBuilder();
    $menuItems = array();
    
    if( Yii::app()->user->checkAccess('klant')
         || 
         Yii::app()->user->checkAccess('budgetbeheerder')
       )
    {
        $urlReturnToBudgetPostAdmih =
            Yii::app()->createUrl(
              'budgetPost/admin',
              array('klantnr' => $klant->klantnr,
                    'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr));
        $encodedReturnUrlToBudgetPostAdmin = base64_encode($urlReturnToBudgetPostAdmih);  

        //url voor budgetpost/create moet als encodedBreadcrumbsstr een string krijgen waar aan de
        // breadcrumbs voor deze view budgetpost/admin ook de breadcrumb toegevoegd is voor budgetpost/admin
        // route 
        if (!$userIsKlant) {
            $labelBudgetPostAdmin = "Budgetpostenbeheer klant " . $klant->klantnr;
        }
        else {
            $labelBudgetPostAdmin = "Budgetpostenlijst";
        }
        $urlBudgetPostAdmin = Yii::app()->createUrl(
          'budgetPost/admin',
          array('klantnr' => $klant->klantnr,
                'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr,));          
                        
        $newEncodedBreadcrumbsstr = BreadcrumbsBuilder::getExpandedBreadcrumbsstr($encodedBreadcrumbsstr,
                                                                                  $labelBudgetPostAdmin,
                                                                                  $urlBudgetPostAdmin);
                  
        $urlBudgetPostCreate = Yii::app()->createUrl(
             'budgetPost/create',
             array('klantnr' => $klant->klantnr,
                   'encodedReturnUrl' => $encodedReturnUrlToBudgetPostAdmin,
                   'encodedBreadcrumbsstr' => $newEncodedBreadcrumbsstr));
        
       $sleutel       = 'budgetPost-admin-encodedReturnUrl';   
        $waarde = $encodedReturnUrlToBudgetPostAdmin;
        BreadcrumbsBuilder::insertEncodedBreadcrumbsStr($sleutel, $waarde);
        
        $sleutel = 'budgetPost-admin-encodedBreadcrumbsstr';
        $waarde = $newEncodedBreadcrumbsstr;
        BreadcrumbsBuilder::insertEncodedBreadcrumbsStr($sleutel, $waarde);
         
        if($userIsKlant) {
            $menuItems = null;
        } 
        else {          
        $menuItems[]= array('label'=>'Nieuwe budgetpost',
                             'url'=>$urlBudgetPostCreate);
        }
     } 
     echo $mb->buildMenu(null, null, $menuItems);

    $breadcrumbsArr = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr);
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=> $breadcrumbsArr,
    ));
    if($userIsKlant)
    {
    $buttonArr =array(
            'class'=>'CButtonColumn',
            'template' => '{view}',
            'buttons' => array
            (
                'view'  => array(
                    'url' => 'Yii::app()->createUrl(
                        "budgetPost/view",
                        array("id" =>$data->id,
                        "encodedBreadcrumbsstr" => "budgetPost-admin-encodedBreadcrumbsstr",))',
                ),                   
            ),
        );    
    }
    else
    {
       $buttonArr =array(
                'class'=>'CButtonColumn',
                'template' => '{update} {delete}',
                'buttons' => array
                (
                    'update' => array(
                        'url' => 'Yii::app()->createUrl(
                           "budgetPost/update",
                           array("id"=>$data->id,
                                 "encodedReturnUrl" => "budgetPost-admin-encodedReturnUrl",
                                "encodedBreadcrumbsstr" => "budgetPost-admin-encodedBreadcrumbsstr",  ))',
                    
                    ),
                    'delete' => array(),
                ),
            );          
    }
    
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#budget-post-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
if(!$userIsKlant) {
    echo  "<h3>Budgetposten beheren voor klant: " . $klant->klantnr . " " . $klant->adresseernaam . "</h3>";
}
else {
    echo "<h3>Mijn budgetposten bekijken</h3>";
}

?>
 <p class="note">Maandbudget: Inkomsten &euro;<?php echo $inkomsten ?> Uitgaven &euro;<?php echo $uitgaven ?>
  <span class="required"> <?php echo $over_tekortTekst?></span></p>
<?php

?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'budget-post-grid',
	'dataProvider'=>$model->search(),
	/*'filter'=>$model,  */   
	'columns'=>array(
        array(
            'header' => 'Volgnr' ,
            'value' => '$data->dossiertype->volgorde', //'$data->dossiertype->subtype',

        ),
        array(
              'header' => 'Ink/Uitg',
              'value'  => ' ($data->dossiertype->type == "Inkomsten") ? "Ink" : "Uitg"',
        ),
        array(
            'header' => 'Code' ,
            'value' =>  '$data->dossiertype_code',

        ),
        array(
            'header' => 'Categorie' ,
            'value' =>  '$data->dossiertype->subtype',
        ),
		'omschrijving',
		'bedrag',
         'frequentie',
		'bedragpermaand',
	    $buttonArr,
	),
)); ?>
