<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 */
class LoginForm extends CFormModel
{
	public $api_key;
	private $_identity;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// api_key are required
			array('api_key', 'required')
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'api_key'=>'Themoviedb API Key',
		);
	}

	/**
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->api_key);
		}
	}

	/**
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->api_key);
			$this->_identity->authenticate();
			if($this->_identity->errorCode===UserIdentity::ERROR_API_KEY)
            {
                $this->addError('api_key','Incorrect api_key.');
            }
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			Yii::app()->user->login($this->_identity);
			return true;
		}
		else
			return false;
	}
}
