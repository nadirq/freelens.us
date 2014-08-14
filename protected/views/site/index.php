<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?>




<div class="row">


    <section>
    <h2 class="page-header">Как это работает?</h2>
        <p>
            Если вы путешествуете один, то в кадре вашей камеры оказываются лишь какие-то здания и,
            в лучшем случае, ваши ноги. Заказывая съемку другому фотографу, героем фотографии становитесь
            вы сами! Как вы иначе всем докажете, что побывали в Лондоне?
</p><p>
            Если вы едете семьей, пусть в кадре будет вся семья! Медовый месяц? Тем более.
            Будьте на снимках вдвоем, будьте рядом. Не отвлекайтесь на значения диафрагмы и выдержки,
            не дергайте прохожих просьбами нажать на спуск. Пусть вашими фотографиями займется тот,
            кто это в этом лучше разбирается, – профессиональный фотограф.
        </p>

    </section>

    <section>

        <h1 class="text-center">Наши&nbsp;фотографы</h1>
        <div id="map" class="map"></div>
    </section>

</div>



















<script type="text/javascript">
    ymaps.ready(function () {
        var myMap;
        var myGeoObjects = [];
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
            // Если место положение невозможно получить, то просто создаем карту.
            createMap({
                center: [55.751574, 83],
                zoom: 12,
                controls: ['zoomControl','geolocationControl']
            });
        });

        function createMap (state) {
            state.zoom = 12;
            //определяем контроллеры на карте
            state.controls = ['zoomControl','geolocationControl'];
            //создание карты, отцентрированной по местоположению пользователя
            myMap = new ymaps.Map('map', state);


            //запрашиваем все данные по меткам из БД
            $.getJSON("<?php echo Yii::app()->urlManager->createUrl('map/getcamLocation'); ?>",
                function(json){
                    for (i = 0; i < json.marker.length; i++) {
                        var myPlacemark = new ymaps.Placemark([json.marker[i].lat, json.marker[i].lon], {
                                // Свойства
                                balloonContentBody: '<h3><a href="'+json.marker[i].id+'">'
                                    +json.marker[i].fio+'</a><h3><img src="'+json.marker[i].avatar+'" width="100">'
                            }, {
                                // Опции
                                preset: 'islands#redDotIcon'
                            }
                        );
                        myGeoObjects.push(myPlacemark);
                    }

                    //создаем кластеризатор
                    clusterer = new ymaps.Clusterer();
                    clusterer.options.set({
                        gridSize: 64
                    });
                    //добавляем в кластеризатор все выбранные объекты
                    clusterer.add(myGeoObjects);
                    // Добавляем метку на карту
                    myMap.geoObjects.add(clusterer);
                });
        }


    });
</script>