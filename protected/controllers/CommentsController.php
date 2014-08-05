<?php

class CommentsController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionAdd()
    {
        $comm = new Comments;

        // Leave comment
        $_POST['Comments']['user_id'] = Yii::app()->user->id;
        if(isset($_POST['Comments']))
        {
            $comm->attributes = $_POST['Comments'];
            $comm->save();
        }
        $this->render('add', array('model' => $comm));
    }
}