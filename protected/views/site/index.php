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


            //запрашиваем все данные по меткам из БД
            $.getJSON("<?php echo Yii::app()->urlManager->createUrl('map/getcamLocation'); ?>",
                function(json){
                    for (i = 0; i < json.marker.length; i++) {
                        alert('lol');
                        var myPlacemark = new ymaps.Placemark([json.marker[i].lat, json.marker[i].lon], {
                                // Свойства
                                balloonContentBody: '<h3>'+json.marker[i].fio+'<h3><img src="'+json.marker[i].avatar+'">'
                            }, {
                                // Опции
                                preset: 'islands#redDotIcon'
                            }
                        );

                        // Добавляем метку на карту
                        myMap.geoObjects.add(myPlacemark);

                    }
                });

        }


    });
</script>