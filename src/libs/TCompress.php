<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 31-December-2014 (10-10-1394) 
 * @time : 11:46 
 * @subpackage   TCompress
 * @version 0.5
 * @todo : Create and Extract Archive
 */
class TCompress {

    function __construct() {
        
    }

    /**
     * zip directory
     * @param string $dir directory to zip
     * @param string $output output zip file
     * @example $com->ZipDir('../libs', './sample.zip');
     */
    public function ZipDir($dir, $output) {
        include_once('external/pclzip.lib.php');
        $archive = new PclZip($output);
        $v_list = $archive->create($dir, PCLZIP_OPT_REMOVE_PATH, $dir);
        if ($v_list == 0) {
            die("Error : " . $archive->errorInfo(true));
        }
    }

    /**
     * Extract zip file 
     * @param string $path path to extract files
     * @param string $input input zip file to extract
     * @example  $com->ZipExtract('newlibs', './sample.zip');
     */
    public function ZipExtract($path, $input) {
        include_once('external/pclzip.lib.php');
        $archive = new PclZip($input);
        if ($archive->extract(PCLZIP_OPT_PATH, $path) == 0) {
            die("Error : " . $archive->errorInfo(true));
        }
    }

}