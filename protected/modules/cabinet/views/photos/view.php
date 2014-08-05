<?php
/* @var $this PhotosController */
/* @var $model Photos */

$this->breadcrumbs=array(
	'Photoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Photos', 'url'=>array('index')),
	array('label'=>'Create Photos', 'url'=>array('create')),
	array('label'=>'Update Photos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Photos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Photos', 'url'=>array('admin')),
);
?>

<h1>View Photos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'path',
		'album_id',
	),
)); ?>
