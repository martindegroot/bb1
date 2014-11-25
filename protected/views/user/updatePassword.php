<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */

      $thisPageLabel = 'Wachtwoord wijzigen';
     // hier moet nu een element aan toegevoegd worden voor de huidige route d.w.z. user/updatepassword
     // de url moet ook een encodedBreadcrumbsstr hebben, die gelijk is aan $encodedBreadcrumbsstr
     $label = $thisPageLabel;
     $url   = Yii::app()->createUrl('user/updatePassword',
             array('id' => $model->id ,
                    'encodedReturnUrl' => $encodedReturnUrl,
                   'encodedBreadcrumbsstr' => $encodedBreadcrumbsstr));
     $newEncodedBreadcrumbsstr = BreadcrumbsBuilder::getExpandedBreadcrumbsstr($encodedBreadcrumbsstr,
                                                                               $label,
                                                                               $url);

    if(!is_null($encodedReturnUrl))
    {
        $decodedReturnUrl = base64_decode($encodedReturnUrl);
        Yii::app()->user->setReturnUrl($decodedReturnUrl);
    }
    else {
        $decodedReturnUrl = Yii::app()->createUrl('siteauthenticated/startbeheerder');
    }

    $breadcrumbsArr = BreadcrumbsBuilder::decodeBreadcrumbs($encodedBreadcrumbsstr);
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$breadcrumbsArr,
    ));
?>          

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
    $user = $model;
    
    if(!is_null($user->klant))
    {
        $omschrijving = 'klant: "' . $user->klant->adresseernaam . '"';
    }
    else
    {
        $omschrijving =  $user->medewerker->naam;
    }
?>
     <h3>Wachtwoord wijzigen van <?php echo $omschrijving; ?></h3>
	 <p class="note">Gegevens met een <span class="required">*</span> moeten ingevuld worden.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'password_repeat'); ?>
        <?php echo $form->passwordField($model,'password_repeat',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'password_repeat'); ?>
      </div>    
    


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Opslaan' : 'Opslaan'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->