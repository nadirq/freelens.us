<?php

class PhotosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

    // Lol
	public function accessRules()
	{
		return array(

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete', 'changeMode', 'index', 'view'),
				'roles'=>array('camerist'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


    public function actionChangeMode()
    {

    }

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{


        // Good piece of smachny bydlocode

		$model=new Photos;

 		$this->performAjaxValidation($model);


		if(isset($_POST['Photos']))
		{
            $model->scenario = 'toPortfolio';
			$model->attributes=$_POST['Photos'];
            $model->img = CUploadedFile::getInstance($model, 'img');

            if($model->img)
            {
                $model->path = 'images/'.md5(date('Y-m-d H:i:s:u')) .'.'. $model->img->extensionName;
                $alb = new Albums;
                $alb = $alb->getAlbumId(Yii::app()->user->id);

                $model->album_id = $alb->id;
            }

            if($model->save())
            {
				$model->img->saveAs($model->path); // Save with hash name
                Thumbnail::createThumbs($model->path, 200);

            }
        }

		$this->render('create',array(
			'model'=>$model,
		));
	}


    public function actionDelete()
    {
        //$pic = Photos::model()->findByPk();
        //TODO: make in all app
        $pic = Photos::model()->findByPk(Yii::app()->request->getQuery('photo'));
        if(file_exists($pic->path))
        {
            //var_dump($pic);
            unlink($pic->path);
        }
        if(file_exists(Thumbnail::getThumb($pic->path)))
        {
            unlink(Thumbnail::getThumb($pic->path));
            //var_dump($pic);
        }
        $pic->delete();
        $this->redirect(array('member/dashboard'));
    }



	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Photos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}



	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Photos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Photos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Photos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='photos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
