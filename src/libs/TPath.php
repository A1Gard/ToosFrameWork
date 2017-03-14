<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 02-Jan-2016 (10-12-1394) 
 * @time : 01:39 
 * @todo : path file directory functions
 * @version 0.1
 */

class TPath {

   /**
    * delete folder and sub folder
    * @param type $dir
    * @return boolean
    */
    public static function DeleteDirectory($dir) {
        if (!file_exists($dir))
            return true;
        if (!is_dir($dir) || is_link($dir))
            return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..')
                continue;
            if (!self::DeleteDirectory($dir . "/" . $item)) {
                chmod($dir . "/" . $item, 0777);
                if (!self::DeleteDirectory($dir . "/" . $item))
                    return false;
            };
        }
        return rmdir($dir);
    }

}
