<div id='submenu'>
    <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
            array('label'=>'Dashboard', 'url'=>array('/cabinet/member/dashboard')),
            array('label'=>'Settings', 'url'=>array('/cabinet/member/account')),
            array('label'=>'Gallery', 'url'=>array('/cabinet/photos/create'))

        ),
    )); ?>
</div>


<h1>Change account details</h1>

<?php


$form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'account-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )
);
?>

<?php
    echo $form->labelEx($me, 'Whats your name?');
    echo $form->TextField($me, 'fio');
    echo $form->error($me, 'fio');
?>
<br />
<?php
    echo $form->labelEx($me, 'Change avatar');
    echo $form->fileField($me, 'avatar');
    echo $form->error($me, 'avatar');
?>
<br />
<?php
    echo $form->labelEx($me, 'Write something about yourself');
    echo $form->TextArea($me, 'about');
    echo $form->error($me, 'about');
?>
<br />
<?php
    echo $form->labelEx($me, 'Enter your email address');
    echo $form->TextField($me, 'email');
    echo $form->error($me, 'email');
?>
<br />
<?php
    echo $form->labelEx($me, 'And your phone number');
    echo $form->TextField($me, 'tel');
    echo $form->error($me, 'tel');


echo CHtml::submitButton('Submit');

$this->endWidget();