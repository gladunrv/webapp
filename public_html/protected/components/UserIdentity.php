<?php

class UserIdentity extends CUserIdentity
{

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