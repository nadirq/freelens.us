<h3 class="page-header">Заявки на фотосессию</h3>
<?php
if(!empty($orders)){
    foreach($orders as $i => $order): ?>
        <div class="row">
            <div class='order'>

                <?php

                echo '<div class="row"><div class="col-lg-2">Дата подачи   заявки: </div><div class="col-lg-2">' .
                    date('d/m/Y',strtotime($order->date)) .'</div>';
                ?>
                <br />
                <?php
                echo '<div class="col-lg-2">Предложенная цена: </div><div class="col-lg-2">' . $order->price . '$</div>';
                ?>
                <br />
                <?php
                echo '<div class="col-lg-2">Статус: </div><div class="col-lg-2">' . $order->status . '</div></div>';
                ?>
                <br />


                <div id='link_block'>
                    <?php

                    if($order->status != 'Refused'){
                        if($order->accepted == true && $order->status != 'Finished')
                        {
                            echo '<p>Accepted</p>';
                            echo CHtml::link('Decline', Yii::app()->createUrl('orders/decline', array('order' => $order->id)), array('class'=>'btn btn-danger'));
                            if($order->status != 'Finished')
                                echo CHtml::link('Finish', Yii::app()->createUrl('orders/finish', array('order' => $order->id)), array('class'=>'btn btn-default'));
                        }

                        if($order->accepted != true)
                        {
                            echo CHtml::link('Accept', Yii::app()->createUrl('orders/accept', array('order' => $order->id)), array('class'=>'btn btn-success'));
                            echo CHtml::link('Decline', Yii::app()->createUrl('orders/decline', array('order' => $order->id)), array('class'=>'btn btn-danger'));
                        }
                    }

                    echo "";
                    ?>
                </div>
            </div>
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