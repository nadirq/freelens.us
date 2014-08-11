<div id='avatar'>
    <?php
        echo CHtml::image(Yii::app()->baseUrl.'/'.Thumbnail::getThumb($me->avatar), 'Avatar');
    ?>
</div>
<div id='login'>
    <?php echo $me->login; ?>
</div>

<div id='name'>
    <?php echo $me->fio; ?>
</div>

<div id='about'>
    <?php echo $me->about; ?>
</div>


<h2>My galley</h2>
<div id='gallery'>
    <?php
    if(!$album)
        echo 'No photos in portfolio yet.';
        foreach($album as $item){

            echo CHtml::image(Yii::app()->baseUrl.'/'.Thumbnail::getThumb($item->path), 'Portfolio item');
        }
    ?>
</div>