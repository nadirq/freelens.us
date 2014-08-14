<?php

class CommentsController extends Controller
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
                'actions'=>array('add'),
                'users'=>array('?'),
            ),
            array('deny',
                'actions'=>array('add'),
                'roles'=>array('camerist'),
            ),
            array('allow',
                'actions'=>array('add', 'remove'),
                'roles'=>array('user'),
            ),

        );
    }


    public function actionRemove()
    {
        Comments::model()->remove($_GET['comm']);
        $this->redirect('index');
    }

	public function actionIndex()
	{
        $reviews = Comments::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
        $camerists = array();
        // Just simple getting aims of comments
        foreach($reviews as $r)
            $camerists[] = Users::model()->findByPk($r->cam_id);

        $this->render('index', array('reviews' => $reviews, 'camerists' => $camerists));
	}

    public function actionAdd()
    {
        $comm = new Comments;

        // Leave comment

        if(isset($_POST['Comments']))
        {
            $comm->user_id = Yii::app()->user->id;
            $comm->cam_id = $_GET['cam_id'];
            $comm->attributes = Yii::app()->request->getPost('Comments');//$_POST['Comments'];
            if($comm->save())
                $this->render('congrats');
            else
                $this->render('add', array('model' => $comm));
        }
        else
        $this->render('add', array('model' => $comm));
    }


}


