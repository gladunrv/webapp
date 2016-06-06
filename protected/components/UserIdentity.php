<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */

	const ERROR_API_KEY = 7;

	private $_id;

	public $api_key;

	public function __construct($api_key){
		$this->api_key = $api_key;
	}

	public function authenticate()
	{

    	$resp = Yii::app()->tmdb->get('authentication/guest_session/new', array('api_key'=>$this->api_key), false );

		if( !isset($resp['success']) )
		{
			$this->errorCode=self::ERROR_API_KEY;
		} else {
            $this->_id = $resp['guest_session_id'];
            $this->setState('api_key', $this->api_key);
            $this->setState('expires_at', $resp['expires_at']);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	public function getId()
    {
        return $this->_id;
    }
}