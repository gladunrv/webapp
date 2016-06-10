<?php

class MovieController extends Controller
{
  
	public function actionIndex($id=false)
	{
		if( empty($id) ){
			$this -> actionAdmin();
		} else {
			$movie=Movie::model()->findByPk($id);

			if( empty($movie) ){
				$movie = $this->getNewData($id);
			}	

			$this->render('index',array(
				'data' => $movie
			));
		}
    }

    public function actionSetRate()
    {
    	$id = Yii::app()->request->getPost('id', 0);
    	$score = Yii::app()->request->getPost('score', 0);
    	$params = array(
    		'value' => $score,
    		'api_key' => Yii::app()->user->api_key,
    		'guest_session_id' => Yii::app()->user->id
    	);
    	$data = Yii::app()->tmdb->post('movie/' . (int)$id . '/rating', $params, false );
    	echo CJSON::encode($data);
  		Yii::app()->end();
    }

    public function saveFile($path)
    {
    	$data = Yii::app()->tmdb->get('configuration', array('api_key'=>Yii::app()->user->api_key) );
    	$contents = file_get_contents( $data['images']['base_url'] . Yii::app()->params['tmdbImageSize'] . $path );
    	file_put_contents( Yii::app()->params['imagesPath'] . $path, $contents );
    	return $path;
    }

    public function getNewData($id)
    {
    	$data = Yii::app()->tmdb->get('movie/' . (int)$id, array('api_key'=>Yii::app()->user->api_key) );
		$movie = new Movie;
		$movie->id = (int)$id;
		$movie->title = $data['title'];
		$movie->original_title = $data['original_title'];
		$movie->release_date = $data['release_date'];
		$movie->runtime = $data['runtime'];
		$movie->overview = $data['overview'];
		$movie->poster_path = $this->saveFile($data['poster_path']);
		$ganres_names = array();
		foreach ($data['genres'] as $k => $v) { 
			$ganres_names[] = $v['name'];
		} 
		$movie->genres = implode(', ',$ganres_names);
		$movie->save();
		return $movie;
    }


    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','guest','delete'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Movie;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Movie']))
        {
            $model->attributes=$_POST['Movie'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Movie']))
        {
            $model->attributes=$_POST['Movie'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }


    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Movie('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Movie']))
            $model->attributes=$_GET['Movie'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Movie the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Movie::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Movie $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='movie-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
}