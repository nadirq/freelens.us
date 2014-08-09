<h1><?php echo 'Review to ' . Users::model()->findByPk($_GET['cam_id'])->login; ?></h1>

<div class="form">
    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($model); ?>

    <div class="row">
        <?php echo CHtml::activeLabel($model,'message'); ?>
        <?php echo CHtml::activeTextarea($model,'message'); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('Send'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>
</div><!-- form -->