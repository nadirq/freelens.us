
<script type="text/javascript">
    ymaps.ready(init);
    var myMap;
    var myPlacemark;
    var idArray = [];
    var idUser = <?php echo $id; ?>;

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
            //создание карты, отцентрированной по местоположению пользователя
            createMap(mapState);
        }, function (e) {
            // Если местоположение невозможно получить, то просто создаем карту.
            createMap({
                center: [55.01, 82.94], //Новосибирск
                zoom: 12,
                controls: ['zoomControl','geolocationControl','searchControl']
            });
        });


        //функция создание карты с полученными данными о местоположении
        function createMap (state) {
            state.zoom = 12;
            //определяем контроллеры на карте
            state.controls = ['zoomControl','geolocationControl','searchControl'];
            //создаем карту в блоке div#map
            myMap = new ymaps.Map('map', state);

            //слушаем клики. По клику передаем географические координаты в форму
            myMap.events.add('click', function (e) {
                //читаем координаты
                var coords = e.get('coords');
                $('#marker_lat').val(coords[0]);
                $('#marker_lon').val(coords[1]);

                //если метка еще не создана - создаем
                //иначе, удаляем старую и создаем новую
                if(typeof(myPlacemark) == 'undefined')
                {
                    myPlacemark = new ymaps.Placemark([coords[0], coords[1]], { }, {
                        preset: 'islands#redDotIcon',
                        draggable: true
                    });
                    myMap.geoObjects.add(myPlacemark);
                }
                else
                {
                    myMap.geoObjects.remove(myPlacemark);
                    myPlacemark = new ymaps.Placemark([coords[0], coords[1]], { }, {
                        preset: 'islands#redDotIcon',
                        draggable: true
                    });
                    myMap.geoObjects.add(myPlacemark);
                }

                //слушаем событие dragend(перетаскивание метки). Переписываем координаты
                myPlacemark.events.add('dragend', function(e){
                    var coords = e.get('target').geometry.getCoordinates();
                    $('#marker_lat').val(coords[0]);
                    $('#marker_lon').val(coords[1]);
                });
            });

            //выводим все метки
            getPlacemarks(idUser);
        }


        //функция проверки заполнения всех полей
        function validate() {
            valid = true;
            //simple validation
            if(!$('#marker_lat').val()||!$('#marker_lon').val()||!$('#marker_balloontext').val()||!$('#marker_name').val()){
                valid = false;
            }
            return valid;
        }


        //поиск по значению в массиве
        //надо для поиска записанных id фоток, готовых к отправке
        function find(array, value) {
            if (array.indexOf) { // если метод существует
                return array.indexOf(value);
            }
            for(var i=0; i<array.length; i++) {
                if (array[i] === value) return i;
            }
            return -1;
        }


        //запрещаем отправку формы
        $('#marker_form').submit(false);


        //выбираем фоточки и добавляем id в массив
        $('a.thumbnail').click(function(){
            //узнаем id фотографии
            idx = $(this).find(':first-child').attr('id');
            //ищем индекс элемента массива со значенем id
            var index = find(idArray, idx);
            //TODO: проверять по индексу а не по классу
            if($(this).hasClass('added_photo')){
                $(this).removeClass('added_photo');
                //дополнительная проверка
                if(index != -1){
                    idArray.splice(index,1);
                }
            }
            else{
                $(this).addClass('added_photo');
                idArray.push(idx);
            }
        });


        //Показать все/мои метки
        $('#change_id').click(function(){
            if(idUser){
                idUser = null;
                getPlacemarks(idUser);
                $(this).text('Показать мои метки');
            }
            else{
                idUser = <?php echo $id; ?>;
                getPlacemarks(idUser);
                $(this).text('Показать все метки');
            }
        });



        //реагируем на нажатие кнопки отправки формы
        $('#addmarker').click(function(){

            if(validate()){
                //переводим js-массив в JSON формат
                photo_ids_json = JSON.stringify(idArray);

                $.ajax({
                    url: "<?php echo Yii::app()->urlManager->createUrl('map/addtomap'); ?>", //Адрес обработчика
                    type:     "POST", //Тип запроса
                    dataType: "html", //Тип данных
                    data: {
                        cam_id: <?php echo $id; ?>,
                        name: $('#marker_name').val(),
                        balloonText: $('#marker_balloontext').val(),
                        lat: $('#marker_lat').val(),
                        lon: $('#marker_lon').val(),
                        photo_ids: photo_ids_json
                    },
                    success: function(response) { //Если все нормально
                        $('#response').text('Место успешно добавлено в нашу базу.');

                        //сбрасываем форму
                        $('#marker_form').trigger('reset');

                        myMap.geoObjects.remove(myPlacemark);
                        getPlacemarks(idUser);
                        //нуллим переменную метки
                        myPlacemark = undefined;

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
    }

</script>



<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?>

<div class="container">
<div class="row">
    <h1 class="page-header">Добавление метки на карту</h1>
    <p>Выберите место на карте. Заполните форму. Сохраните. Радуйтесь.</p>
    <div class="col-lg-8"><h2 class="page-header">1. Выберите место</h2>
        <div id="map" class="map"></div>
        <div class="col-md-offset-10">
            <button id="change_id" class="btn btn-success">Показать все метки</button>
        </div>

    </div> <!--Блок с картой-->

    <div class="col-lg-4">
        <h2 class="page-header">2. Заполните информацию</h2>
        <!-- CONTACT FORM -->
        <form id="marker_form">
            <div id="add_marker">
                <div class="form-group">
                    <label for="marker_name">Название места</label><input class="form-control" type="text" name="marker_name" id="marker_name">
                </div>
                <div class="form-group">
                    <label for="balloon_text">Описание</label><textarea class="form-control" name="balloon_text" id="marker_balloontext" rows="5" cols="25"></textarea><br>
                </div>
                <div class="form-group">
                    <label for="lat">Широта</label><input class="form-control" type="text" name="lat" id="marker_lat" value="" disabled><br>
                </div>
                <div class="form-group">
                    <label for="lon">Долгота</label><input class="form-control" type="text" name="lon" id="marker_lon" value="" disabled><br>
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
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">3. Выберите фотографии для привязки к этому месту</h2>
        <?php
        //выводим все фотки из портфолио
        if(!empty($album)){
            foreach($album as $item){ ?>
                <div class="col-lg-2 col-md-3 col-xs-6">
                    <a class="thumbnail">
                        <!--у каждой фотографии добавляем id равное ее id из БД-->
                        <img class="img-responsive for_check" id="<?php echo $item->id; ?>"
                             src="<?php echo Yii::app()->baseUrl.'/'.Thumbnail::getThumb($item->path); ?>" alt="">
                    </a>
                </div>
            <?php }
        }
        else{
            echo "Фотографии отсутствуют. <a href=".Yii::app()->urlManager->createUrl('cabinet/photos/create').">Загрузить фотографии</a>";
        }?>
    </div>

</div>
    </div>












