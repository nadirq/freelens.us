<?php
/**
 * Created by PhpStorm.
 * User: the12chairs
 * Date: 7/30/14
 * Time: 2:44 PM
 */



class PhpAuthManager extends CPhpAuthManager
{
    public function init(){
        // roles in config/auth.php
        if($this->authFile === null){
            $this->authFile = Yii::getPathOfAlias('application.config.auth').'.php';
        }

        parent::init();

        // Default role: guest
        if(!Yii::app()->user->isGuest)
        {
            $this->assign(Yii::app()->user->role, Yii::app()->user->id);
        }
    }
}