
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
    var myGeoObjects = [];

    //запрашиваем все плейсмарки из БД
    $.getJSON("/freelens.us/index.php/map/getmap/"+id,
        function(json){
            for (i = 0; i < json.markers.length; i++) {
                myPlacemark = new ymaps.Placemark([json.markers[i].lat,json.markers[i].lon],
                    {   // Свойства
                        balloonContentHeader : json.markers[i].name,
                        balloonContentBody: json.markers[i].balloonText,
                        myId: json.markers[i].idPlace
                    }, {
                        // Опции
                        preset: json.markers[i].stylePlacemark,
                        hasBalloon: false
                    }
                );

                //вешаем на каждую метку событие 'клик'
                //по клику выводим все фотки, связанные с этой меткой в блок #showImg
                myPlacemark.events.
                    add('click', function (e) {
                        $('#showImg').text('');

                        //e.get('target') возвращает ссылку на объект, вызвавший событие
                        myId = e.get('target').properties.get('myId');
                        myName = e.get('target').properties.get('name');
                        myDesc = e.get('target').properties.get('balloonContentBody');

                        //запрашиваем  из БД все ассоциированные с меткой фотки
                        //id метки передается get параметром
                        $.getJSON("/freelens.us/index.php/map/getCamPhotos/"+myId,
                            function(json){
                                for (i = 0; i < json.photo.length; i++)
                                {
                                    $('#showImg').append('<div><p>'+myDesc+'</p>><img src="/freelens.us/'+json.photo[i].path+'"></div>');
                                }
                            });
                    });

                myGeoObjects.push(myPlacemark);

            }

            clusterer = new ymaps.Clusterer();
            clusterer.add(myGeoObjects);
            myMap.geoObjects.add(clusterer);
        });
}


