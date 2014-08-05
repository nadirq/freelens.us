<h1>Add photo!!!</h1>

<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>
<br />
<?php echo CHtml::activeFileField($model, 'image'); ?>
<br />

<?php echo CHtml::submitButton('Отправить') ?>
<?php echo CHtml::endForm(); ?>