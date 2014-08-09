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


            $usr->attributes = $_POST['Users'];



            // Works fine


            $usr->img = CUploadedFile::getInstance($usr, 'img');
            if($usr->img != null)
            {
                $usr->avatar = 'images/'. md5($usr->img->name) .'.'.$usr->img->extensionName;
                $usr->img->saveAs($usr->avatar);

                Thumbnail::createThumbs($usr->avatar, 100);
            }
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