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
        $usr = Users::model()->findByPk(Yii::app()->user->id);

        if(isset($_POST['Users']))
        {

            // Goddamn magic
            //$usr->attributes = $_POST['Users'];
            //$usr->save();
            // Works fine
            $usr->saveAttributes($_POST['Users']);
            $this->redirect('dashboard');
        }


        $this->render('account', array('me' =>$usr));
    }

}