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


    // TODO: make dis, nigga
    public function actionHire(){

    }
}