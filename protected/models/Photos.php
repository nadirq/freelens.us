<?php
/**
 * Created by PhpStorm.
 * User: admin2
 * Date: 7/31/14
 * Time: 3:43 PM
 */

class photos extends CActiveRecord{

    public $image;
    // другие свойства

    public function rules(){
        return array(
            //устанавливаем правила для файла, позволяющие загружать
            // только картинки!
            array('image', 'file', 'types'=>'jpg, gif, png'),
        );
    }

}