<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    protected $_id; // user id
    protected $_login;

	public function authenticate()
	{
        $record = Users::model()->findByAttributes(array('login'=>$this->username));

        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!CPasswordHelper::verifyPassword($this->password,$record->pass))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$record->id;
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
	}

    public function getId()
    {
        return $this->_id;
    }

    public function getLogin(){
        return $this->_login;
    }

}