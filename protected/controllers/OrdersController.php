<?php

class OrdersController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}




    public function actionMake()
    {
        $camId = $_GET['cam_id'];
        $cam = Camerists::model()->findByPk($camId); // Save camerist for order
        $orders = new Orders;

        if(isset($_POST['calendar']) && isset($_POST['Orders']['price']))
        {

            $orders->makeOrder(Yii::app()->user->id, $cam->user_id, $_POST['calendar'], $_POST['Orders']['price']);


        }
        $this->render('make', array('model' => $orders));
    }



	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}