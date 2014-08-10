<script type="text/javascript">
    ymaps.ready(init);
    var myMap;
    var idUser = 1;

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
    }

</script>

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Места какого-то еще одного фотографа</h2>
        <div id="map"></div>
    </div>
    <div class="col-lg-12" id="showImg">
    </div>
</div>