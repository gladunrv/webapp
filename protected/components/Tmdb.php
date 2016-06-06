<?php

class Tmdb extends CApplicationComponent
{
	public $server = 'http://api.themoviedb.org/3/';

	public function api($request_methods, $method, $params=array(), $check = true)
	{
		switch ($request_methods) {
			case 'get':		
				$output = Yii::app()->curl->get( $this->server . $method, $params);
				break;
			case 'post':
				$output = Yii::app()->curl->post( $this->server . $method, $params);
				break;
			case 'put':
				$output = Yii::app()->curl->put( $this->server . $method, $params);
				break;
			case 'delete':
				$output = Yii::app()->curl->delete( $this->server . $method, $params);
				break;
		}

		$resp = CJSON::decode($output, true);

		if( empty($resp['status_code']) || !$check){
			return $resp;
		} else {
			$this->redirect(Yii::app()->request->redirect(Yii::app()->createUrl('site/login')));
		}
	}

	public function authentication($api_key){
		$params = array('api_key'=>$api_key);
		$output = Yii::app()->curl->get($this->server . 'authentication/guest_session/new', $params);
		$resp = CJSON::decode($output, true);
		return $resp;
	}

	public function get($method, $params=array(), $check=true){
		return $this -> api('get', $method, $params, $check);
	}

	public function put($method, $params=array(), $check=true){
		return $this -> api('put', $method, $params, $check);
	}

	public function post($method, $params=array(), $check=true){
		return $this -> api('post', $method, $params, $check);
	}

	public function delete($method, $params=array(), $check=true){
		return $this -> api('delete', $method, $params, $check);
	}
}