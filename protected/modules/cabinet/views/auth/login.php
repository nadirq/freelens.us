<div class="row">
    <div class="col-lg-4">
        <h3 class="page-header">Вход на сайт</h3>



<?=CHtml::form(); ?>


<?=CHtml::activeLabel($form, 'login'); ?>
<?=CHtml::activeTextField($form, 'login', array('class' => 'form-control')) ?>
<br />
<?=CHtml::activeLabel($form, 'pass'); ?>
<?=CHtml::activePasswordField($form, 'pass', array('class' => 'form-control')) ?>

<br/>
<?=CHtml::submitButton('Enter', array('id' => "submit", 'class' => 'btn btn-success')); ?>
        <?=CHtml::errorSummary($form); ?><br>


<?=CHtml::endForm(); ?>
        </div>
    </div>