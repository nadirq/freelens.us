<?php
header('Content-Type: text/html; charset=utf-8');

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

    // select all Placemarks
    $connect = Yii::app()->db;
    $result = $connect->createCommand()
        ->select('*')
        ->from('map')
        ->query();


    if($result){
        //all placemarks data in JSON
        foreach($result as $value){
            $json = array(style => $value['stylePlacemark'], balloon => $value['balloonText'], lat => $value['lat'], lon => $value['lon']);
            $markers[] = $json;
        }
    }

    $points = array(markers => $markers);
    echo json_encode($points);
}