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
        // for pagination

        $criteria = new CDbCriteria();
        $criteria->condition = 'role = :role';
        $criteria->params = array(':role' => 'camerist');
        $count = Users::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 15; // 15 per page
        $pages->applyLimit($criteria);

        $criteria->with = array('camerists');
        $criteria->together = true;




        $allCamerists = Users::model()->findAll($criteria);
        $this->render('index', array('camerists' => $allCamerists, 'pages' => $pages));
	}


    public function actionInfo(){




        $id = Yii::app()->request->getQuery('cam_id');
        $usr = Users::model()->findByPk($id);

        // For ghosts
        if(!isset($usr)){
            throw new CHttpException(404,'The specified post cannot be found.');
        }
        if($usr->role == 'user')
        {
            throw new CHttpException(404,'The specified post cannot be found.');
        }
        // Rate him

        $rating = new Rating;
        $cam = Camerists::model()->findByPk($id); // Save camerist for order
        if(isset($_POST['Rating'])){
            $rating->attributes = Yii::app()->request->getPost('Rating');
            $rating->cam_id = $id;
            $rating->user_id = Yii::app()->user->id;
            if($rating->save())
            {
                $cam->updateRating();
            }
        }


        $rate = $cam->rate;
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
            'reviews' => $reviews,
            'model' => $rating,  // for rate him at info page
        ));
    }
}