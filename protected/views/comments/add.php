

<div class="form">
    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($model); ?>

    <div class="row">
        <?php echo CHtml::activeLabel($model,'user_id'); ?>
        <?php echo CHtml::activeTextField($model,'user_id'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabel($model,'camerist id'); ?>
        <?php echo CHtml::activeTextField($model,'cam_id'); ?>
    </div>


    <div class="row">
        <?php echo CHtml::activeLabel($model,'message'); ?>
        <?php echo CHtml::activeTextarea($model,'message'); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('Send'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>
</div><!-- form -->