<?php
/* @var $this KlantController */
/* @var $model Klant */
/* @var $form CActiveForm */

        
    $breadcrumbsArr = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr);

    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $breadcrumbsArr,
    ));
  
    
?>
<h6>&nbsp;</h6>
<h3>Wijzigen gegevens van klant met klantnr <?php echo $model->klantnr; ?></h3>

<div class="form">

 <p class="note">Gegevens met een <span class="required">*</span> moeten ingevuld worden.</p>
 

 
<?php  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'klant-form-update',
	'enableAjaxValidation'=>false,
));  ?>

 <?php echo $form->errorSummary($model); 
 
    // bepaal hier op welke tab er een fout is,
    // zet de index ervan (zero-based)  in de variabele $activeTab
    // hier als voorbeeld 
    // op eerste tab kan alleen achternaam een fout opleveren
    if ($form->error($model,'achternaam') != '')
        $activeTab = 0;
    // op tweede tab (index 1) kan alleen bsn een fout opleveren    
    elseif ($form->error($model, 'bsn') != '')
        $activeTab = 1;
    //op vierde tab (index 3) kan alleen bsn_partner een fout opleveren
    elseif  ($form->error($model, 'bsn_partner') != '')
        $activeTab = 3;
    // op vijfde tab (index 4) kan het e-mail adres fouten opleveren
    elseif ($form->error($model, 'email') != '')
        $activeTab = 4;
    // op zesde tab kunnen de bankrekeningnummers fouten opleveren
    elseif (
             ($form->error($model, 'beheer_rek_nr') != '')
             ||
             ($form->error($model, 'prive_rek_nr') != '')
           )
    {
           $activeTab = 5;
    }
   // als er geen fouten zijn kiezen we de eerste tab, met index 0
    else
        $activeTab = 0;
        
    $tabs = array();
    
    $tabs['Persoon 1 naam']  = array(
         'id' => 'tab1_naamgegevens_persoon1',
         'content' => $this->renderPartial('_form_update_tab1', array(
                     'form'  => $form,
                     'model' => $model,
         ),
         true),          
    );
    
    $tabs['Persoon 1 overig']  = array(
         'id' => 'tab2_overigegevens_persoon1',
         'content' => $this->renderPartial('_form_update_tab2', array(
                     'form'  => $form,
                     'model' => $model,
         ),
         true),          
    );

    $tabs['Persoon 2 naam']  = array(
         'id' => 'tab3_naamgegevens_persoon2',
         'content' => $this->renderPartial('_form_update_tab3', array(
                     'form'  => $form,
                     'model' => $model,
         ),
         true),          
    );
    
    $tabs['Persoon 2 overig']  = array(
         'id' => 'tab4_overigegevens_persoon2',
         'content' => $this->renderPartial('_form_update_tab4', array(
                     'form'  => $form,
                     'model' => $model,
         ),
         true),          
    );
 

   $tabs['Klant contact']  = array(
         'id' => 'tab5_klantgegevens_contact',
         'content' => $this->renderPartial('_form_update_tab5', array(
                     'form'  => $form,
                     'model' => $model,
         ),
         true),          
    );
    
    $tabs['Klant overig']  = array(
         'id' => 'tab6_klantgegevens_overig',
         'content' => $this->renderPartial('_form_update_tab6', array(
                     'form'  => $form,
                     'model' => $model,
         ),
         true),          
    );

    
    $this->widget('zii.widgets.jui.CJuiTabs', array(  
            'tabs' => $tabs, 
            'options' => array( 
                    'collapsible' => false, 
                    'active' => $activeTab,    //zero based index to set active tab on rendering
            ), 
    ));     
    
    
?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Opslaan', array('name' => 'page1')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->