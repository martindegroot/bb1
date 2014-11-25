<?php if($uploaded):?>
    <p>Het bestand is opgestuurd en opgeslagen. Check <?php echo $dir?>.</p>
<?php endif ?>

<?php echo CHtml::beginForm('','post',array
   ('enctype'=>'multipart/form-data'))?>
   <?php echo CHtml::error($model, 'file')?>
   <?php echo CHtml::activeFileField($model, 'file', array('width' => "200px"))?>
   <?php echo CHtml::submitButton('Opsturen')?>
<?php echo CHtml::endForm()?>


