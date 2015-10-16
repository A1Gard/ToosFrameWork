<?php

function GetRule() {

    global $rule;
    if (!isset($_SESSION['mid']) && !isset($_SESSION['MN_TYPE'])) {
        $ret = $rule['visitor'];
    } else if (isset($_SESSION['MN_TYPE'])) {
        $ret = $rule['manager'][$_SESSION['MN_TYPE']];
    } else {
        $ret = $ret['member'][$_SESSION['mtype']];
    }
    return ($ret == null ? $rule['default'] : $ret);
}

function IsID($id) {

    $id = (int) $id;
    if ($id > 0) {
        return $id;
    } else {
        return false;
    }
}

function GetRecord($id = null) {

    if ($id == null) {
        global $ID;
        $id = (int) $ID;
    } else {
        $id = (int) $id;
    }

    global $table;

    $prefix = isset($arg['prefix']) ? $arg['prefix'] : $table . '_' ;
    
    $rule =  ' AND ' . GetRule();
    
    
    $model = new TModel($table, $prefix);

    $record = $model->GetRecord($id, $rule);

    return $record ;
}

function GetPage($arg = array()) {
    
}
