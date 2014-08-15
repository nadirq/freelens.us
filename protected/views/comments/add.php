
<div class="form">
    <div class="col-lg-6">
        <h3 class="page-header">Новый отзыв о пользователе <?php echo Users::model()->findByPk($_GET['cam_id'])->fio; ?></h3>

        <?php echo CHtml::beginForm(); ?>

        <?php echo CHtml::errorSummary($model); ?>

        <div class="row">
            <?php echo CHtml::activeLabel($model,'message'); ?>
            <?php echo CHtml::activeTextarea($model,'message', array('class' => 'form-control', 'rows'=>'15')); ?>
        </div>

        <div class="row submit">
            <?php echo CHtml::submitButton('Отправить', array('id' => "submit", 'class' => 'btn pull-right')); ?>
        </div>

        <?php echo CHtml::endForm(); ?>
    </div>
</div><!-- form -->
