<br />

<div class="row">

    <div class="col-lg-3">
        <div id='avatar' class="avatar">
            <?php
            echo CHtml::image(Yii::app()->baseUrl.'/'.$camerist->avatar, 'Avatar', array('style'=>'', 'width'=>'350px'));
            ?>
        </div>
        <div id="can">
            <?php if(Yii::app()->request->getQuery('cam_id')!=Yii::app()->user->id){?>
                <span class="btn btn-success">
                    <?php echo CHtml::link('Забронировать', Yii::app()->createUrl('orders/make', array('cam_id' => $camerist->id))); ?>
                </span>

                <span class="btn btn-danger">
                    <?php echo CHtml::link('Отзыв', Yii::app()->createUrl('/comments/add', array('cam_id' => $camerist->id))); ?>
                </span>

            <span class="btn btn-primary">
                <?php echo CHtml::link('Места фотографа', Yii::app()->createUrl('/map/showPlaces', array('cam_id' => $camerist->id))); ?>
            </span>
            <?php }else{ ?>
                <span class="btn btn-primary" style="width: 100%;">
                    <?php echo CHtml::link('Мои места', Yii::app()->createUrl('/map/showPlaces', array('cam_id' => $camerist->id))); ?>
                </span>
            <?php }?>
        </div>

        <?php if(Yii::app()->request->getQuery('cam_id')!=Yii::app()->user->id) {?>

        <div class="rate">

            <?php if(!Users::model()->isMadeRate($camerist->id)){ ?>
                <?php $form = $this->beginWidget('CActiveForm'); ?>

                <?php echo $form->errorSummary($model); ?>

                <div class="compactRadioGroup">
                    <p>
                        <?php
                        echo $form->radioButtonList($model,'rate',array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=> '5'), array('separator' => ''));
                        ?>

                        <?php echo CHtml::submitButton('Rate', array('class' => 'btn btn-default')); ?>
                    </p>
                </div>


                <?php $this->endWidget(); ?>


            <?php }
            else{
                echo 'Моя оценка: ' . Users::model()->getRate($camerist->id);
                echo "&nbsp;&nbsp;";
                echo '<span class="btn">';
                echo CHtml::link('Я передумал', Yii::app()->createUrl('rating/change', array('cam_id' => $camerist->id)), array('class' => 'btn btn-default'));
                echo '<span>';
            }
            echo "</div>";
            }
            ?>

            <!-- rate-->

        </div>
        <div class="col-lg-4">
            <h2><?php echo $camerist->fio; ?></h2>
            <div id="rating">
                <?php echo 'Рейтинг: <strong> ' . $rate .'</strong>'; ?>
            </div>
            <div id="contacts">
                <?php echo 'Телефон: <strong>' . $camerist->tel .'</strong>'; ?>
                <br />
                <?php echo 'Электропочта: <strong>' . $camerist->email .'</strong>'; ?>
            </div>
            <div id='about'>
                <strong>Обо мне:</strong><br />
                <?php echo $camerist->about; ?>
            </div>

        </div>
        <div class="col-lg-5">
            <div id="map" class="map"></div>
        </div>
    </div>









    <div class="row">
        <div id='gallery'>
            <h3 class="page-header">Портфолио</h3>
            <?php
            if(!$album)
                echo 'Этот фотограф еще не загрузил ни одной фотографии.';
            else {
                ?>

                <div id="links">
                    <?php foreach($album as $item): ?>
                        <?php if($item->published): ?>

                            <a href = "<?php echo  Yii::app()->baseUrl.'/'.$item->path; ?>" data-dialog>
                                <div>
                                    <?php echo CHtml::image(Yii::app()->baseUrl.'/'.Thumbnail::getThumb($item->path), 'Portfolio item'); ?>
                                </div>
                            </a>

                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

            <?php } ?>
            <div id="blueimp-gallery-dialog" data-show="fade" data-hide="fade">
                <!-- The gallery widget  -->
                <div class="blueimp-gallery blueimp-gallery-carousel blueimp-gallery-controls">
                    <div class="slides"></div>
                    <a class="prev">‹</a>
                    <a class="next">›</a>
                    <a class="play-pause"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="reviews">
            <h4>Отзывы от благодарных клиентов</h4>
            <?php
            if(!$reviews)
                echo 'Отзывов пока нету :(';
            foreach($reviews as $i => $r)
            {
                ?>
                <div class="review">
                    <?php if(isset($r)) { ?>
                        <strong><?php echo $commenters[$i]->fio; ?></strong>
                        <p class="text">
                            <?php echo $r->message; ?>
                        </p>

                        <div class="date"><?php echo $r->created_at ?></div>
                    <?php } ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <br />
    <br />
</div>



<script>

    ymaps.ready(init);
    var myMap;
    var myLocation;
    var url = "<?php echo Yii::app()->urlManager->createUrl('map/getcamlocation'); ?>/";

    function init() {
        myId = <?php echo Yii::app()->request->getQuery('cam_id'); ?>

            myMap = new ymaps.Map('map', {
                center: [55.02, 82.93], // Новосибирск
                zoom: 13,
                controls: ['zoomControl','geolocationControl','searchControl']
            });

        //делаем запрос на местоположение пользователя
        $.getJSON(url+myId,
            function(json){

                //если координаты есть, то добавляем метку на карту и цнтрируемся по ней
                if(json.marker[0].lat!=null&& json.marker[0].lon!=null){
                    myLocation = new ymaps.Placemark([json.marker[0].lat, json.marker[0].lon],
                        {
                            balloonContentBody: 'Фотограф находится здесь)'
                        }, {
                            // Опции
                            preset: 'islands#greenDotIcon'
                        });
                    myMap.geoObjects.add(myLocation);
                    myMap.setCenter([json.marker[0].lat, json.marker[0].lon]);
                }
            }
        );

        //создаем карту и центрируем ее на Новосибирск

    }


</script>
