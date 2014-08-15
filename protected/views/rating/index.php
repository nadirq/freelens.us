<?php
/* @var $this OrdersController */

$this->breadcrumbs=array(
	'Orders',
);
?>
<h3 class="page-header">Выставленные оценки</h3>

<?php
if(!$rates)
    echo 'No rating yet.';

foreach($rates as $i => $r)
{
    ?>
    <div class="order">
        <?php
        if(isset($camerists[$i]))
        {
            echo 'Оценка для '. $camerists[$i]->fio . '<br />';
            echo $r->rate . '&nbsp;&nbsp;&nbsp;';
            echo CHtml::link('Change rate', Yii::app()->createUrl('rating/change'),array('class'=>'btn btn-primary'));

        }
        ?>
    </div>
<?php
}
?>