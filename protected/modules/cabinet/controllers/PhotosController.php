<?php
/**
 * Created by PhpStorm.
 * User: admin2
 * Date: 7/31/14
 * Time: 3:45 PM
 */

class PhotosController extends CController{



    public function actionIndex()
    {

        $this->render('index');
    }


    public function actionCreate(){
        $model=new Photos;
        if(isset($_POST['photo'])){
            echo "lol";
            $model->attributes=$_POST['photo'];
            $model->image=CUploadedFile::getInstance($model,'photo');
            if($model->save()){
                $model->image->saveAs('path/to/localFile');
                // перенаправляем на страницу, где выводим сообщение об
                // успешной загрузке
            }
        }
        $this->render('create', array('model'=>$model));
    }
}