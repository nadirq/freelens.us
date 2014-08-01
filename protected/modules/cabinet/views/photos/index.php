<?php
/* @var $this PhotosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Photoses',
);

$this->menu=array(
	array('label'=>'Create Photos', 'url'=>array('create')),
	array('label'=>'Manage Photos', 'url'=>array('admin')),
);
?>

<h1>Photoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
