<?php

class MemberController extends Controller
{
    public function actionDashboard()
    {

        $usr = Users::model()->findByPk(Yii::app()->user->id);

        $rate = Camerists::model()->findByPk(Yii::app()->user->id)->rate;
        $album = Albums::model()->getAlbumId(Yii::app()->user->id);

        $this->render('dashboard', array('me' => $usr, 'rate' => $rate, 'album' => $album->getPhotos()));
    }

    public function actionAccount()
    {
        /** @var Users $usr */
        $usr = Users::model()->findByPk(Yii::app()->user->id);


        if(isset($_POST['Users']))
        {

            // Goddamn magic
            $usr->attributes = $_POST['Users'];


/*
            // Works fine
            $usr->saveAttributes($_POST['Users']);

            $usr->img = CUploadedFile::getInstance($usr, 'img');
            $usr->avatar = 'images/'. $usr->img->name;
            $usr->img->saveAs($usr->avatar);
            var_dump
            Thumbnail::createThumbs($usr->avatar, 100);
*/
            if($usr->save())
                $this->redirect('dashboard');
        }


        $this->render('account', array('me' =>$usr));
    }

    public function actionJob ()
    {

        $orders = Orders::model()->findOrders(Yii::app()->user->id);
        $orderers = array();
        foreach($orders as $o)
        {
            $orderers[] = Users::model()->findByPk($o->user_id); // Get all of users
        }
        $this->render('job', array('orders' => $orders, 'users' => $orderers));
    }

}