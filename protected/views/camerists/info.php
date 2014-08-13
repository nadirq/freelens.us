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

<div id="contacts">
    <?php echo 'Phone: ' . $camerist->tel; ?>
    <br />
    <?php echo 'Email: ' . $camerist->email; ?>
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
    if(!$album)
        echo 'No photos in portfolio.';
    else {
    ?>
        <ul class="bxslider">
            <?php foreach($album as $item): ?>
                <li>
                    <?php if($item->published)
                        echo CHtml::image(Yii::app()->baseUrl.'/'.$item->path, 'Portfolio item'); ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <ul class="bx-pager">
            <?php $i = 0; ?>
            <?php foreach($album as $item): ?>
                <li>
                    <?php if($item->published) ?>
                        <a data-silde-index="<?php echo $i; ?>" href="">
                            <?php echo CHtml::image(Yii::app()->baseUrl.'/'.Thumbnail::getThumb($item->path), 'Portfolio item'); ?>
                        </a>
                </li>
                <?php $i++; ?>
            <?php endforeach; ?>
        </ul>

    <?php } ?>
</div>

<script>
    $('.bxslider').bxSlider({
        pagerCustom: '#bx-pager'
    });
</script>