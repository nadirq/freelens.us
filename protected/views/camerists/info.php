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


<h2>Photographer's portfolio</h2>
<div id='gallery'>
    <?php
    foreach($album as $item){

        echo CHtml::image(Yii::app()->baseUrl.'/'.Thumbnail::getThumb($item->path), 'Portfolio item');
    }
    ?>
</div>