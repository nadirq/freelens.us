<?php

class RatingController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl'
        );
    }

    public function accessRules()
    {
        return array(
            array('deny',
                'actions'=>array('rate'),
                'users'=>array('?'),
            ),
            array('allow',
                'actions'=>array('rate'),
                'roles'=>array('user'),
            ),
            array('deny',
                'actions'=>array('rate'),
                'roles'=>array('camerist'),
            ),
        );
    }
    public function actionRate()
    {
        $rating = new Rating;

        $camId = $_GET['cam_id'];
        $cam = Camerists::model()->findByPk($camId); // Save camerist for order
        if(isset($_POST['Rating'])){
            $rating->attributes = $_POST['Rating'];
            $rating->cam_id = $camId;
            $rating->user_id = Yii::app()->user->id;
            $rating->save();

        }
        $cam->updateRating();
        $this->render('rate', array('model'=>$rating));
    }

}