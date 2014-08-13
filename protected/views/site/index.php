<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?>




<div class="row">
<!-- Start slider-->
<section id="home">
    <div class="homeslider">
        <div class="homeimage">
            <div class="center-block">
                <h1>гавно какое-то</h1>
            </div>

        </div>

    </div><!--/ homeslider-->

</section>
<!-- End slider-->

<h1 class="page-header center_head">Наши&nbsp;фотографы</h1>
<div id="map" class="map"></div>

</div>



















<script type="text/javascript">
    ymaps.ready(function () {
        var myMap;
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
            //добавление метки для примера
            myMap.geoObjects.add(new ymaps.Placemark([55,83], {
                    balloonText: 'lol'
                },
                {
                    //Свое изображение на метке
                    // Необходимо указать данный тип макета.
                    iconLayout: 'default#image',
                    // Своё изображение иконки метки.
                    iconImageHref: '/freelens.us/images/myIcon.png',
                    // Размеры метки.
                    iconImageSize: [25, 32],
                    // Смещение левого верхнего угла иконки относительно
                    // её "ножки" (точки привязки).
                    iconImageOffset: [-12.5, -32]

                }));


            //запрашиваем все данные по меткам из БД
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


    });
</script>