<?php
/* @var $this SiteController */
/* @var $model UsersEmailForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Wachtwoord vergeten';

     $mb = new MenuBuilder();
    echo $mb->buildMenu(null, null);   

?>

<h3>Wachtwoord vergeten</h3>

<p>Vul uw e-mail adres in zodat wij u een e-mail kunnen sturen met een link erin waarmee u op de website
een nieuw wachtwoord kunt opgeven.</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-email-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Verzenden', array('name' => 'verzendbutton')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
