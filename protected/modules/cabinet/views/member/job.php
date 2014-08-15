<h3 class="page-header">Заявки на фотосессию</h3>
<?php
if(!empty($orders)){
foreach($orders as $i => $order): ?>
        <div class='order'>
            <?php
                echo $users[$i]->login;
            ?>
            <br />
            <?php

                echo 'When: ' . date('d/m/Y',strtotime($order->date));
            ?>
            <br />
            <?php
                echo 'Cash: ' . $order->price . '$';
            ?>
            <br />
            <?php
                echo 'Status: ' . $order->status;
            ?>
            <br />
        </div>

    <div id='link_block'>
    <?php

        if($order->status != 'Refused'){
            if($order->accepted == true && $order->status != 'Finished')
            {
                echo 'Accepted';
                echo CHtml::link('Decline', Yii::app()->createUrl('orders/decline', array('order' => $order->id)));
                if($order->status != 'Finished')
                    echo CHtml::link('Finish', Yii::app()->createUrl('orders/finish', array('order' => $order->id)));
            }

            if($order->accepted != true)
            {
                echo CHtml::link('Accept', Yii::app()->createUrl('orders/accept', array('order' => $order->id)));
                echo CHtml::link('Decline', Yii::app()->createUrl('orders/decline', array('order' => $order->id)));
            }
        }


     ?>
    </div>
<?php endforeach;
}
else{
    echo 'Заявок нету';
}
?>


<?php
$this->widget('CLinkPager', array(
    'pages' => $pages,
));
?>