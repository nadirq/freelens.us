
//выборка всех интересных мест из БД
function getPlacemarks(id){



    //TODO: использовать коллекции, вместо удаления всех меток
    myMap.geoObjects.removeAll();

    //запрашиваем все плейсмарки из БД
    $.getJSON("/freelens.us/index.php/map/getmap/"+id,
        function(json){
            for (i = 0; i < json.markers.length; i++) {
                var myPlacemark = new ymaps.Placemark([json.markers[i].lat,json.markers[i].lon],
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

