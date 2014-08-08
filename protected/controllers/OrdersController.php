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
                'actions'=>array('make'),
                'roles'=>array('camerist'),
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
        $order->scenario = 'status_change';
        $order->accepted = true;
        $order->status = 'In progress';
        $order->save();
        $this->redirect('../cabinet/member/job');
    }

    public function actionDecline()
    {
        $order = Orders::model()->findByPk($_GET['order']);
        $order->scenario = 'status_change';
        $order->accepted = false;
        $order->status = 'Refused';

        $order->save();
        $this->redirect('../cabinet/member/job');
    }

    public function actionFinish()
    {
        $order = Orders::model()->findByPk($_GET['order']);
        $order->scenario = 'status_change';
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

}