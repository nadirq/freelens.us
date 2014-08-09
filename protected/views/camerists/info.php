<h1>Page of camerist <?php echo $camerist->login; ?></h1>
<div id="rating">
    <?php echo 'Average rating: ' . $rate; ?>
</div>
<div id="can">
    <?php echo CHtml::link('Order', Yii::app()->createUrl('orders/make', array('cam_id' => $camerist->id))); ?>
    <?php echo CHtml::link('Rate', Yii::app()->createUrl('rating/rate', array('cam_id' => $camerist->id))); ?>
    <?php echo CHtml::link('Review', Yii::app()->createUrl('/comments/add', array('cam_id' => $camerist->id))); ?>
</div>
<div id='avatar'>
    <?php
    echo CHtml::image(Yii::app()->baseUrl.'/'.Thumbnail::getThumb($camerist->avatar), 'Avatar');
    ?>
</div>
<div id='name'>
    <?php echo $camerist->fio; ?>
</div>

<div id='about'>
    <?php echo $camerist->about; ?>
</div>


<div id="rewiews">
    <h2>Reviews:</h2>
    <?php
        foreach($reviews as $i => $r)
        {
    ?>
            <div class="review">
                <?php if(isset($r)) { ?>
                    <?php echo $commenters[$i]->login; ?>
                    <br />
                    <?php echo $r->message; ?>
                    <br />
                    <div class="date"><?php echo $r->created_at ?></div>
                <?php } ?>
            </div>
    <?php
        }
    ?>
</div>


<div id='gallery'>
    <h2>Photographer's portfolio</h2>
    <?php
    foreach($album as $item){

        echo CHtml::image(Yii::app()->baseUrl.'/'.Thumbnail::getThumb($item->path), 'Portfolio item');
    }
    ?>
</div>