<?php

$rel_cls = TRelation::GetInstance();

function GetRelDst($typ, $table, $arg = array()) {
    // get global array
    global $ID, $database_handle;


    $fields = isset($arg['fields']) ? $arg['fields'] : '*';
    $prefix = isset($arg['prefix']) ? $arg['prefix'] : $table . '_';
    $order = isset($arg['order']) ? $arg['order'] : $prefix . 'id DESC';
    $filter = isset($arg['rule']) ? ' AND ' . $arg['rule'] : null;
    $rule = isset($arg['rule']) ? ' AND ' . $arg['rule'] : null;

    $sql = "SELECT  o.{$fields} FROM " . DB_PREFIX . "relation AS r "
            . "JOIN %table% AS o ON  r.src = o.{$prefix}id WHERE "
            . "r.dst = {$ID} AND r.typ = {$typ} {$rule} {$filter} ORDER BY {$order} ;";
//    die($sql);
    return $database_handle->Select($sql, array($table));
}

function GetRelSrc($typ, $table, $arg = array()) {
    // get global array
    global $ID, $database_handle;

    $fields = isset($arg['fields']) ? $arg['fields'] : '*';
    $prefix = isset($arg['prefix']) ? $arg['prefix'] : $table . '_';
    $order = isset($arg['order']) ? $arg['order'] : $prefix . 'id DESC';
    $filter = isset($arg['filter']) ? ' AND ' . $arg['filter'] : null;
    $rule = isset($arg['rule']) ? ' AND ' . $arg['rule'] : null;

    $sql = "SELECT  o.{$fields} FROM " . DB_PREFIX . "relation AS r "
            . "JOIN %table% AS o ON  r.dst = o.{$prefix}id WHERE "
            . "r.src = {$ID} AND r.typ = {$typ} {$rule} {$filter} ORDER BY {$order} ;";
//    die($sql);
    return $database_handle->Select($sql, array($table));
}

function GetTag($suffix = null, $arg = array()) {

    if ($suffix == null) {
        global $rel_typ_suffix;
        $typ = '1' . $rel_typ_suffix;
    } else {
        $typ = '1' . $suffix;
    }
    $rule = isset($arg['rule']) ? $arg['rule'] : null;
    return GetRelDst($typ, 'tag', array('rule' => $rule));
}