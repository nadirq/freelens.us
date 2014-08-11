<h1>Registration</h1>


<?=CHtml::form(); ?>

<?=CHtml::errorSummary($form); ?><br>


<?=CHtml::activeLabel($form, 'login'); ?>
<?=CHtml::activeTextField($form, 'login') ?>

<br />

<?=CHtml::activeLabel($form, 'pass'); ?>
<?=CHtml::activePasswordField($form, 'pass') ?>

<div class="compactRadioGroup">
    <?php
    echo CHtml::activeRadioButtonList($form,'type',array('user'=>'User', 'camerist'=>'Photographer'));
    ?>
</div>

<br />
<?=CHtml::submitButton('Sign up', array('id' => "submit")); ?>


<?=CHtml::endForm(); ?>