<?php

class AuthController extends Controller
{
    public function actions()
    {


        // For captcha
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=> 0x003300,
                'maxLength'=> 6,
                'minLength'=> 3,
                'foreColor'=> 0x66FF66,
            ),
        );

    }


    public function actionIndex()
    {

        $this->render('index');
    }




    public function actionRegistration()
    {

        $form = new Users;


        if (!Yii::app()->user->isGuest)
        {
            throw new CException('Already registered');
        } else
        {
            if (!empty($_POST['Users']))
            {


                $form->attributes = $_POST['Users'];
                $form->type = $_POST['Users']['type'];



                if($form->validate('registration'))
                {

                    if ($form->model()->count("login = :login", array(':login' => $form->login)))
                    {
                        $form->addError('login', 'This login already in use');
                        $this->render("registration", array('form' => $form));
                    }
                    else
                    {

                        $form->createCamerist();
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







    public function actionLogin()
    {
        $form = new Users;


        if (!Yii::app()->user->isGuest)
        {
            $this->redirect(Yii::app()->homeUrl);
        }
        else
        {
            if (!empty($_POST['Users']))
            {


                $form->attributes = $_POST['Users'];


                // Some validation
                if($form->validate('login'))
                {
                    $form->login();
                    $this->redirect(Yii::app()->homeUrl);
                }
            }
            $this->render('login', array('form' => $form));
        }
    }

}