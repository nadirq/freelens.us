<?php
/* @var $this CameristsController */

$this->breadcrumbs=array(
	'Camerists',
);
?>
<h1>Our photographers</h1>

<p>
    <?php //TODO: Add checkbox 'online' ?>
    <?php foreach($camerists->getAll() as $i => $c){ ?>
        <div class = "row" >
            <div id='avatar'>
                <?php
                    echo CHtml::image(Yii::app()->baseUrl.'/'.Thumbnail::getThumb($c->avatar), 'Avatar');
                ?>
            </div>
            <?php echo $c->login; ?>
            <?php if($rate != null)
                    echo 'Rate: ' . $rate[$i] . '/5'; ?>
            <?php echo CHtml::link('Order', Yii::app()->createUrl('orders/make', array('cam_id' => $c->id))); ?>
            <?php echo CHtml::link('Rate', Yii::app()->createUrl('rating/rate', array('cam_id' => $c->id))); ?>
            <?php echo CHtml::link('Review', Yii::app()->createUrl('/comments/add', array('cam_id' => $c->id))); ?>
            <?php echo CHtml::link('Info', Yii::app()->createUrl('/camerists/info', array('cam_id' => $c->id))); ?>
        </div>
        <br />
    <?php } ?>
</p>
