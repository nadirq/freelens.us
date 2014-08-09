<?php

class CameristsController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl'
        );
    }
    // List of all masters
	public function actionIndex()
	{
        // So bydlocode
        $allCamerists = new Camerists;
        $rt = Camerists::model()->findAll();
        $rating = array();
        foreach($rt as $i)
            $rating[] = $i->rate;
		$this->render('index', array('camerists' => $allCamerists, 'rate' => $rating));
	}


    public function actionInfo(){

        // Leave comment
        $id = $_GET['cam_id'];
        $usr = Users::model()->findByPk($id);

        $rate = Camerists::model()->findByPk($id)->rate;
        $album = Albums::model()->getAlbumId($id);
        $reviews = Comments::model()->getComments($id);
        $commenters = array();
        foreach($reviews as $rv)
            $commenters[] = Users::model()->findByPk($rv->user_id);
        $this->render('info', array(
            'camerist' => $usr,
            'commenters' => $commenters,
            'rate' => $rate,
            'album' => $album->getPhotos(),
            'reviews' => $reviews));
    }
}