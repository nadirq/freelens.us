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

    function getRole()
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
            $this->_model = User::model()->findByPk($this->id, array('select' => 'role'));
        }
        return $this->_model;
    }
}