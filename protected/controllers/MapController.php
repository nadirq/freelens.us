<?php

class MapController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    /*
     * Отдает на выход массив маркеров в JSON формате
     */
    public function actionGetMap(){
        header('Content-Type: text/html; charset=utf-8');
        $connect = Yii::app()->db;
        $result = $connect->createCommand()
            ->select('*')
            ->from('map')
            ->query();


        if($result){
            //all placemarks data in JSON
            foreach($result as $value){
            $json = array('stylePlacemark' => $value['stylePlacemark'], 'balloonText' => $value['balloonText'], 'lat' => $value['lat'], 'lon' => $value['lon']);
            $markers[] = $json;
            }
        }

        $points = array('markers' => $markers);
        echo json_encode($points);

    }


    public function actionAddToMap(){
        header('Content-Type: text/html; charset=utf-8');

        $connect = Yii::app()->db;

        $iconText = htmlspecialchars($_POST['icontext']);
        $hintText = htmlspecialchars($_POST['hinttext']);
        $balloonText = htmlspecialchars($_POST['balloontext']);
        $stylePlacemark = $_POST['styleplacemark'];
        $lat = $_POST['lat'];
        $lon = $_POST['lon'];

        $sql = "INSERT INTO map (`iconText`, `hintText`, `balloonText`, `stylePlacemark`, `lat`, `lon`) VALUES ('$iconText', '$hintText', '$balloonText', '$stylePlacemark', '$lat', '$lon');";

        $result = $connect->createCommand($sql);
        $result->execute();
    }

    

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}