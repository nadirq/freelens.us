<div class="row">
    <h1 class="page-header">Настройки профиля</h1>


    <div class="col-lg-6">
        <h2>Информация</h2>
        <p>Чем больше информации вы укажете о себе, тем больше вероятность того что
            посетитель выберет вас в качестве своего фотографа. </p>

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
        echo $form->hiddenField($me, 'lat', array('class'=>'form-control'));
        echo '</div>';

        echo '<div class="form-group">';
        echo $form->hiddenField($me, 'lon', array('class'=>'form-control'));
        echo '</div>';


        ?>
    </div>
    <div class="col-lg-6 pull-right">
        <h2>Ваше местоположение</h2>
        <p>Вы можете легко поменять свое расположение и
            потенциальные клиенты могут увидеть что вы приехали в их город и они могут заказать фотосъемку!</p>
        <div id="map" class="map"></div>


    </div>

   <div class="col-lg-2 col-lg-offset-5">
       <?php
       echo '<div class="form-group">';
       echo CHtml::submitButton('Submit', array('class'=>'btn btn-success', 'value' => 'Сохранить изменения'));
       echo '</div>';

       $this->endWidget();
       ?>
   </div>

</div>

<script>

    ymaps.ready(init);
    var myMap;
    var myLocation;

    function init() {
        myId = <?php echo Yii::app()->user->id; ?>
        //создаем карту и центрируем ее на Новосибирск
        myMap = new ymaps.Map('map', {
            center: [55.02, 82.93], // Новосибирск
            zoom: 13,
            controls: ['zoomControl','geolocationControl','searchControl']
        });

        //делаем запрос на местоположение пользователя
        $.getJSON("/freelens.us/index.php/map/getCamLocation/"+myId,
            function(json){

                //если координаты есть, то добавляем метку на карту и цнтрируемся по ней
                if(json.marker[0].lat!=null&& json.marker[0].lon!=null){
                    myLocation = new ymaps.Placemark([json.marker[0].lat, json.marker[0].lon],
                        {
                            balloonContentBody: 'Укажите свое местоположение'
                        }, {
                            // Опции
                            preset: 'islands#geolocationIcon'
                        });
                    myMap.geoObjects.add(myLocation);
                    myMap.setCenter([json.marker[0].lat, json.marker[0].lon]);
                }
            }
        );


        //слушаем клики. По клику записываем
        myMap.events.add('click', function (e) {
            //читаем координаты
            var coords = e.get('coords');
            $('#Users_lat').val(coords[0]);
            $('#Users_lon').val(coords[1]);

            //если метка еще не создана - создаем
            //иначе, удаляем старую и создаем новую
            if(typeof(myLocation) == 'undefined')
            {
                myLocation = new ymaps.Placemark([coords[0], coords[1]], { }, {
                    preset: 'islands#geolocationIcon',
                    draggable: true
                });
                myMap.geoObjects.add(myLocation);
            }
            else
            {
                myMap.geoObjects.remove(myLocation);
                myLocation = new ymaps.Placemark([coords[0], coords[1]], { }, {
                    preset: 'islands#geolocationIcon',
                    draggable: true
                });
                myMap.geoObjects.add(myLocation);
            }

            //слушаем событие dragend(перетаскивание метки). Переписываем координаты
            myPlacemark.events.add('dragend', function(e){
                var coords = e.get('target').geometry.getCoordinates();
                $('#Users_lat').val(coords[0]);
                $('#Users_lon').val(coords[1]);
            });
        });
    }


</script>
