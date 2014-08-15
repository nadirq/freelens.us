
<div class="row">
    <h3 class="page-header">Добавить фотографии</h3>
    <p>Загрузите самые лучшие свои фотографии, чтобы ваш профиль выглядел выгоднее на фоне других! Отличайтесь!</p>
<?php
$form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'upload-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )
);

echo $form->fileField($model, 'img');
echo $form->error($model, 'img');


echo CHtml::submitButton('Загрузить',array('class' => 'btn btn-success pull-right'));

$this->endWidget();
?>
</div>