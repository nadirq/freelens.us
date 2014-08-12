<?php
/* @var $this CameristsController */
/* @var $camerist Users */

$this->breadcrumbs=array(
	'Camerists',
);
?>
<h1>Our photographers</h1>

<p>
    <?php foreach($camerists as $camerist): ?>
        <div class = "row" >
            <div id='avatar'>
                <?php
                    echo CHtml::image(Yii::app()->baseUrl.'/'.Thumbnail::getThumb($camerist->avatar), 'Avatar');
                ?>
            </div>
            <?php echo $camerist->login; ?>
            <?php echo $camerist->camerists->rate; ?>
           <?php echo CHtml::link('Info', Yii::app()->createUrl('/camerists/info', array('cam_id' => $camerist->id))); ?>
        </div>
        <br />
    <?php endforeach; ?>

<?php
    $this->widget('CLinkPager', array(
        'pages' => $pages,
    ));
?>

</p>

<script>
    $(document).ready(function(){
        $('.bxslider').bxSlider();
    });
</script>