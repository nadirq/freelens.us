<?php


class Thumbnail extends CComponent {
    public static function createThumbs( $img, $thumbWidth )
    {

        //TODO: refactor
        $info = pathinfo($img);
        // continue only if this is a JPEG image
        if ( strtolower($info['extension']) == 'jpg' )
        {
            $imgObj = imagecreatefromjpeg($img);
            $width = imagesx($imgObj);
            $height = imagesy($imgObj);

            // calculate thumbnail size
            $new_width = $thumbWidth;
            $new_height = floor( $height * ( $thumbWidth / $width ) );

            // create a new temporary image
            $tmp_img = imagecreatetruecolor( $new_width, $new_height );
            // copy and resize old image into new image
            imagecopyresized( $tmp_img, $imgObj, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            // save thumbnail into a file

            imagejpeg( $tmp_img, str_replace('images/', 'images/thumb_', $img));
        }
        else if(strtolower($info['extension']) == 'png' )
        {
            $imgObj = imagecreatefrompng($img);
            $width = imagesx($imgObj);
            $height = imagesy($imgObj);

            // calculate thumbnail size
            $new_width = $thumbWidth;
            $new_height = floor( $height * ( $thumbWidth / $width ) );

            // create a new temporary image
            $tmp_img = imagecreatetruecolor( $new_width, $new_height );
            // copy and resize old image into new image
            imagecopyresized( $tmp_img, $imgObj, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            // save thumbnail into a file

            imagepng( $tmp_img, str_replace('images/', 'images/thumb_', $img));
        }
            // load image and get image size


    }

}