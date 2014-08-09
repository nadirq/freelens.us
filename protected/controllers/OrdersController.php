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
            array('allow',
                'actions'=>array('index', 'close'),
                'roles'=>array('user'),
            ),

        );
    }


	public function actionIndex()
	{
        $myOrders = Orders::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
		$camerists = array();
        foreach($myOrders as $o)
            $camerists[] = Users::model()->findByPk($o->cam_id);
        $this->render('index', array('orders' => $myOrders, 'camerists' => $camerists));
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

    public function actionClose()
    {
        $order = Orders::model()->findByPk($_GET['order']);
        $order->scenario = 'status_change';
        $order->status = 'Closed';

        $order->save();
        $this->redirect('../orders/index');
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

            if($orders->save())
                $this->render('congrats');
            else
                $this->render('make', array('model' => $orders, 'busy' => $busy));
        }
        else
            $this->render('make', array('model' => $orders, 'busy' => $busy));
    }

}