<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 28-Juan-2014 
 * @time : 09:21 
 * @subpackage   TUpload
 * @version 0.7
 * @todo : TUpload file
 */
class TUpload {

    private $upload_dir = null;
    private $upload_mode = null;
    private $allowed_type = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'zip',
        'rar', '7z', 'xml', 'gz', 'bz2', 'mp4', 'avi', 'ogv', 'flv', 'mp3',
        'ogg', 'amr');

    /**
     * set upload mode
     * @param int $upload_mode upload const
     * @param strimg $other other name
     * @return type
     */
    function __construct($upload_mode = UPLOAD_BY_DATE, $other = '') {

        // pre
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $upload_mode, $other);

        if ($upload_mode == UPLOAD_BY_DATE) {
            $date = TDate::GetInstance();

            $this->upload_dir = '../upload/file/' . $date->SDate('Y/m');
        } else {
            $this->upload_dir = '../upload/file/type';
        }

        if (!file_exists($this->upload_dir)) {

            mkdir($this->upload_dir, 0777, true);
        }

        $this->upload_mode = $upload_mode;

        if ($other != '') {
            $this->upload_dir = '../upload/' . $other;
        }

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $upload_mode);

        return $upload_mode;
    }

    /**
     * save upload file
     * @param string $file_name $_FILES array key
     * @return mixed
     */
    public function Save($file_name) {

        // pre
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $file_name);

        $result = array('success' => TRUE, 'value' => '');

        // check file resived ture
        if ($_FILES[$file_name]["error"] > 0) {
            $result['success'] = FALSE;
            $result['value'] = $_FILES[$file_name]["error"];
        } else {

            $ext = strtolower(pathinfo($_FILES[$file_name]["name"], PATHINFO_EXTENSION));
            $_FILES[$file_name]["name"] = substr($_FILES[$file_name]["name"], 0, strlen($_FILES[$file_name]["name"]) - ( ( strlen($ext) ) + 1 ));
            if ($this->upload_mode == UPLOAD_BY_TYPE) {

                $destination = $this->upload_dir . '/' . $ext . '/';
                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }
            } else {
                $destination = $this->upload_dir . '/';
            }


            if (!file_exists($destination . $_FILES[$file_name]["name"] . '.' . $ext)) {

                $uploaded_file = $destination . $_FILES[$file_name]["name"] . '.' . $ext;
            } else {
                $i = 0;
                do {
                    $i++;
                    $uploaded_file = $destination . $_FILES[$file_name]["name"]
                            . '_' . $i . '.' . $ext;
                } while (file_exists($uploaded_file));
                $_FILES[$file_name]["name"] = $_FILES[$file_name]["name"] . '_' . $i;
            }
            $this->_save($file_name, $uploaded_file);

            $result['value']['name'] = $_FILES[$file_name]["name"];
            $result['value']['size'] = $_FILES[$file_name]["size"];
            $result['value']['path'] = $uploaded_file;
            $result['value']['ext'] = $ext;

            // result hook
            _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
            return $result;
        }
    }

    /**
     * private save by the rules
     * @param string $file_name $_FILES array key
     * @param string $file_destination
     * @param bool $allow_overwrite
     * @return string | bool
     */
    private function _save($file_name, $file_destination, $allow_overwrite = TRUE) {

         // pre
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $file_destination
                , $allow_overwrite, $type);
        
        // get file info
        $size = $_FILES[$file_name]["size"];
        $ext = strtolower(pathinfo($_FILES[$file_name]["name"], PATHINFO_EXTENSION));

        // check all file info
        if (!in_array($ext, $this->allowed_type)) {
            return 'File type is not allowed.';
        }

        if ($size > MAX_UPLOAD_SIZE) {
            return 'File size is bigger than allowed.';
        }

        if ($allow_overwrite == false && file_exists($file_destination)) {
            return 'Denny to overwrite';
        }

        $result = move_uploaded_file($_FILES[$file_name]["tmp_name"], $file_destination);
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }

    /**
     * save force by take and folder file
     * @param string $file_name $_FILES array key
     * @param string $dir directory in upload folder
     * @param int|string $id file id
     * @param bool $allow_overwrite
     * @param bool $is_visitor
     * @return mixed file upload result
     */
    public function SaveForce($file_name, $dir, $id, $allow_overwrite = true, $is_visitor = FALSE) {

         // pre
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $file_name, 
                $dir, $id, $allow_overwrite, $is_visitor);
        $uploaded_file = ($is_visitor ? '' : '.') . './upload/'
                . $dir . '/' . $id . '.' . strtolower(
                        pathinfo($_FILES[$file_name]["name"], PATHINFO_EXTENSION));

        $result['success'] = $this->_save($file_name, $uploaded_file, $allow_overwrite);

        if ($result['success'] !== TRUE) {
            $result['value'] = $result['success'];
            $result['success'] = FALSE;
        } else {
            $result['value'] = $uploaded_file;
        }

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        return $result;
    }

}
