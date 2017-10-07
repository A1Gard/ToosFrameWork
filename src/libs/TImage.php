<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 28-Juan-2014 
 * @time : 09:21 
 * @subpackage   TImage
 * @version 0.8
 * @todo : image resize - water mark - create captcha image
 */
class TImage {

    function __construct() {
        
    }

    public static function GetInstance() {
        if (!isset(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }
    
    
    
    /**
     * resize image function
     * @param string $file_name
     * @param int $new_width by px
     * @param int $new_height by px
     * @param int $mode mode show resize mode by with or hieght or both
     * @param string $new_file_name output file
     * @return string to do worked
     */
    public static function ResizeImage($file_name, $new_width = null, 
            $new_height = null, $new_file_name = "", $mode = RESIZE_WIDTH_FIXED) {

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $file_name
                , $new_width, $new_height, $new_file_name, $mode);
        

        $result = array('success' => TRUE, 'value' => '');

        if ($new_file_name == "") {
            $new_file_name = 'thumb_' . $file_name;
        }


        // Get new sizes
        list($width, $height) = getimagesize($file_name);

        switch ($mode) {
            case RESIZE_WIDTH_FIXED:

                if (intval($new_width) < 1) {
                    $result['success'] = FALSE;
                    $result['value'] = 'TImage width invalid';
                    break;
                }


                $percent = $new_width / $width;

                $new_height = floor($height * $percent);

                break;
            case RESIZE_HEIGHT_FIXED:
                if (intval($new_height) < 1) {
                    $result['success'] = FALSE;
                    $result['value'] = 'TImage height invalid';
                    break;
                }

                $percent = $new_height / $height;

                $new_width = floor($width * $percent);

                break;

            default:
                // both
                if ((intval($new_height) < 1 ) || (intval($new_width) < 1 )) {
                    $result['success'] = FALSE;
                    $result['value'] = 'TImage width or height is invalid';
                }
                break;
        }

        if ($result['success'] == true) {
            // Load
            $thumb = imagecreatetruecolor($new_width, $new_height);
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if ($ext == 'jpg' || $ext == 'jpeg') {
                $source = imagecreatefromjpeg($file_name);
                // resize
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            } else if ($ext == 'gif') {
                $source = imagecreatefromgif($file_name);
                // resize
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            } else if ($ext == 'png') {
                imagealphablending($thumb, false);
                imagesavealpha($thumb, true);
                $source = imagecreatefrompng($file_name);
                $transparent = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
                imagefilledrectangle($thumb, 0, 0, $width, $height, $transparent);
                imagecopyresampled($thumb, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            }




            // Output
            if ($ext == 'jpg' || $ext == 'jpeg')
                $result['success'] = imagejpeg($thumb, $new_file_name);
            else if ($ext == 'gif')
                $result['success'] = imagegif($thumb, $new_file_name);
            else if ($ext == 'png')
                $result['success'] = imagepng($thumb, $new_file_name);

            $result['value'] = $new_file_name;
        }

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }

    /**
     * padd watter mark to image
     * @param string $source_image
     * @param string $watermark_text
     * @param string $destination_file
     */
    public static function WatermarkImage($source_image, $watermark_text, $destination_file) {
        
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $source_image, 
                $watermark_text, $destination_file);
        
        list($width, $height) = getimagesize($source_image);
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefromjpeg($source_image);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
        $black = imagecolorallocate($image_p, 0, 0, 0);
        $font = 'NanumBarunGothicBold.ttf';
        $font_size = 10;
        imagettftext($image_p, $font_size, 0, 10, 20, $black, $font, $watermark_text);
        if ($destination_file <> '') {
            imagejpeg($image_p, $destination_file, 100);
        } else {
            header('Content-Type: image/jpeg');
            imagejpeg($image_p, null, 100);
        }
        imagedestroy($image);
        imagedestroy($image_p);
    }

}
