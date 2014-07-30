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
        // Invalids auth
		if(!isset($users[$this->login]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(!CPasswordHelper::verifyPassword($users[$this->pass], $this->pass))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		// Auth OK
        else
        {
            $this->_id = $users->id;
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