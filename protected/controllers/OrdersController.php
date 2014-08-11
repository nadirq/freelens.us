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

        // for pagination

        $criteria = new CDbCriteria();
        $criteria->condition = 'user_id = :u_id';
        $criteria->order = 'id desc';
        $criteria->params = array(':u_id' => Yii::app()->user->id);
        $count = Orders::model()->count($criteria);
        $pages = new CPagination($count);

        $pages->pageSize = 10; // 10 orders per page
        $pages->applyLimit($criteria);

        $myOrders = Orders::model()->findAll($criteria); //Orders::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
		$camerists = array();
        foreach($myOrders as $o)
            $camerists[] = Users::model()->findByPk($o->cam_id);
        $this->render('index', array('orders' => $myOrders, 'camerists' => $camerists, 'pages' => $pages));
	}




    // TODO: bullshit, needs to refactor
    public function actionAccept()
    {

        $order = Orders::model()->findByPk(Yii::app()->request->getQuery('order'));
        $order->scenario = 'status_change';
        $order->accepted = true;
        $order->status = 'In progress';
        $order->save();
        $this->redirect('../cabinet/member/job');
    }

    public function actionDecline()
    {
        $order = Orders::model()->findByPk(Yii::app()->request->getQuery('order'));
        $order->scenario = 'status_change';
        $order->accepted = false;
        $order->status = 'Refused';

        $order->save();
        $this->redirect('../cabinet/member/job');
    }

    public function actionFinish()
    {
        $order = Orders::model()->findByPk(Yii::app()->request->getQuery('order'));
        $order->scenario = 'status_change';
        $order->status = 'Finished';

        $order->save();
        $this->redirect('../cabinet/member/job');
    }

    public function actionClose()
    {
        $order = Orders::model()->findByPk(Yii::app()->request->getQuery('order'));
        $order->scenario = 'status_change';
        $order->status = 'Closed';

        $order->save();
        $this->redirect('../orders/index');
    }


    public function actionMake()
    {
        $camId = Yii::app()->request->getQuery('cam_id');

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