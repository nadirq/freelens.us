<?php
/* @var $this OrdersController */

$this->breadcrumbs=array(
	'Orders',
);
?>
<h1>My orders</h1>

<?php foreach($orders as $i => $o): ?>
        <div class="order">
        <?php
            if(isset($camerists[$i]))
            {
                echo 'Photographer: ' . $camerists[$i]->login . '<br />';
                echo 'Date: ' . $o->date . '<br />';
                echo 'Status: '.$o->status . '<br />';
                echo 'Payment: '. $o->price . '<br />';
                if(($o->status != 'Refused') && ($o->status != 'Closed'))
                    echo CHtml::link('Close order', Yii::app()->createUrl('orders/close', array('order' => $o->id)));

            }
        ?>
        </div>
<?php endforeach; ?>

<?php
    $this->widget('CLinkPager', array(
        'pages' => $pages,
    ));
?>