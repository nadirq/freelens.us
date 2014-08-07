<script src="//yandex.st/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
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
                center: [55.751574, 37.573856],
                zoom: 12,
                controls: ['zoomControl','geolocationControl']
            });
        });

        function createMap (state) {
            state.zoom = 12;
            state.controls = ['zoomControl','geolocationControl'];
            myMap = new ymaps.Map('map', state);
            myMap.geoObjects.add(new ymaps.Placemark([55,83], {
                balloonText: 'lol'
            },
                {
                preset: 'islands#redIcon'

            }));


        $.getJSON("mapOutput.php",
            function(json){
               for (i = 0; i < json.markers.length; i++) {
                    var myPlacemark = new ymaps.Placemark([json.markers[i].lat,json.markers[i].lon], {
                        // Свойства
                        balloonContentBody: json.markers[i].balloon
                    }, {
                        // Опции
                        preset: json.markers[i].stylePlacemark
                    });

                    // Добавляем метку на карту
                    myMap.geoObjects.add(myPlacemark);

                }
            });

}


    });







</script>

<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?>
<h1>Welcome!</h1>
<!--<p>Этот сервис предназначен для поиска фотографов и интересных мест для съемки.-->
<!--    На карте вы можете выбрать интересные места и заказать съемку именно в этом месте. Также можете указать свое место, где бы вы хотели пофотографироваться. </p>-->

<div id="map"></div>














<!--<iframe width="100%" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.ru/maps?ie=UTF8&amp;ll=55.031638,82.921715&amp;spn=0.024276,0.063643&amp;t=m&amp;z=15&amp;output=embed"></iframe><br />-->



