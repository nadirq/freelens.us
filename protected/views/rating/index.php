<?php
/* @var $this OrdersController */

$this->breadcrumbs=array(
	'Orders',
);
?>
<h1>My rates</h1>

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
            echo $camerists[$i]->login . '<br />';
            echo $r->rate;
            echo CHtml::link('Change rate', Yii::app()->createUrl('rating/change'));

        }
        ?>
    </div>
<?php
}
?>