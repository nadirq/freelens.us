
<div class="form">
    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::activeLabel($model, 'Photographer schedule'); ?>
    <hr />

    <?php echo CHtml::errorSummary($model); ?>


    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'model' => $model,
            'name'=>'calendar',
            'flat' => true,
        )
    );
    ?>

    <div class="row">
        <?php echo CHtml::activeLabel($model, 'price'); ?>
        <?php echo CHtml::activeTextField($model, 'price'); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('Order'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>
</div><!-- form -->



