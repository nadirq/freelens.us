<?php

class MapController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}





    public function accessRules()
    {
        return array(
            array('deny',
                'actions'=>array('newPlacemark'),
                'users'=>('?'),
            ),
            array('deny',
                'actions'=>array('newPlacemark'),
                'roles'=>('user'),
            ),
            array('allow',
                'actions'=>array('showPlaces'),
                'users'=>array('?'),
            ),
            array('allow',
                'actions'=>array('newPlacemark', 'upload'),
                'roles'=>array('camerist'),
            ),
        );
    }


    /*
     * Страница добавления новой места на карте.
     * TODO: сделать разрешение доступа только для фотографов
     */
    public function actionNewPlacemark()
    {
        $album = Albums::model()->getAlbumId(Yii::app()->user->id);
        $id = Yii::app()->user->id;
        $this->render('newPlacemark', array('id' => $id, 'album' => $album->getPhotos()));
    }




    // Uploader
    public function actionUpload()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $folder='images/';// folder for uploaded files
        $allowedExtensions = array('jpg', 'png');//array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);

        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        //$fileId=$result['id'];//Here file id

        echo $return; // it's array
    }



    /*
     * страница вывода меток опрееленного фотографа
     */
    public function actionShowPlaces() {

        $this->render('showPlaces');
    }

    public function actionGetCamPhotos(){
        header('Content-Type: text/html; charset=utf-8');
        $connect = Yii::app()->db;
        $id = $_GET['id'];


        $sql = "select * from photos where id in(
            select photo_id from placemark_photos WHERE placemark_id = $id )";

        $result = $connect->createCommand($sql)->query();

        if($result){
            //all photo data in JSON
            foreach($result as $value){
                $json = array(
                    'id' => $value['id'],
                    'path' => Thumbnail::getThumb($value['path']),
                    'desc' => $value['desc']
                );

                $photo[] = $json;
            }

        }

        $photos = array('photo' => $photo);
        echo json_encode($photos);
    }


    /*
     * Отдает на выход массив маркеров в JSON формате
     */
    public function actionGetMap(){
        header('Content-Type: text/html; charset=utf-8');
        $connect = Yii::app()->db;

        //если id пользователя передан, ищем по нему,
        //иначе выбираем все записи
        if(isset($_GET['id'])){
            $result = $connect->createCommand()
                ->select('*')
                ->from('map')
                ->where('cam_id=:id', array(':id'=>Yii::app()->request->getQuery('id')))
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
                'idPlace' => $value['id'],
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


    /*
     * Звнесение новой метки в БД
     */
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



    public function actionGetCamLocation(){

        header('Content-Type: text/html; charset=utf-8');
        $connect = Yii::app()->db;
        if(isset($_GET['id'])){
        $result = $connect->createCommand()
            ->select('*')
            ->from('users')
            ->where('id=:id', array(':id'=>$_GET['id']))
            ->queryRow();

            var_dump($result);
        }
        else{
            $result = $connect->createCommand()
                ->select('*')
                ->from('users')
                ->where('')
                ->queryAll();
        }

        if($result){
            var_dump($result);
            //lat and lon in JSON array

                $json = array(
//                    'lat' => $value['lat'],
//                    'lon' => $value['lon'],
//                    'fio' => $value['fio'],
//                    'id' => $value['id'],
//                    'avatar' => $value['avatar']
                );

                $marker[] = $json;

        }

        $location = array('marker' => $marker);
        echo json_encode($location);

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