<script type="text/javascript">
    ymaps.ready(init);
    var myMap;
    var idUser = <?php if(isset($_GET['cam_id'])){echo Yii::app()->request->getQuery('cam_id');}
                        else{ echo 'undefined'; } ?>;

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

            //выводим все метки
            getCamPlaces(idUser);
        }

        clusterer = new ymaps.Clusterer();
        clusterer.options.set({
            gridSize: 64
        });
        clusterer.add(myGeoObjects);
        myMap.geoObjects.add(clusterer);

        for (i = 0; i < json.markers.length; i++) {
            myPlacemark = new ymaps.Placemark([json.markers[i].lon, json.markers[i].lat], {

                balloonContentHeader: '<div style="color:#ff0303;font-weight:bold">'+json.markers[i].name+'</div>',
                balloonContentBody: '<strong>Адрес:</strong> '+json.markers[i].balloonText
            });
            myGeoObjects.push(myPlacemark);
        }

    }

</script>

<div class="row">
    <h2 class="page-header">Места какого-то еще одного фотографа</h2>

    <div class="col-lg-6">
        <div id="map" class="map"></div>
    </div>
    <div class="col-lg-6" id="showImg">

    </div>
</div>

<div id="blueimp-gallery-dialog" data-show="fade" data-hide="fade">
    <!-- The gallery widget  -->
    <div class="blueimp-gallery blueimp-gallery-carousel blueimp-gallery-controls">
        <div class="slides"></div>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="play-pause"></a>
    </div>
</div>

<br />
<br />