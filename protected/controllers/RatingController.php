<?php

class RatingController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl'
        );
    }

	public function actionIndex()
	{

	}

    public function actionRate()
    {
        $rating = new Rating;
        $this->render('rate', array('model'=>$rating));
        $camId = $_GET['cam_id'];
        $cam = Camerists::model()->findByPk($camId); // Save camerist for order
        if(isset($_POST['Rating'])){
            // TODO: add check for unique (Already in DB)
            $rating->attributes = $_POST['Rating'];
            $rating->cam_id = $camId;
            $rating->user_id = Yii::app()->user->id;
            $rating->save();
        }
    }

}