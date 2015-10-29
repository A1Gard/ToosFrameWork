<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 18-July-2014 
 * @time : 01:49 
 * @subpackage   TListview
 * @version 0.7
 * @todo : ListView by order and filter
 */
class TListView {

    public $id = null; // list view id
    private $assoc_list = null; // db associtied list
    // columns of the listview
    private $column = array('title' => array(), 'key' => array(), 'size' => array());
    // listview filter
    private $filter = array('title' => array(), 'key' => array(), 'value' => array());
    // list view bulk action
    private $bulk_action = array('title' => array(), 'function' => array(), 'value' => array());
    // action pattern and size
    private $action = array();
    // private pattren
    private $pattren = array();

    /**
     * 
     * @param string $id table column id name
     */
    function __construct($id = 'id') {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $id);

        $this->id = $id;
    }

    function SetPattern($index, $pattren) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $index, $pattren);

        $this->pattren[$index] = $pattren;
    }

    /**
     * 
     * @param array $assoc_list  associtied list of record
     */
    public function SetList($assoc_list) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $assoc_list);

        $this->assoc_list = $assoc_list;
    }

    /**
     * add an cloum to view
     * @param string $title column header title
     * @param string $key column database column name
     * @param int $size how many from 21 for column width
     */
    public function AddColum($title, $key, $size = 6) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $title, $key, $size);

        $this->column['title'][] = $title;
        $this->column['key'][] = $key;
        $this->column['size'][] = $size;
    }

    /**
     * add action column
     * @param string $pattern acction pattren
     * @param int $size how many from 21 for column width
     * @param string $class class equl a cloum name
     */
    public function AddAction($pattern, $size, $class = '') {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $pattern, $size, $size, $class);

        $this->action['pattern'] = $pattern;
        $this->action['size'] = $size;
        $this->action['class'] = $class;
    }

    /**
     * add a filter use in view 
     * @param string $title filter title show to manager
     * @param string $key database column name 
     * @param string $value database value must be equal or opration act 
     * @param string $opr opartion for filter null -> equal , gt -> greater than
     *          lt -> less than , lk -> like , rg regix
     */
    public function AddFilter($title, $key, $value, $opr = '') {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $title, $key, $value);

        switch ($opr) {
            case '':
                $prefix = '';
                break;
            case 'gt':
                $prefix = '>';
                break;
            case 'lt':
                $prefix = '<';
                break;
            case 'lk':
                $prefix = '%';
                break;
            case 'rg':
                $prefix = '$';
                break;

            default:
                break;
        }

        $this->filter['title'][] = $title;
        $this->filter['key'][] = $key;
        $this->filter['value'][] = $prefix . $value;
    }

    /**
     * add bulk action - group action to selected records
     * @param string $title action title
     * @param string $function function use
     * @param string $value value passing to function
     */
    public function AddBulkAcction($title, $function, $value) {


        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $title, $function, $value);


        $this->bulk_action['title'][] = $title;
        $this->bulk_action['function'][] = $function;
        $this->bulk_action['value'][] = $value;
    }

    /**
     * render listview and show
     * @param string $location base of controller class name
     */
    public function Render($location = '') {

        $date_format = 'Y/m/d H:i';

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $location, $date_format);


        $date = TDate::GetInstance();

        // show form head here when have bulk action
        if ($this->bulk_action['title'] != array()) {
            $result = '<form method="post" action="' . UR_MP . $location . '/BulkAction">';
        } else {
            $result = null;
        }


        // show all filter here
        if ($this->filter['title'] != array()) {

            $result .= '<div class="filter">';

            // get prefix
            $prefix = GetLinkPrefix('filter');
            // show title and no filter item named "All";
            $result .= '<span> ' . _lg('Filter') . ': </span> <a class="button" href="' . $prefix . '"> ' . _lg('All') . '</a>';

            // show filter lisr
            foreach ($this->filter['title'] as $key => $value) {
                $result .= '<a class="button" href="' . $prefix . 'filter=' .
                        $this->filter['key'][$key] . ',' .
                        $this->filter['value'][$key] . '">' . $value . '</a>';
            }

            $result .= '</div>';
        }

        // get order by column 
        $prefix = GetLinkPrefix('order');

        // get id order and choose good value for this
        if (isset($_GET['order']) && $_GET['order'] == $this->id) {
            $id_order = $prefix;
        } else {
            $id_order = $prefix . 'order=' . $this->id;
        }



        //start render listview header
        // start with bulk action checkbox and id header
        $result .= '<ul class="listview">
    <li class="pinned animate"> 
        <div  class="row">
            <div class="grd1"> &nbsp; </div>
            <a href="' . $id_order . '"><div class="grd2"> ' . _lg('no.') . ' </div></a>';
        // show header column title
        foreach ($this->column['title'] as $key => $value) {

            if (substr($this->column['key'][$key], 0, 1) == '%') {

                $result .= '<a href="' . $prefix . 'order=' .
                        substr($this->column['key'][$key], 2) . '"><div class="grd' .
                        $this->column['size'][$key] . '">' . $value . '</div></a>';
            } else {
                $result .= '<a href="' . $prefix . 'order=' .
                        $this->column['key'][$key] . '"><div class="grd' .
                        $this->column['size'][$key] . '">' . $value . '</div></a>';
            }
        }
        // action haader
        $result .= '<div class="grd' . $this->action['size'] . '"> &nbsp; </div>';
        $result .= '</div>
    </li>';

        // show all records in this page
        foreach ($this->assoc_list as $record) {
            //start with bulk action checkbox and id
            $result .= '<li> 
        <div  class="row">';
            $result .= '<div class="grd1"> <input type="checkbox" '
                    . 'class="listview-checkbox" name="id[]" value="' . $record[$this->id] . '" /> </div>';

            $result .= '<div class="grd2"> ' . $record[$this->id] . ' </div>';

            // show record columns added before by size
            foreach ($this->column['key'] as $key => $value) {
                if (strpos($value, ',') == false) {

                    $result .= '<div class="grd' .
                            $this->column['size'][$key] . '">';

                    switch (substr($value, 0, 2)) {
                        case '%i':
                            $a = substr($value, 2);
                            $result .= long2ip($record[$a]);

                            break;
                        case '%t':
                            $a = substr($value, 2);
                            $result .= $date->PDate($date_format, $record[$a]);

                            break;
                        case '%1':
                        case '%2':
                        case '%3':
                        case '%4':
                        case '%5':
                        case '%6':
                        case '%7':
                        case '%8':
                        case '%9':
                            $p = substr($value, 1, 1);
                            $a = substr($value, 2);
                            $result .= sprintf($this->pattren[$p], $record[$a]);
                            break;

                        default:
                            $result .= $record[$value];
                            break;
                    }


                    $result .= '</div>';
                } else {
                    $temp = explode(',', $value);
                    $result .= '<div class="grd' .
                            $this->column['size'][$key] . '">';
                    foreach ($temp as $col) {

                        $result .= $record[$col] . PHP_EOL;
                    }
                    $result .= '</div>';
                }
            }

            // add action to record
            $result .= '<div class="grd' . $this->action['size'] . ' c' . ($this->action['class'] == '' ? '' : $record[$this->action['class']]) . '">';
            $tmp = str_replace("%id%", $record[$this->id], $this->action['pattern']);

            if ($this->id == 'comment_id') {
                $result .= str_replace("%topic%", $record['comment_topic_id'], $tmp);
            } else {
                $result .= $tmp;
            }
            $result .= '</div>';
            $result .= '</div>
    </li>';
        }

        $result .= '<ul>' . PHP_EOL;

        // if have bulk action show this after list view
        if ($this->bulk_action['title'] != array()) {
            $result .= '<div class="bulk-action">
                    <select name="action">';

            // list of bulk actions
            foreach ($this->bulk_action['function'] as $key => $value) {
                $result .= '<option  value="' . $value . ',' .
                        $this->bulk_action['value'][$key] . '">'
                        . $this->bulk_action['title'][$key] . '</option>';
            }

            $result .= '</select>';
            $result .= '<input type="submit" value="' . _lg('Bulk apply') . '" />'
                    . '<div class="left" > '
                    . '<input type="button" value="' . _lg('Check All') . '" class="chkall" data-chekbox="listview-checkbox" /> '
                    . '<input type="button" value="' . _lg('Check None') . '" class="chknone" data-chekbox="listview-checkbox" /> '
                    . '<input type="button" value="' . _lg('Check Toggle') . '" class="chktoggle" data-chekbox="listview-checkbox" /> '
                    . '</div>'
                    . '</div>'
                    . '</form>';
        }

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);

        echo $result;
    }

}
