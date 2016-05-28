<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	
	public function getId()
	{
		return $this->_id;
	}
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->with('auth')->findByAttributes(array('username'=>$this->username));
		if ($user===null)
		{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
			$this->errorMessage='User not found';
		}
		else
		{
			$wait = Yii::app()->userProtector->tryToLogin($user);
			if ($wait)
			{
				$this->errorCode=3;
				$this->errorMessage="Login disabled for this account for next $wait seconds.";
			}
			else if (!CPasswordHelper::verifyPassword($this->password,$user->passhash))
			{
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
				$this->errorMessage='Incorrect password';
				Yii::app()->userProtector->loginFailed($user);
			}
			else
			{
				$this->_id=$user->id;
				$this->errorCode=self::ERROR_NONE;
			}
		}
		return !$this->errorCode;
	}
}