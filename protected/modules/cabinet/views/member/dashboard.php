<div class="container">
    <div class="row">

    </div>

    <div id='avatar'>
        <?php
        echo CHtml::image(Yii::app()->baseUrl.'/'.Thumbnail::getThumb($me->avatar), 'Avatar');
        ?>
    </div>

    <div>
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
        ?>

        <?php foreach($album as $item): ?>

            <div class="img">
                <?php echo CHtml::image(Yii::app()->baseUrl.'/'.Thumbnail::getThumb($item->path), 'Portfolio item'); ?>
                <?php echo CHtml::link('Delete', Yii::app()->createUrl('cabinet/photos/delete', array('photo' => $item->id))); ?>
                <?php echo ($item->published == true)? 'Public' : 'Private'?>
            </div>

        <?php endforeach; ?>
    </div>
</div>