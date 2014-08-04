<?php
/* @var $this PhotosController */
/* @var $model Photos */

$this->breadcrumbs=array(
	'Photoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Photos', 'url'=>array('index')),
	array('label'=>'Manage Photos', 'url'=>array('admin')),
);
?>

<h1>Create Photos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>