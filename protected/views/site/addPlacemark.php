<script src="//yandex.st/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
    ymaps.ready(init);
    var myMap;

    function init() {
        //запрашиваем местоположение
        ymaps.geolocation.get().then(function (res) {
            var mapContainer = $('#map'),
                bounds = res.geoObjects.get(0).properties.get('boundedBy'),
            // Рассчитываем видимую область для текущей положения пользователя.
                mapState = ymaps.util.bounds.getCenterAndZoom(
                    bounds,
                    [mapContainer.width(), mapContainer.height()]
                );
            createMap(mapState);
        }, function (e) {
            // Если местоположение невозможно получить, то просто создаем карту.
            createMap({
                center: [55.751574, 87], //Новосибирск
                zoom: 12,
                controls: ['zoomControl','geolocationControl','searchControl']
            });
        });


    }



    //создаем карту с полученными данными о местоположении
    function createMap (state) {
        state.zoom = 12;
        //определяем контроллеры на карте
        state.controls = ['zoomControl','geolocationControl','searchControl'];
        //создание карты, отцентрированной по местоположению пользователя
        myMap = new ymaps.Map('map', state);

        //слушаем клики. По клику передаем географические координаты в форму
        myMap.events.add('click', function (e) {

            //если метка еще не создана - разрешаем действие, иначе
            //при клике ничего не произойдет
            if(typeof (myPlacemark) == 'undefined')
            {
                var coords = e.get('coords');
                $('#marker_lat').val(coords[0]);
                $('#marker_lon').val(coords[1]);

                myPlacemark = new ymaps.Placemark([coords[0], coords[1]], {

                }, {
                        preset: 'islands#redDotIcon',
                        draggable: true

                    });

                myMap.geoObjects.add(myPlacemark);
            }
            else{
                RemoveFromMap(myPlacemark);
            }

            //слушаем событие dragend. Переписываем координаты
            myPlacemark.events.add('dragend', function(e){
                var coords = e.get('target').geometry.getCoordinates();
                $('#marker_lat').val(coords[0]);
                $('#marker_lon').val(coords[1]);
            });
        });

        //выводим все метки
        getPlacemarks();
    }


    //выборка всех интересных мест из БД
    function getPlacemarks(){
        //запрашиваем все плейсмарки из БД
        $.getJSON("<?php echo Yii::app()->urlManager->createUrl('map/getmap'); ?>",
            function(json){
                for (i = 0; i < json.markers.length; i++) {
                    var myPlacemark = new ymaps.Placemark([json.markers[i].lat,json.markers[i].lon], {
                            // Свойства
                            balloonContentBody: json.markers[i].balloonText
                        }, {
                            // Опции
                            preset: json.markers[i].stylePlacemark
                        }
                    );
                    // Добавляем метку на карту
                    myMap.geoObjects.add(myPlacemark);
                }
            });
    }




    $(document).ready(function () {


        //функция проверки заполнения всех полей
        function validate() {
            valid = true;
            if(!$('#marker_lat').val()||!$('#marker_lon').val()||!$('#marker_balloontext').val()){
                valid = false;
            }

            return valid;
        }


        $('#marker_form').submit(false);


        $('#addmarker').click(function(){

            if(validate()){

            $.ajax({
                url: "<?php echo Yii::app()->urlManager->createUrl('map/addtomap'); ?>", //Адрес обработчика
                type:     "POST", //Тип запроса
                dataType: "html", //Тип данных
                data: {
                    lat: $('#marker_lat').val(),
                    lon: $('#marker_lon').val(),
                    balloonText: $('#marker_balloontext').val()
                },
                success: function(response) { //Если все нормально
                    $('#response').text('Место успешно добавлено в нашу базу.');
                    $('#marker_form').trigger('reset')

                    myMap.reload();

                },
                error: function(response) { //Если ошибка
                    $('#response').text('Ошибка.');
                }
            });
            }
            else{
                $('#response').text('Заполните все поля!');
            }



        });



    });

</script>


<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?>
<h1>Добавление метки на карту</h1>
<p>Выберите место на карте. Заполните форму. Сохраните. Радуйтесь.</p>

<div class="row">
    <div class="col-lg-8"><div id="map"></div></div> <!--Блок с картой-->

    <div class="col-lg-4">
        <!-- CONTACT FORM -->
        <form id="marker_form">
        <div id="add_marker">

            <div class="form-group">
                <label for="lat">Широта</label><input class="form-control" type="text" name="lat" id="marker_lat" value="" disabled><br>
            </div>
            <div class="form-group">
                <label for="lon">Долгота</label><input class="form-control" type="text" name="lon" id="marker_lon" value="" disabled><br>
            </div>
            <div class="form-group">
                <label for="balloon_text">Описание(поддерживается Html)</label><textarea class="form-control" name="balloon_text" id="marker_balloontext" rows="5" cols="25"></textarea><br>
            </div>

        </div>
        <div class="form-group">
            <label for="submit">&nbsp;</label><input class="btn btn-lg btn-info" type="submit" name="submit" id="addmarker" value="Добавить">
        </div>
        <div id="response"></div>
        </form>
    </div>
    <!-- END CONTACT FORM -->

</div>

