<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style000.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/juicyslider.css" />
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/south-street/jquery-ui.css" id="theme">
    <link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!--скрипты-->


    <script src="//yandex.st/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/yandexmap.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.image-gallery.min.js"></script>


</head>

<body>
<div id="page">
<div class="container">
    <div class="row head_background ">

        <div id="header" class="col-lg-3">
            <div id="logo"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/logo1.png" width="300px"></div>
        </div><!-- header -->

        <div id="mainmenu" class="pull-right">
            <?php

            $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'Главная', 'url'=>array('/site/index')),
                    array('label'=>'Фотографы', 'url'=>array('/camerists/index')),
                    array('label'=>'Регистрация', 'url'=>array('/cabinet/auth/registration'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Войти', 'url'=>array('/cabinet/auth/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Мой кабинет', 'url'=>array('/cabinet/member/dashboard'), 'visible'=>Yii::app()->user->isCamerist(), 'items'=>array(
                        array('label'=>'Информация', 'url'=>array('/cabinet/member/dashboard')),
                        array('label'=>'Настройки', 'url'=>array('/cabinet/member/account')),
                        array('label'=>'Добавить фотографии', 'url'=>array('/cabinet/photos/create')),
                        array('label'=>'Заказы', 'url'=>array('/cabinet/member/job')),
                    )),
                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                ),
            ));
            ?>

        </div><!-- mainmenu -->
    </div>

    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    <?php endif?>
    <div id="usermenu">
        <?php
        $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'My orders', 'url'=>array('/orders/index'), 'visible'=>Yii::app()->user->isUser()),
                array('label'=>'My reviews', 'url'=>array('/comments/index'), 'visible'=>Yii::app()->user->isUser()),
                array('label'=>'My rates', 'url'=>array('/rating/index'), 'visible'=>Yii::app()->user->isUser()),
            ),
        ));
        ?>
    </div>


    <?php echo $content; ?>


    <div class="clear"></div>
</div>
</div><!-- page -->

<!--Start footer-->
<footer>
    <div><p>© 2014 FreeLens.us. All rights reserved.</p></div>
</footer>
<!--End footer-->

</body>
</html>
