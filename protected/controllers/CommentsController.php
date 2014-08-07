<?php

class CommentsController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl'
        );
    }

	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionAdd()
    {
        $comm = new Comments;

        // Leave comment

        if(isset($_POST['Comments']))
        {
            $comm->user_id = Yii::app()->user->id;
            $comm->cam_id = $_GET['cam_id'];
            $comm->attributes = $_POST['Comments'];
            $comm->save();
            $this->redirect('../camerists/index');
        }
        $this->render('add', array('model' => $comm));
    }
}