<?php
header('Content-Type: text/html; charset=utf-8');



$connect = Yii::app()->request->db;

var_dump($connect);

    $result = $connect->createCommand()
        ->select('*')
        ->from('map')
        ->query();



    if($result){
        //all placemarks data in JSON
        foreach($result as $value){
            var_dump($value);
//            $json = array(stylePlacemark => $value['stylePlacemark'], balloonText => $value['balloonText'], lat => $value['lat'], lon => $value['lon']);
//            $markers[] = $json;
        }
    }

    $points = array(markers => $markers);
    echo json_encode($points);
