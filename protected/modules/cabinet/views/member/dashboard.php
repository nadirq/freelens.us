

<div id='submenu'>
    <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
            array('label'=>'Dashboard', 'url'=>array('/cabinet/member/dashboard')),
            array('label'=>'Settings', 'url'=>array('/cabinet/member/account')),
            array('label'=>'Gallery', 'url'=>array('/cabinet/photos/create'))

        ),
    )); ?>
</div>


<div id='avatar'>
    <?php echo CHtml::image($me->avatar, 'your avatar'); ?>
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