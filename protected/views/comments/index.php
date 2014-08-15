<?php
/* @var $this CommentsController */

?>
<h3 class="page-header">Я рассказал всем о</h3>

<div id="rewiews">
    <?php
    if(!$reviews)
        echo 'No reviews yet.';
    foreach($reviews as $i => $r)
    {
        ?>
        <div class="review">
            <?php if(isset($r)) { ?>
                <?php echo 'Для <strong>'. $camerists[$i]->fio .'</strong>'; ?>
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
