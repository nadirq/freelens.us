
//выборка всех интересных мест из БД
var myPlacemark;
var idPlace;

function getPlacemarks(id){

    //TODO: использовать коллекции, вместо удаления всех меток
    myMap.geoObjects.removeAll();

    //запрашиваем все плейсмарки из БД
    $.getJSON("/freelens.us/index.php/map/getmap/"+id,
        function(json){
            for (i = 0; i < json.markers.length; i++) {
                 myPlacemark = new ymaps.Placemark([json.markers[i].lat,json.markers[i].lon],
                    {                            // Свойства
                        balloonContentBody: '<h2>'+json.markers[i].name+'</h2>'+json.markers[i].balloonText
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

function getCamPlaces(id){

    //запрашиваем все плейсмарки из БД
    $.getJSON("/freelens.us/index.php/map/getmap/"+id,
        function(json){
            for (i = 0; i < json.markers.length; i++) {
                myPlacemark = new ymaps.Placemark([json.markers[i].lat,json.markers[i].lon],
                    {                            // Свойства
                        balloonContentBody: '<h2>'+json.markers[i].name+'</h2>'+json.markers[i].balloonText+
                            '<input type="text" value="'+json.markers[i].idPlace +'">'
                    }, {
                        // Опции
                        preset: json.markers[i].stylePlacemark
                    }
                );

                myPlacemark.events.
                    add('click', function () {
//                       alert(myPlacemark.getBalloonContent());



                    });

                // Добавляем метку на карту
                myMap.geoObjects.add(myPlacemark);
            }
        });
}


