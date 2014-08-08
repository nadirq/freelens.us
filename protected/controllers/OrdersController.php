<?php

class OrdersController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl'
        );
    }



    public function accessRules()
    {
        return array(
            array('deny',
                'actions'=>array('accept', 'decline', 'finish', 'make'), // Guests can't rule the orders
                'users'=>array('?'),
            ),
            array('deny',
                'actions'=>array('make'), // Guests can't rule the orders
                'roles'=>array('camerist'),
            ),
            array('deny',
                'actions'=>array('accept', 'decline', 'finish'),
                'roles'=>array('user'),
            ),
            array('allow',
                'actions'=>array('accept', 'decline', 'finish'), // Camerists can rule the orders, not make orders
                'roles'=>array('camerist'),
            ),
            array('allow',
                'actions'=>array('make'),
                'roles'=>array('user'),
            ),
        );
    }


	public function actionIndex()
	{
		$this->render('index');
	}




    // TODO: bullshit, needs to refactor
    public function actionAccept()
    {
        $order = Orders::model()->findByPk($_GET['order']);
        $order->accepted = true;
        $order->status = 'In progress';
        $order->save();
        $this->redirect('../cabinet/member/job');
    }

    public function actionDecline()
    {
        $order = Orders::model()->findByPk($_GET['order']);
        $order->accepted = false;
        $order->status = 'Refused';
        $order->save();
        $this->redirect('../cabinet/member/job');
    }

    public function actionFinish()
    {
        $order = Orders::model()->findByPk($_GET['order']);
        $order->status = 'Finished';
        $order->save();
        $this->redirect('../cabinet/member/job');
    }

    public function actionMake()
    {
        $camId = $_GET['cam_id'];

        $orders = new Orders;
        $busy = Orders::model()->getBusy($camId);
        if(isset($_POST['Orders']))
        {
            $orders->attributes = $_POST['Orders'];
            $orders->cam_id = $camId;
            $orders->user_id = Yii::app()->user->id;
            $orders->save();

        }
        $this->render('make', array('model' => $orders, 'busy' => $busy));
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