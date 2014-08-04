<?php
/* @var $this RatingController */

$this->breadcrumbs=array(
	'Rating',
);
?>
<h1><?php echo 'Rate ' . Users::model()->findByPk($_GET['cam_id'])->login; ?></h1>


<div class="form">
    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($model); ?>

    <div class="compactRadioGroup">
        <?php
        echo CHtml::activeRadioButtonList($model,'rate',array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=> '5'));
        ?>
        <div class="row submit">
            <?php echo CHtml::submitButton('Rate'); ?>
        </div>
    </div>


    <?php echo CHtml::endForm(); ?>
</div><!-- form -->




