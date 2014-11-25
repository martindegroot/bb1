<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';

     $mb = new MenuBuilder();
    echo $mb->buildMenu(null, null);   
    $this->breadcrumbs=array(
	   'Inloggen',
    );

//    $this->widget('zii.widgets.CBreadcrumbs', array(
//            'links'=>$this->breadcrumbs,
//    ));
?>

<h3>Inloggen</h3>

<p>Vul alstublieft uw gebruikersnaam en wachtwoord in:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Velden met <span class="required">*</span> moeten ingevuld worden.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
<!--		<p class="hint"></p> -->
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Inloggen', array('name' => 'inlogbutton')); ?>
        <?php echo '&nbsp;&nbsp;&nbsp;' ?>
       <?php echo CHtml::submitButton('Wachtwoord vergeten?', array('name' => 'wwvergetenbutton')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
