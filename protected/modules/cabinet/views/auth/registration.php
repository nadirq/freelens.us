<div class="row">
    <div class="col-lg-4">
        <h2 class="page-header">Регистрация</h2>

        <p>Заполните, пожалуйста, все поля</p>

        <?=CHtml::form(); ?>

        <?=CHtml::errorSummary($form); ?><br>

        <?=CHtml::activeLabel($form, 'ФИО'); ?>
        <?=CHtml::activeTextField($form, 'fio', array('class' => 'form-control')) ?>

        <br />
        <?=CHtml::activeLabel($form, 'login'); ?>
        <?=CHtml::activeTextField($form, 'login', array('class' => 'form-control')) ?>

        <br />

        <?=CHtml::activeLabel($form, 'pass'); ?>
        <?=CHtml::activePasswordField($form, 'pass', array('class' => 'form-control')) ?>
        <br />
        <div class="compactRadioGroup">
            <?php
            echo CHtml::activeRadioButtonList($form,'type',array('user'=>'Я хочу фотографироваться!', 'camerist'=>'Я - Фотограф'));
            ?>
        </div>

        <br />
        <br />
        <?=CHtml::submitButton('Sign up', array('id' => "submit", 'class' => 'btn btn-success')); ?>


        <?=CHtml::endForm(); ?>
    </div>

</div>
<br /><br /><br />