
<div id='submenu'>
    <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
            array('label'=>'Dashboard', 'url'=>array('/cabinet/member/dashboard')),
            array('label'=>'Settings', 'url'=>array('/cabinet/member/account')),
            array('label'=>'Gallery', 'url'=>array('/cabinet/photos/create')),
            array('label'=>'Job', 'url'=>array('/cabinet/member/job')),

        ),
    ));
    ?>

<?php
    foreach($orders as $i => $order){
?>
        <div class='order'>
            <?php
                echo $users[$i]->login;
            ?>
            <br />
            <?php

                echo 'When: ' . $order->date;
            ?>
            <br />
            <?php
                echo 'Cash: ' . $order->price;
            ?>
            <br />
        </div>

    <?php echo CHtml::link('Accept', Yii::app()->createUrl('orders/accept', array('order' => $order->id))); ?>
    <?php echo CHtml::link('Decline', Yii::app()->createUrl('orders/decline', array('order' => $order->id))); ?>

<?php
    }
?>