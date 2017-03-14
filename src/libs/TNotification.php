<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 18-July-2015
 * @time : 04:31 
 * @subpackage   TCategory
 * @version 1.0
 * @todo : for control notification
 */
class TNotification {

    /**
     * 
     * @param string $text
     * @param string $type (error| warning| info| success)
     * @global mixed $notifications notifications list 
     */
    static public function Add($text, $type = '') {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $text, $type);

        $notify['text'] = $text;
        $notify['type'] = $type;

        $_SESSION['notification'][] = $notify;
    }

    /**
     * show added notification
     * @global mixed $notifications notifications list 
     */
    static public function Show() {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__);
        $icons['error'] = 'fa-times-circle';
        $icons['warning'] = 'fa-exclamation-triangle';
        $icons['info'] = 'fa-info-circle';
        $icons['success'] = 'fa-check-circle';
        $icons[''] = 'fa-dot-circle-o';

        if (isset($_SESSION['notification']) && is_array($_SESSION['notification'])) {
            $result = null;
            foreach ($_SESSION['notification'] as $k => $notify) {
                $result .= "\t" . '<div class="notification ' . $notify['type'] . '">
                            <span class="fa ' . $icons[$notify['type']] . '"></span>
                            ' . $notify['text'] . '
                            <span class="fa fa-close"></span>
                        </div>';
                unset($_SESSION['notification'][$k]);
            }
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);

        echo $result;
    }

}
