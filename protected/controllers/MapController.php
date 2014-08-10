<?php

class MapController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionAddPlacemark()
    {
        $album = Albums::model()->getAlbumId(Yii::app()->user->id);
        $id = Yii::app()->user->id;
        $this->render('addPlacemark', array('id' => $id, 'album' => $album->getPhotos()));
    }


    /*
     * Отдает на выход массив маркеров в JSON формате
     */
    public function actionGetMap(){

        header('Content-Type: text/html; charset=utf-8');
        $connect = Yii::app()->db;

        if(isset($_GET['id'])){
            $result = $connect->createCommand()
                ->select('*')
                ->from('map')
                ->where('cam_id=:id', array(':id'=>$_GET['id']))
                ->query();

        }
        else{
        $result = $connect->createCommand()
            ->select('*')
            ->from('map')
            ->query();
        }

        if($result){
            //all placemarks data in JSON
            foreach($result as $value){
            $json = array(
                'name' => $value['name'],
                'stylePlacemark' => $value['stylePlacemark'],
                'balloonText' => $value['balloonText'],
                'lat' => $value['lat'],
                'lon' => $value['lon']
            );

            $markers[] = $json;
            }
        }

        $points = array('markers' => $markers);
        echo json_encode($points);

    }


    public function actionAddToMap(){
        //TODO: создать транзакцию, написать подготавливаемые запросы

        header('Content-Type: text/html; charset=utf-8');

        $connect = Yii::app()->db;

        $cam_id = htmlspecialchars($_POST['cam_id']);
        $name = htmlspecialchars($_POST['name']);
        $balloonText = htmlspecialchars($_POST['balloonText']);
        $lat = $_POST['lat'];
        $lon = $_POST['lon'];

        $connect->createCommand()->insert('map', array(
            'cam_id' => $cam_id,
            'name' => $name,
            'balloonText' => $balloonText,
            'lat' => $lat,
            'lon' => $lon
        ));


        $place_id = $connect->getLastInsertID();
        $photo_ids = json_decode($_POST['photo_ids']);


        foreach($photo_ids as $value){
            $connect->createCommand()->insert('placemark_photos', array(
                'placemark_id' => $place_id,
                'photo_id' => $value
            ));
        }

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