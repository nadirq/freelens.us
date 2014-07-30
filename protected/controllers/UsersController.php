<?php

class UsersController extends Controller
{


    public function actions()
    {
        return array(
            // Создаем экшинс captcha.
            // Он понадобиться нам для формы регистрации (да и авторизации)
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=> 0x003300,
                'maxLength'=> 3,
                'minLength'=> 3,
                'foreColor'=> 0x66FF66,
            ),
        );

    }


	public function actionIndex()
	{
		$this->render('index');
	}



    public function actionLogin()
    {
    }

    public function actionRegistration()
    {

        $form = new Users;


        if (!Yii::app()->user->isGuest) {
            throw new CException('Already registered');
        } else {

            if (!empty($_POST['Users'])) {


                $form->attributes = $_POST['Users'];

                $form->verifyCode = $_POST['Users']['verifyCode'];

                if($form->validate('registration'))
                {

                    if ($form->model()->count("login = :login", array(':login' => $form->login)))
                    {
                        $form->addError('login', 'This login already in use');
                        $this->render("registration", array('form' => $form));
                    } else {


                        $form->save();
                        $this->render("registration_ok");
                    }

                }
                else
                {

                    $this->render("registration", array('form' => $form));
                }
            } else {

                $this->render("registration", array('form' => $form));
            }
        }
    }




    // Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}