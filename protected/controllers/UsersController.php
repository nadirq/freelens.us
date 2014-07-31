<?php

class UsersController extends Controller
{

    public function actionIndex(){
        var_dump(Yii::app()->user->id);
        $this->render('index');
    }



}