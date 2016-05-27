<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class RegisterForm extends CFormModel
{
	public $username;
	public $email;
	public $password;
	public $passRepeat;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('username, email, password, passRepeat', 'required'),
			array('username', 'match', 'pattern'=>'/^[a-zA-Zà-ÿÀ-ß0-9_]{3,64}$/', 'message'=>'Username must contain only letters, digits, underscore and be 3 to 64 symbols long.'),
			array('email', 'length', 'max'=>64),
			array('email', 'email'),
			array('username, email', 'unique', 'className' => 'User'),
			array('password', 'length', 'min'=>8),
			array('passRepeat', 'compare', 'compareAttribute'=>'password', 'message'=>'Password is not repeated correctly.'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'=>'Verification Code',
			'passRepeat'=>'Password again'
		);
	}

	public function register()
	{
		$user = new User;
		$user->username = $this->username;
		$user->email = $this->email;
		$user->passhash = CPasswordHelper::hashPassword($this->password);
		return $user->save(false);
	}
}