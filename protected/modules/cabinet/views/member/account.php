<div class="row">
    <h1 class="page-header">Настройки профиля</h1>


        <div class="col-lg-6">
            <h2>Информация</h2>

            <?php

            $form = $this->beginWidget(
                'CActiveForm',
                array(
                    'id' => 'account-form',
                    'enableAjaxValidation' => true,
                    'htmlOptions' => array('enctype' => 'multipart/form-data',
                        'class'=>'form_group'),
                )
            );
            ?>

            <?php echo $form->errorSummary($me); ?>

            <?php

            echo '<div class="form-group">';
            echo $form->labelEx($me, 'Имя');
            echo $form->TextField($me, 'fio', array('class'=>'form-control'));
            echo '</div>';

            echo '<div class="form-group">';
            echo $form->labelEx($me, 'E-mail');
            echo $form->TextField($me, 'email', array('class'=>'form-control'));
            echo '</div>';

            echo '<div class="form-group">';
            echo $form->labelEx($me, 'Номер телефона');
            echo $form->TextField($me, 'tel', array('class'=>'form-control'));
            echo '</div>';

            echo '<div class="form-group">';
            echo $form->labelEx($me, 'Сменить аватар');
            echo $form->fileField($me, 'img', array('class' => 'btn btn-info'));
            echo '</div>';

            echo '<div class="form-group">';
            echo $form->labelEx($me, 'Write something about yourself');
            echo $form->TextArea($me, 'about', array('class'=>'form-control'));
            echo '</div>';

            echo '<div class="form-group">';
            echo CHtml::submitButton('Submit', array('class'=>'btn btn-success'));
            echo '</div>';

            $this->endWidget();
            ?>
        </div>
        <div class="col-lg-6 pull-right">
            <h2>Ваше местоположение</h2>
            <p>Вы можете легко поменять свое расположение и
                потенциальные клиенты могут увидеть что вы приехали в их город и они могут заказать фотосъемку!</p>
            <div id="map" class="map"></div>

        </div>

</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/showPlaces.js"></script>
