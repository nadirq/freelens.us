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
                'actions'=>array('rate', 'change'),
                'roles'=>array('user'),
            ),
            array('deny',
                'actions'=>array('rate'),
                'roles'=>array('camerist'),
            ),
        );
    }


    public function actionChange()
    {
        Rating::model()->remove(Yii::app()->user->id);
        $this->redirect('index');
    }


    public function actionIndex()
    {

        $rates = Rating::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
        $camerists = array();
        // Just simple getting aims of comments
        foreach($rates as $r)
            $camerists[] = Users::model()->findByPk($r->cam_id);

        $this->render('index', array('rates' => $rates, 'camerists' => $camerists));
    }

    public function actionRate()
    {
        $rating = new Rating;

        $camId = Yii::app()->request->getQuery('cam_id');//$_GET['cam_id'];
        $cam = Camerists::model()->findByPk($camId); // Save camerist for order
        if(isset($_POST['Rating'])){
            $rating->attributes = Yii::app()->request->getPost('Rating');//$_POST['Rating']; // !!!!!!!!!!!!!!!!!!!11
            $rating->cam_id = $camId;
            $rating->user_id = Yii::app()->user->id;
            if($rating->save())
            {
                $this->render('congrats');
                $cam->updateRating();
            }
            else
                $this->render('rate', array('model'=>$rating));
        }
        else
            $this->render('rate', array('model'=>$rating));
    }

}