

<div id='submenu'>
    <?php $this->widget('zii.widgets.CMenu',array(
    'items'=>array(
        array('label'=>'Dashboard', 'url'=>array('/cabinet/member/dashboard')),
        array('label'=>'Settings', 'url'=>array('/cabinet/member/account')),
        array('label'=>'Gallery', 'url'=>array('/cabinet/photos/create'))

    ),
));
?>
</div>
<?php
$form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'upload-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )
);

echo $form->labelEx($model, 'img');
echo $form->fileField($model, 'img');
echo $form->error($model, 'img');


echo CHtml::submitButton('Submit');

$this->endWidget();