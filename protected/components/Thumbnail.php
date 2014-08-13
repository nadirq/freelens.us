<?php


class Thumbnail extends CComponent {
    public static function createThumbs( $img, $thumbWidth )
    {

        //TODO: refactor
        $info = pathinfo($img);
        // continue only if this is a JPEG image
        if ( strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg')
        {
            $imgObj = imagecreatefromjpeg($img);
            $width = imagesx($imgObj);
            $height = imagesy($imgObj);

            // calculate thumbnail size
            if($width >= $height){
                $new_width = $thumbWidth;
                $new_height = floor( $height * ( $thumbWidth / $width ) );
            }
            else{
                $new_width = floor( $width * ( $thumbWidth / $height ) );
                $new_height = $thumbWidth;
            }


            // create a new temporary image
            $tmp_img = imagecreatetruecolor( $new_width, $new_height );
            // copy and resize old image into new image
            imagecopyresized( $tmp_img, $imgObj, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            // save thumbnail into a file

            imagejpeg( $tmp_img, str_replace('images/', 'images/small_', $img));
        }
        else if(strtolower($info['extension']) == 'png' )
        {
            $imgObj = imagecreatefrompng($img);
            $width = imagesx($imgObj);
            $height = imagesy($imgObj);

            // calculate thumbnail size
            if($width >= $height){
                $new_width = $thumbWidth;
                $new_height = floor( $height * ( $thumbWidth / $width ) );
            }
            else{
                $new_width = floor( $width * ( $thumbWidth / $height ) );
                $new_height = $thumbWidth;
            }


            // create a new temporary image
            $tmp_img = imagecreatetruecolor( $new_width, $new_height );
            // copy and resize old image into new image
            imagecopyresized( $tmp_img, $imgObj, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            // save thumbnail into a file

            imagepng( $tmp_img, str_replace('images/', 'images/small_', $img));
        }
            // load image and get image size


    }


    public static function getThumb($name)
    {

        return str_replace('images/', 'images/small_', $name);

    }


}