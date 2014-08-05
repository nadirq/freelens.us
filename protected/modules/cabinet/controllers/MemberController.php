<?php

class MemberController extends Controller
{
    public function actionDashboard()
    {
        // TODO: refactor
        $usr = Users::model()->findByPk(Yii::app()->user->id);

        $rate = Camerists::model()->findByPk(Yii::app()->user->id)->rate;
        $album = Albums::model()->getAlbumId(Yii::app()->user->id);

        $this->render('dashboard', array('me' => $usr, 'rate' => $rate, 'album' => $album->getPhotos()));
    }
}