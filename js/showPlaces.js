/**
 * Created by admin2 on 8/12/14.
 */

ymaps.ready(init);
var myMap;
var idUser = 2;

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
    clusterer.add(myGeoObjects);
    myMap.geoObjects.add(clusterer);

    for (i = 0; i < json.markers.length; i++) {
        myPlacemark = new ymaps.Placemark([json.markers[i].lon, json.markers[i].lat], {

            balloonContentHeader: '<div style="color:#ff0303;font-weight:bold">'+json.markers[i].cname+'</div>',
            balloonContentBody: '<strong>Адрес:</strong> '+json.markers[i].address,
        });
        myGeoObjects.push(myPlacemark);
    }

}

