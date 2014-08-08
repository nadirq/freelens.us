<h1>Page of camerist <?php echo $camerist->login; ?></h1>

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
        foreach($reviews as $r)
        {
    ?>
            <div class="review">
                <?php echo $r->message; ?>
                <br />
                <div class="date"><?php echo $r->created_at ?></div>
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