<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
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
        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $dir, $output);
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
        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $path, $input);
        include_once('external/pclzip.lib.php');
        $archive = new PclZip($input);
        if ($archive->extract(PCLZIP_OPT_PATH, $path) == 0) {
            die("Error : " . $archive->errorInfo(true));
        }
    }

}
