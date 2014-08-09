<?php
/**
 * Created by PhpStorm.
 * User: the12chairs
 * Date: 7/30/14
 * Time: 2:42 PM
 */


// Class from RBAC manual


class WebUser extends CWebUser
{
    private $_model = null;

    public function isCamerist()
    {
        if($user = $this->getModel()){


            if($user->role == 'camerist') return true;
            else return false;
        }
        return false;
    }

    public function isUser()
    {
        if($user = $this->getModel()){


            if($user->role == 'user') return true;
            else return false;
        }
        return false;
    }

    public function getRole()
    {
        if($user = $this->getModel()){
            // в таблице User есть поле role
            return $user->role;
        }
    }

    private function getModel()
    {
        if (!$this->isGuest && $this->_model === null)
        {
            $this->_model = Users::model()->findByPk($this->id, array('select' => 'role'));
        }
        return $this->_model;
    }
}