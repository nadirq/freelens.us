
<h1>Authorization</h1>

<?=CHtml::form(); ?>
<?=CHtml::errorSummary($form); ?><br>

<?=CHtml::activeLabel($form, 'login'); ?>
<?=CHtml::activeTextField($form, 'login') ?>
<br />
<?=CHtml::activeLabel($form, 'pass'); ?>
<?=CHtml::activePasswordField($form, 'pass') ?>

<br/>
<?=CHtml::submitButton('Enter', array('id' => "submit")); ?>


<?=CHtml::endForm(); ?>