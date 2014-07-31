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
                        var_dump($form);
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




    public function actionLogin()
    {
        $form = new Users;

        // Проверяем является ли пользователь гостем
        // ведь если он уже зарегистрирован - формы он не должен увидеть.
        if (!Yii::app()->user->isGuest) {
            throw new CException('Вы уже зарегистрированы!');
        } else {
            if (!empty($_POST['Users'])) {
                $form->attributes = $_POST['Users'];
                $form->verifyCode = $_POST['Users']['verifyCode'];

                // Проверяем правильность данных
                if($form->validate('login')) {
                    // если всё ок - кидаем на главную страницу
                    $this->redirect(Yii::app()->homeUrl);
                }
            }
            $this->render('login', array('form' => $form));
        }
    }
















}