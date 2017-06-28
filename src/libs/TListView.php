<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
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
    // private serach
    private $search = null;
    // private relation
    private $relation = array();

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

        $result = null;

        // show saerch or item 
        if ($this->search != null || $this->relation != array()) {

            $result .= '<div class="listview-search" ><div class="row">';
            // show search here
            if ($this->search != null) {

//            die($prefix);

                $result .= '<div class="grd12"><form class="ui form "  action="' . UR_MP . $location . '">';

                $result .= '<div class="ui icon input">
                                <input type="text" name="search" placeholder="' . _lg('Search') . '..."  class="search-box" >
                            </div>';
                $result .= '<input type="hidden" name="fields" class="search-fields" value="' . $this->search . '"  />';
                if (isset($_GET['filter'])) {
                    $result .= '<input type="hidden" name="filter" value="' . $_GET['filter'] . '"  />';
                }
                $result .= '&nbsp;<button class="ui button"><span class="fa fa-search"></span></button>';
                if (isset($_GET['search']) && $_GET['search'] != '') {
                    $result .= '&nbsp;<button class="ui button" onclick="$(this).parent().find(\'.search,.search-fields\').remove();"><span class="fa fa-close"></span></button>';
                }
                $result .= '</form></div>';
            }

            // relation info
            if ($this->relation != array()) {

                $md = new TModel($this->relation['table']);
                $result .= '<form class="grd12 "  action="' . UR_MP . $location . '">' .
                        ($this->relation['ico'] != '' ? '<span class="fa fa-' .
                                $this->relation['ico'] . '"></span>&nbsp;&nbsp;' : '')
                        . '<select name="rel" class="rel ui dropdown">';

                $result .= '<option value="0" >' . _lg('Select an item to search') . '</option>';

                foreach ($md->Selectable($this->relation['title'], $this->relation['value']) as $item) {


                    $result .= '<option value="' . $item[0] . '" ' .
                            (isset($_GET['rel']) && $_GET['rel'] == $item[0] ? 'selected="selected"' : '') . ' >' .
                            $item[1]
                            . '</option>';
                }
                $result .= '</select>';
                $result .= '<input type="hidden" name="typ" class="rel-type" value="' .
                        $this->relation['rel_type'] . '" />';

                $result .= '&nbsp;<button  class="ui button"><span class="fa fa-search"></span></button>';
                if (isset($_GET['rel']) && $_GET['rel'] != '') {
                    $result .= '&nbsp;<button class="ui button" onclick="$(this).parent().find(\'.rel,.rel-type\').remove();"><span class="fa fa-close"></span></button>';
                }
                $result .= '</form>';
            }

            $result .= '</div></div>';
        }


        // show all filter here
        if ($this->filter['title'] != array()) {

            $result .= '<div class="listview-filter">';

            // get prefix
            $prefix = GetLinkPrefix('filter');
            // show title and no filter item named "All";
            $result .= '<span> ' . _lg('Filter') . ': </span> <a class="ui button" href="' . $prefix . '"> ' . _lg('All') . '</a>';

            // show filter lisr
            foreach ($this->filter['title'] as $key => $value) {
                $result .= '<a class="button ui" href="' . $prefix . 'filter=' .
                        $this->filter['key'][$key] . ',' .
                        $this->filter['value'][$key] . '">' . _lg($value) . '</a>';
            }

            $result .= '</div>';
        }

        // get order by column 
        $prefix = GetLinkPrefix('order,desc');

        // get id order and choose good value for this
        if (isset($_GET['order']) && $_GET['order'] == $this->id) {
            $id_order = $prefix;
        } else {
            $id_order = $prefix . 'order=' . $this->id;
        }


        // show form head here when have bulk action
        if ($this->bulk_action['title'] != array()) {
            $result .= '<form class="listview-form" method="post" action="' . UR_MP . $location . '/BulkAction">';
        }


        //start render listview header
        // start with bulk action checkbox and id header
        $result .= '<ul class="listview">
    <li class="list-header"> 
        <div  class="row">
            <div class="grd1 head"> <input type="checkbox" class="checkall" />  </div>
            <a href="' . $id_order . '" class="grd2 head"> ' . _lg('no.') . '</a>';
        // show header column title
        foreach ($this->column['title'] as $key => $value) {

            if (substr($this->column['key'][$key], 0, 1) == '%') {
                $col_name = substr($this->column['key'][$key], 2);
            } else {
                $col_name = $this->column['key'][$key];
            }
            $result .= '<a href="' . $prefix . 'order=' . $col_name
                    . (!isset($_GET['desc']) && isset($_GET['order']) && $_GET['order'] == $col_name ? '&desc=1' : '' ) . '"  class="grd' .
                    $this->column['size'][$key] . ' head" >' . _lg($value) . '</a>';
        }
        // action haader
        $result .= '<div class="grd' . $this->action['size'] . ' head"> &nbsp; </div>';
        $result .= '</div>
    </li>';

        // show all records in this page
        foreach ($this->assoc_list as $record) {
            //start with bulk action checkbox and id
            $result .= '<li> 
        <div  class="row">';
            $result .= '<div class="grd1  text-center">' . PHP_EOL
                    . ' <input type="checkbox" '
                    . 'class="listview-checkbox" name="id[]" value="' . $record[$this->id] . '" />' . PHP_EOL
                    . ' </div>' . PHP_EOL;

            $result .= '<div class="grd2 text-center"> ' . $record[$this->id] . ' </div>';

            // show record columns added before by size
            foreach ($this->column['key'] as $key => $value) {
                if (strpos($value, ',') == false) {

                    $result .= PHP_EOL . '<div class="grd' .
                            $this->column['size'][$key] . '">' . PHP_EOL;

                    switch (substr($value, 0, 2)) {
                        case '%i':
                            // ip 
                            $a = substr($value, 2);
                            $result .= long2ip($record[$a]);
                            break;

                        case '%c':
                            // currency
                            $a = substr($value, 2);
                            $result .= number_format($record[$a]);
                            break;

                        case '%t':
                            // time
                            $a = substr($value, 2);
                            $result .= $date->SDate(DT_SHORT_TIME, $record[$a]);
                            break;

                        case '%u':
                            // datetime
                            $a = substr($value, 2);
                            $result .= $date->SDate(DT_SHORT_FULL_DATETIME, $record[$a]);
                            break;

                        case '%d':
                            // date
                            $a = substr($value, 2);
                            $result .= $date->SDate(DT_SHORT_DATE, $record[$a]);
                            break;

                        case '%a':
                            // show array
                            $a = substr($value, 2);
                            $v = explode('|', $a);
                            $arr = $v[0];
                            global $$arr;
                            $array = $$arr;
                            $result .= $array[$record[$v[1]]];
                            break;
                        case '%e':
                            // linked edit column
                            $a = substr($value, 2);
                            $result .= '<a class="edit" href="' . UR_MP . $location . '/Edit/' . $record[$this->id] . '">' . $record[$a] . '</a>';
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


                    $result .= '</div>' . PHP_EOL;
                } else {
                    $temp = explode(',', $value);
                    $result .= PHP_EOL . '<div class="grd' .
                            $this->column['size'][$key] . '">';
                    foreach ($temp as $col) {

                        $result .= $record[$col] . PHP_EOL;
                    }
                    $result .= '</div>' . PHP_EOL;
                }
            }

            // add action to record
            $result .= PHP_EOL . '<div class="grd' . $this->action['size'] . ' c' . ($this->action['class'] == '' ? '' : $record[$this->action['class']]) . '">';
            $tmp = str_replace("%id%", $record[$this->id], $this->action['pattern']);

            if ($this->id == 'comment_id') {
                $result .= str_replace("%topic%", $record['comment_topic_id'], $tmp);
            } else {
                $result .= $tmp;
            }
            $result .= '</div>' . PHP_EOL;
            $result .= '</div>' . PHP_EOL
                    . '</li>' . PHP_EOL;
        }

        $result .= '</ul>' . PHP_EOL;


        // if have bulk action show this after list view
        if ($this->bulk_action['title'] != array()) {
            $result .= '<div class="listview-bulk-action">
                    <select name="action" class=" ui dropdown">';

            // list of bulk actions
            foreach ($this->bulk_action['function'] as $key => $value) {
                $result .= '<option  value="' . $value . ',' .
                        $this->bulk_action['value'][$key] . '">'
                        . _lg($this->bulk_action['title'][$key]) . '</option>';
            }

            $result .= '</select> &nbsp;';
            $result .= '<input class="ui button" type="submit" value="' . _lg('Bulk apply') . '" />'
                    . '<div class="left" > '
                    . '<input type="button" value="' . _lg('Check All') . '" class="chkall ui button positive" data-chekbox="listview-checkbox" /> '
                    . '<input type="button" value="' . _lg('Check None') . '" class="chknone ui button orange" data-chekbox="listview-checkbox" /> '
                    . '<input type="button" value="' . _lg('Check Toggle') . '" class="chktoggle ui button" data-chekbox="listview-checkbox" /> '
                    . '</div>'
                    . '</div>'
                    . '</form>';
        }

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);

        echo $result;
    }

    /**
     * search in loading item.
     * @param string $fields imploded string for search
     */
    function AddSearch($fields) {
        $this->search = $fields;
    }

    /**
     * add relationship
     * @param string $base_id base list id in db table for show in select
     * @param string $base_title base tatile in db table for show in select
     * @param string $base_table base table name
     * @param int $rel_type relationship type int
     * @param string $rel_icon awesome icon show
     */
    function AddRelation($base_id, $base_title, $base_table, $rel_type, $rel_icon = '') {

        $this->relation = array('value' => $base_id, 'title' => $base_title, 'table' => $base_table, 'rel_type' => $rel_type, 'ico' => $rel_icon);
    }

}
