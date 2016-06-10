<?php

class SiteController extends Controller
{

	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex()
	{
		if( Yii::app()->user->isGuest ){
			$this->redirect(Yii::app()->createUrl('site/login'));
		} else {		
			$this->redirect(Yii::app()->createUrl('site/top'));
		}
	}

	public function actionTop()
	{
		if( Yii::app()->user->isGuest ){
			$this->redirect(Yii::app()->createUrl('site/login'));
		} else {		
			$count = 1000;
			$pagination = new CPagination($count);
	        $pagination->pageSize = 20; 
			$params = array(
				'api_key'	=> Yii::app()->user->api_key,
				'page'		=> $pagination->currentPage + 1,
				'sort_by'	=> 'popularity.desc'
			);
	    	$data = Yii::app()->tmdb->get('discover/movie', $params );
			$pagination->setItemCount($data['total_results']);

			$this->render('index',array(
	            'data' => $data['results'],
	            'pagination' => $pagination
	        ));
		}
	}

	public function actionNew()
	{
		if( Yii::app()->user->isGuest ){
			$this->redirect(Yii::app()->createUrl('site/login'));
		} else {		
			$count = 1000;
			$pagination = new CPagination($count);
	        $pagination->pageSize = 20;
			$params = array(
				'api_key'	=> Yii::app()->user->api_key,
			 	'page' => $pagination->currentPage + 1,
			  	'primary_release_date.gte' => date("Y-m-d", time() - Yii::app()->params['newMovieInterval'] ),
			  	'primary_release_date.lte' => date("Y-m-d")
			);
			$data = Yii::app()->tmdb->get('discover/movie', $params);
			$pagination->setItemCount($data['total_results']);

			$this->render('index',array(
	            'data' => $data['results'],
	            'pagination' => $pagination
	        ));
		}
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		$this->render('login',array('model'=>$model));
	} 

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->createUrl('site/login'));
	//	$this->redirect(Yii::app()->homeUrl);
	}
}