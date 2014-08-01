<?php

class CameristsController extends Controller
{
    // List of all masters
	public function actionIndex()
	{
        $allCamerists = new Camerists;
		$this->render('index', array('camerists' => $allCamerists));
	}


    // TODO: make dis, nigga
    public function actionHire(){

    }
}