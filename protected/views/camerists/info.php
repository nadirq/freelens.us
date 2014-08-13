
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



<div class="rate">

    <?php if(!Users::model()->isMadeRate()){ ?>
        <?php $form = $this->beginWidget('CActiveForm'); ?>

        <?php echo $form->errorSummary($model); ?>

            <div class="compactRadioGroup">


                <?php
                    echo $form->radioButtonList($model,'rate',array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=> '5'));
                ?>
                <div class="row submit">
                    <?php echo CHtml::submitButton('Rate'); ?>
                </div>
            </div>


        <?php $this->endWidget(); ?>
    </div><!-- rate -->
<?php }
    else
        echo Users::model()->getRate();
?>




<div id="rewiews">
    <h2>Reviews:</h2>
    <?php
        if(!$reviews)
            echo 'No reviews.';
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

        <div id="links">
            <?php foreach($album as $item): ?>
                <?php if($item->published) ?>
                    <a href = "<?php echo  Yii::app()->baseUrl.'/'.$item->path; ?>" data-dialog>
                        <?php echo CHtml::image(Yii::app()->baseUrl.'/'.Thumbnail::getThumb($item->path), 'Portfolio item'); ?>
                    </a>
                <?php endforeach; ?>
        </div>

    <?php } ?>
    <div id="blueimp-gallery-dialog" data-show="fade" data-hide="fade">
        <!-- The gallery widget  -->
        <div class="blueimp-gallery blueimp-gallery-carousel blueimp-gallery-controls">
            <div class="slides"></div>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="play-pause"></a>
        </div>
    </div>
</div>
