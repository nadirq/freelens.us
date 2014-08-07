<?php

class MapController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionGetmap(){
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