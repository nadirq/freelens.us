
<div class="form">
    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::activeLabel($model, 'Photographer schedule'); ?>
    <hr />

    <?php echo CHtml::errorSummary($model); ?>


    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'date',
        'model' => $model,
        'attribute' => 'date',
        'language' => 'en',
        'flat' => true,
        'value' => date('d/m/Y'),
    ));?>

    <div class="row">
        <?php echo CHtml::activeLabel($model, 'price'); ?>
        <?php echo CHtml::activeTextField($model, 'price'); ?>
    </div>
    Busy days:
    <br />
    <div class="row">
        <?php
            foreach($busy as $b)
            {
                echo $b->date;
            }
        ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('Order'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>
</div><!-- form -->



