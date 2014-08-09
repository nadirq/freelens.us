<?php
/* @var $this CommentsController */

$this->breadcrumbs=array(
	'Comments',
);
?>
<h1>My reviews</h1>

<div id="rewiews">
    <?php
    foreach($reviews as $i => $r)
    {
        ?>
        <div class="review">
            <?php if(isset($r)) { ?>
                <?php echo $camerists[$i]->login; ?>
                <br />
                <?php echo $r->message; ?>
                <br />
                <div class="date"><?php echo $r->created_at ?></div>
                <?php echo CHtml::link('Delete', Yii::app()->createUrl('comments/remove', array('comm' => $r->id)));
                ?>
            <?php } ?>
        </div>
    <?php
    }
    ?>
</div>
