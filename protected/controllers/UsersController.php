<?php

class UsersController extends Controller
{



    //TODO: add rules for all controllers
    
    public function actionIndex(){
        var_dump(Yii::app()->user->id);
        $this->render('index');
    }



}