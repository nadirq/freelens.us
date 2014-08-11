<?php
/* @var $this RatingController */

$this->breadcrumbs=array(
	'Rating',
);
?>
<h1><?php echo 'Rate ' . Users::model()->findByPk($_GET['cam_id'])->login; ?></h1>


<div class="form">
    <?php $form = $this->beginWidget('CActiveForm'); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="compactRadioGroup">
        <?php
        echo $form->radioButtonList($model,'rate',array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=> '5'));
        ?>
        <div class="row submit">
            <?php echo CHtml::submitButton('Rate'); ?>
        </div>
    </div>


    <?php $this->endWidget(); ?>
</div><!-- form -->




