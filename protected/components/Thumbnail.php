<?php


class Thumbnail extends CComponent {
    function createThumbs( $img, $thumbs, $thumbWidth )
    {

        $info = pathinfo($img);
        // continue only if this is a JPEG image
        if ( strtolower($info['extension']) == 'jpg' )
        {

            // load image and get image size
            $img = imagecreatefromjpeg($img);
            $width = imagesx($img);
            $height = imagesy($img);

            // calculate thumbnail size
            $new_width = $thumbWidth;
            $new_height = floor( $height * ( $thumbWidth / $width ) );

            // create a new temporary image
            $tmp_img = imagecreatetruecolor( $new_width, $new_height );
            // copy and resize old image into new image
            imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            // save thumbnail into a file
            imagejpeg( $tmp_img, 'Thumb_'.$img);
        }

    }
}