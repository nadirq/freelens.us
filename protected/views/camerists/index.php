<?php
/* @var $this CameristsController */
/* @var $camerist Users */

$this->breadcrumbs=array(
    'Camerists',
);
?>
<h2 class="page-header">Our photographers</h2>

<p>
    <?php foreach($camerists as $camerist): ?>
    <div class = "row user_list" >
        <div class="col-lg-2">
            <div class='avatar_list'>
                <?php
                echo CHtml::image(Yii::app()->baseUrl.'/'.Thumbnail::getThumb($camerist->avatar), 'Avatar');
                ?>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="fio">
                <h4><?php echo CHtml::link($camerist->fio, Yii::app()->createUrl('/camerists/info', array('cam_id' => $camerist->id))); ?></h4>
            </div>
            <?php echo 'Рейтинг: '.$camerist->camerists->rate; ?>
        </div>
        <div class="col-lg-8">
            <div class="photo_list">
                
            </div>
        </div>


    </div>
<br />
<?php endforeach; ?>

<?php
$this->widget('CLinkPager', array(
    'pages' => $pages,
));
?>



