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
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>




<div class="container" id="page">

	<div id="header">
		<div id="logo"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/logo1.png" width="300px"></div>
	</div><!-- header -->

	<div id="mainmenu">




    <?php

        $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'Home', 'url'=>array('/site/index')),
                array('label'=>'Photographers', 'url'=>array('/camerists/index')),
                array('label'=>'Sign up', 'url'=>array('/cabinet/auth/registration'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Sign in', 'url'=>array('/cabinet/auth/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Cabinet', 'url'=>array('/cabinet/member/dashboard'), 'visible'=>Yii::app()->user->isCamerist()),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
            ),
        ));
    ?>

	</div><!-- mainmenu -->
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

    <div id="cabmenu">
        <?php if(Yii::app()->user->getRole() == 'camerist'){ ?>
            <?php $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'Dashboard', 'url'=>array('/cabinet/member/dashboard')),
                    array('label'=>'Settings', 'url'=>array('/cabinet/member/account')),
                    array('label'=>'Add photo', 'url'=>array('/cabinet/photos/create')),
                    array('label'=>'Job', 'url'=>array('/cabinet/member/job')),

                ),
            ));
        }
        ?>
    </div>
	<?php echo $content; ?>

	<div class="clear"></div>

</div><!-- page -->

<div id="footer">
    <div class="foot">
        <ul>
            <li><a href="#">О сайте</a></li>
            <li><a href="#">Найти фотографа</a></li>
            <li><a href="#">Карта сайта</a></li>
            <li><a href="#">Фидбек</a></li>
        </ul>
    </div>
</div><!-- footer -->

</body>
</html>
