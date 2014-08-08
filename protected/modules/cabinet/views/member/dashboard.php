<div id='avatar'>
    <?php
        echo CHtml::image(Yii::app()->baseUrl.'/'.str_replace('images/', 'images/small_', $me->avatar), 'Avatar');
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
        foreach($album as $item){

            echo CHtml::image(Yii::app()->baseUrl.'/'.$item->getThumb(), 'Portfolio item');
        }
    ?>
</div>