<br />

    <div class="row">

        <div class="col-lg-3">
            <div id='avatar' class="avatar">
                <?php
                echo CHtml::image(Yii::app()->baseUrl.'/'.$camerist->avatar, 'Avatar', array('style'=>'', 'width'=>'350px'));
                ?>
            </div>
            <div id="can">
                <span class="btn btn-success">
                    <?php echo CHtml::link('Забронировать', Yii::app()->createUrl('orders/make', array('cam_id' => $camerist->id))); ?>
                </span>
                <span class="btn btn-danger">
                    <?php echo CHtml::link('Отзыв', Yii::app()->createUrl('/comments/add', array('cam_id' => $camerist->id))); ?>
                </span>
                <span class="btn btn-primary">
                    <?php echo CHtml::link('Места фотографа', Yii::app()->createUrl('/map/showPlaces', array('cam_id' => $camerist->id))); ?>
                </span>
            </div>
        </div>
        <div class="col-lg-4">
            <h2><?php echo $camerist->fio; ?></h2>
            <div id="rating">
                <?php echo 'Рейтинг: <strong> ' . $rate .'</strong>'; ?>
            </div>
            <div id="contacts">
                <?php echo 'Телефон: <strong>' . $camerist->tel .'</strong>'; ?>
                <br />
                <?php echo 'Электропочта: <strong>' . $camerist->email .'</strong>'; ?>
            </div>
            <div id='about'>
                <strong>Обо мне:</strong><br />
                <?php echo $camerist->about; ?>
            </div>

        </div>
        <div class="col-lg-5">
            <div id="map" class="map"></div>
        </div>
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
</div>

<?php }
else{
    echo 'My rate: ' . Users::model()->getRate();
    echo CHtml::link('Я передумал', Yii::app()->createUrl('rating/change'));
}
?>
<!-- rate-->



<div class="row">
    <div id="rewiews">
        <h4>Отзывы от благодарных клиентов</h4>
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
</div>



<div class="row">
    <div id='gallery'>
        <h2>Photographer's portfolio</h2>
        <?php
        if(!$album)
            echo 'No photos in portfolio.';
        else {
            ?>

            <div id="links">
                <?php foreach($album as $item): ?>
                    <?php if($item->published): ?>

                        <a href = "<?php echo  Yii::app()->baseUrl.'/'.$item->path; ?>" data-dialog>
                            <div>
                                <?php echo CHtml::image(Yii::app()->baseUrl.'/'.Thumbnail::getThumb($item->path), 'Portfolio item'); ?>
                            </div>
                        </a>

                    <?php endif; ?>
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
</div>