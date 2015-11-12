<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 09-Juan-2014 
 * @time : 16:32 
 * @subpackage   TPagination
 * @version 1.0
 * @todo : crsate pagination
 */
class TPagination {

    // page count need to be render 
    private $page_count = 1;

    /**
     * create pagination
     * @param int $page_count page count
     */
    function __construct($page_count = 1) {
        
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $page_count);
        
        // ste page count
        $this->page_count = $page_count;
    }

    /**
     * render pagonation
     * @param int $acvtive_page
     */
    public function Render($acvtive_page = '') {

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $acvtive_page);

		$result = $this->RenderX($acvtive_page);
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        echo $result;
    }
    
    
    
    /**
     * render pagonation
     * @param int $acvtive_page
     */
    public function RenderX($acvtive_page = '') {


        
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $acvtive_page);
        
        // get active page
        if ($acvtive_page == '' && isset($_GET['page'])) {
            $acvtive_page = intval($_GET['page']);
        } else {
            $acvtive_page = 1;
        }


        //$this->page_count = 100;

        // make prefix link
        $prefix = '?' ;
        if (isset($_GET['search'])){
            $prefix .= 'search=' . $_GET['search'] . "&";
        }

        $result =  '<div class="pagination">';

        // if greater than 1 show first and prv
        if ($acvtive_page > 1) {
            $result .= '<a href="' . $prefix . "page=" . (1) . '" title="' . ('اولین') . '" >' . '&lt;&lt;' . "</a> \n";
            $result .= '<a href="' . $prefix . "page=" . ($acvtive_page - 1) . '" >' . ('قبلی') . "</a> \n";
        }

        // if page count less than 10 .
        if ($this->page_count <= 10) {
            // show all page
            for ($i = 1; $i <= $this->page_count; $i++) {
                if ($i != $acvtive_page) {
                    $result .= '<a href="' . $prefix . "page=" . $i . '" >' . $i . "</a> \n";
                } else {
                    $result .= '<a class="actived">' . $i . "</a> \n";
                }
            }
        } else { // more than 10 page
            
            switch ($acvtive_page) {
                // if active page less than 7
                case ($acvtive_page < 7):
                    for ($i = 1; $i <= $acvtive_page + 3; $i++) {
                        if ($i != $acvtive_page) {
                            $result .= '<a href="' . $prefix . "page=" . $i . '" >' . $i . "</a> \n";
                        } else {
                            $result .= '<a class="actived">' . $i . "</a> \n";
                        }
                    }
                    // show over flow
                    $result .= '<a href="overflow-last" >' . '...' . "</a> \n";
                    $result .= '<div class="overflow" id="overflow-last">' ;

                    for ($i = $acvtive_page + 4; $i < $this->page_count; $i++) {
                        $result .= '<a href="' . $prefix . "page=" . $i . '" >' . $i . "</a> \n";
                    }
                    $result .= '</div>';
                    break;
                    
                    // if active page in last 5 page
                case ($acvtive_page > ($this->page_count-5)):
                    // show overflows pages
                    $result .= '<a href="overflow-first" >' . '...' . "</a> \n";   
                    $result .= '<div class="overflow" id="overflow-first">' ;
                    
                    for ($i = 1; $i < ($acvtive_page-3); $i++) {
                        $result .= '<a href="' . $prefix . "page=" . $i . '" >' . $i . "</a> \n";
                    }
                    $result .= '</div>';
                    for ($i = ($acvtive_page-3); $i <= $this->page_count; $i++) {
                        if ($i != $acvtive_page) {
                            $result .= '<a href="' . $prefix . "page=" . $i . '" >' . $i . "</a> \n";
                        } else {
                            $result .= '<a class="actived">' . $i . "</a> \n";
                        }
                    }
                    break;
               
                default:
                    // else not in 5 first page or 5 last page
                    $result .= '<a href="overflow-first" >' . '...' . "</a> \n";   
                    $result .= '<div class="overflow" id="overflow-first">' ;
                    for ($i = 1; $i < ($acvtive_page-3); $i++) {
                        $result .= '<a href="' . $prefix . "page=" . $i . '" >' . $i . "</a> \n";
                    }
                    $result .= '</div>';
                    
                    for ($i = ($acvtive_page-3); $i <= $acvtive_page + 3; $i++) {
                        if ($i != $acvtive_page) {
                            $result .= '<a href="' . $prefix . "page=" . $i . '" >' . $i . "</a> \n";
                        } else {
                            $result .= '<a class="actived">' . $i . "</a> \n";
                        }
                    }
                    
                    $result .= '<a href="overflow-last" >' . '...' . "</a> \n";
                    $result .= '<div class="overflow" id="overflow-last">' ;

                    for ($i = $acvtive_page + 4; $i < $this->page_count; $i++) {
                        $result .= '<a href="' . $prefix . "page=" . $i . '" >' . $i . "</a> \n";
                    }
                    $result .= '</div>';
                    
                    break;
            }
        }


        // if not last page show last and next
        if ($acvtive_page < $this->page_count) {
            $result .= '<a href="' . $prefix . "page=" . ($acvtive_page + 1) . '" >' . ('بعدی') . "</a> \n";
            $result .= '<a href="' . $prefix . "page=" . ($this->page_count) . '" title="' . ('آخرین') . '" >' . '&gt;&gt;' . "</a> \n";
        }
        $result .= '</div>';
        
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }

}
