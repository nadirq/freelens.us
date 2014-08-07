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