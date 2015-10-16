<?php


function GetReqPageCount() {

    global $database_handle;

    $sql = "SELECT COUNT(*) AS 'count' FROM %table% "
            . "WHERE  req_status > 0 ;";
    $result = $database_handle->Select($sql, array('req'));

    $count = $result[0]['count'];
    if ($count == 0) {
        return 0;
    }
    $b = $count % PAGE_C;
    $page = floor(($count / PAGE_C));
    
    if ($b > 0) {
        $page++;
    }

    return $page;
}


function GetReq($limit = PAGE_C) {
    global $database_handle;
    
    $sql = "SELECT req_id,req_title FROM %table% "
            . "WHERE req_status > 0 LIMIT $limit;";
    $result = $database_handle->Select($sql, array('req'));
    return $result;
}



function GetTopicByLiker($m_id, $limit = PAGE_C) {
    global $database_handle;

    // else search in relation for tag
    $sql = "SELECT dst  FROM %table% "
            . "WHERE  "
            . "src = :s  AND "
            . "typ = 4 "
            . "LIMIT $limit";
    $sql_result = $database_handle->Select($sql, array('relation'), array('type' => 'ii',
        ":s" => $m_id));
    $a = array();
    foreach ($sql_result as $record) {
        $a[] = $record['dst'];
    }

    if (!is_array($a) || empty($a)) {
        return $a;
    }
//    print_r("SELECT topic_id,topic_title,topic_abstract,topic_image  FROM %table% WHERE topic_id IN(" . implode(',', $a) . ") AND topic_status > 0 ORDER BY topic_id DESC LIMIT $limit;");

    return $database_handle->Select("SELECT topic_id,topic_title,topic_abstract,topic_image  FROM %table% WHERE topic_id IN(" . implode(',', $a) . ") AND topic_status > 0 ORDER BY topic_id DESC ;", array('topic'));
}


function GetFrienz($m_id, $limit = PAGE_C) {
    global $database_handle;

    // else search in relation for tag
    $sql = "SELECT dst  FROM %table% "
            . "WHERE  "
            . "src = :s  AND "
            . "typ = 5 "
            . "LIMIT $limit";
    $sql_result = $database_handle->Select($sql, array('relation'), array('type' => 'ii',
        ":s" => $m_id));
    $a = array();
    foreach ($sql_result as $record) {
        $a[] = $record['dst'];
    }

    if (!is_array($a) || empty($a)) {
        return $a;
    }
//    print_r("SELECT topic_id,topic_title,topic_abstract,topic_image  FROM %table% WHERE topic_id IN(" . implode(',', $a) . ") AND topic_status > 0 ORDER BY topic_id DESC LIMIT $limit;");

    return $database_handle->Select("SELECT member_id,member_name FROM %table% WHERE member_id IN(" . implode(',', $a) . ")  ORDER BY RAND() ;", array('member'));
}

function promis($arry, $valid) {

    $a = array();

    foreach ($arry as $key => $value) {
        if (in_array($key, $valid)) {
            $a[$key] = $value;
        }
    }

    return $a;
}


function GetSreachPageCount($term) {

    global $database_handle;

    $sql = "SELECT COUNT(*) AS 'count' FROM %table% "
            . "WHERE topic_title REGEXP :term OR topic_text REGEXP :term OR topic_abstract REGEXP :term  AND topic_status > 0 ;";
    $result = $database_handle->Select($sql, array('topic'), array('type' => 's',
        ":term" => '^.*' . $term . '.*$'));

    $count = $result[0]['count'];
    if ($count == 0) {
        return 0;
    }
    $b = $count % PAGE_C;
    $page = floor(($count / PAGE_C));
    
    if ($b > 0) {
        $page++;
    }

    return $page;
}


function GetTopicBySearch($term,$limit = PAGE_C) {
    global $database_handle;
    
    $sql = "SELECT topic_id,topic_title,topic_abstract,topic_image FROM %table% "
            . "WHERE topic_title REGEXP :term OR topic_text REGEXP :term OR "
            . "topic_abstract REGEXP :term AND topic_status > 0 LIMIT $limit;";
    $result = $database_handle->Select($sql, array('topic'), array('type' => 's',
        ":term" => '^.*' . $term . '.*$'));
    return $result;
}

function GetPageByCat($cat_id) {
    global $database_handle;

    // else search in relation for tag
    $sql = "SELECT COUNT(dst) AS 'count'  FROM %table%,sc_topic "
            . "WHERE dst = topic_id AND "
            . "src = :s  AND topic_status > 0 AND "
            . "typ = 2 ";
    $sql_result = $database_handle->Select($sql, array('relation'), array('type' => 'ii',
        ":s" => $cat_id));
    $count = $sql_result[0]['count'];
    $b = $count % PAGE_C;
    $page = floor(($count / PAGE_C));
    ;
    if ($b > 0) {
        $page++;
    }

    return $page;
}

function GetTopicByCategory($cat_id, $limit = PAGE_C) {
    global $database_handle;

    // else search in relation for tag
    $sql = "SELECT dst  FROM %table%,sc_topic "
            . "WHERE dst = topic_id AND "
            . "src = :s  AND topic_status > 0 AND "
            . "typ = 2 ORDER BY topic_id DESC "
            . "LIMIT $limit";
    $sql_result = $database_handle->Select($sql, array('relation'), array('type' => 'ii',
        ":s" => $cat_id));
    $a = array();
    foreach ($sql_result as $record) {
        $a[] = $record['dst'];
    }

    if (!is_array($a) || empty($a)) {
        return $a;
    }
//    print_r("SELECT topic_id,topic_title,topic_abstract,topic_image  FROM %table% WHERE topic_id IN(" . implode(',', $a) . ") AND topic_status > 0 ORDER BY topic_id DESC LIMIT $limit;");

    return $database_handle->Select("SELECT topic_id,topic_title,topic_abstract,topic_image  FROM %table% WHERE topic_id IN(" . implode(',', $a) . ") AND topic_status > 0 ORDER BY topic_id DESC ;", array('topic'));
}

function GetPageByTag($tag_id) {
    global $database_handle;

    // else search in relation for tag
    $sql = "SELECT COUNT(dst) AS 'count'  FROM %table%,sc_topic "
            . "WHERE dst = topic_id AND "
            . "src = :s  AND topic_status > 0 AND "
            . "typ = 1 ";
    $sql_result = $database_handle->Select($sql, array('relation'), array('type' => 'ii',
        ":s" => $tag_id));
    $count = $sql_result[0]['count'];
    $b = $count % PAGE_C;
    $page = floor(($count / PAGE_C));
    ;
    if ($b > 0) {
        $page++;
    }

    return $page;
}

function GetTopicByTag($tag_id, $limit = PAGE_C) {
    global $database_handle;

    // else search in relation for tag
    $sql = "SELECT dst  FROM %table%,sc_topic "
            . "WHERE dst = topic_id AND "
            . "src = :s  AND topic_status > 0 AND "
            . "typ = 1 "
            . "LIMIT $limit";
    $sql_result = $database_handle->Select($sql, array('relation'), array('type' => 'ii',
        ":s" => $tag_id));
    $a = array();
    foreach ($sql_result as $record) {
        $a[] = $record['dst'];
    }

    if (!is_array($a) || empty($a)) {
        return $a;
    }

    return $database_handle->Select("SELECT topic_id,topic_title,topic_abstract,topic_image  FROM %table% WHERE topic_id IN(" . implode(',', $a) . ") AND topic_status > 0 ORDER BY topic_id DESC ;", array('topic'));
}

function GetTopic($order = 'topic_id ASC', $limit = 30) {
    global $database_handle;
    return $database_handle->Select("SELECT topic_id,topic_title,topic_abstract,topic_image  FROM %table% WHERE topic_status > 0  ORDER BY $order LIMIT $limit ;", array('topic'));
}

function GetCount($table, $where = '1') {
    global $database_handle;
    $ret = $database_handle->Select("SELECT COUNT(*) AS 'count' FROM %table% WHERE " . $where, array($table));
    return $ret[0]['count'];
}

function TagRandom($limit = '10') {
    global $database_handle;
    $ret = $database_handle->Select("SELECT * FROM %table% ORDER BY RAND()  LIMIT " . $limit, array('tag'));
    return $ret;
}

function CatChildCount($id) {
    global $database_handle;
    $ret = $database_handle->Select("SELECT COUNT(*) AS 'count' FROM %table%"
            . " WHERE category_parent = :par ", array('category'), array(':par' => $id));
    return $ret[0]['count'];
}

function GetAttached($destination, $type = REALTION_ATTACH) {
    global $database_handle;
    $rel = TRelation::GetInstance();
    $result = $rel->GetByDestination($destination, $type);
    if (count($result) > 0) {
        $sql = "SELECT attach_filename,attach_url FROM %table% WHERE attach_id IN(" .
                implode(',', $result) . ') ;';
        $result = $database_handle->select($sql, array('attach'));
    }
    return $result;
}

function CommentChildCount($topic_id, $parent) {
    global $database_handle;
    $ret = $database_handle->Select("SELECT COUNT(*) AS 'count' FROM %table%"
            . " WHERE comment_parent = :par AND comment_topic_id = :id AND comment_status = 1 ", array('comment'), array(':par' => $parent, ':id' => $topic_id));
    return $ret[0]['count'];
}

function ShowCommentByParent($topic_id, $parent, $is_child) {
    $date = TDate::GetInstance();
    global $database_handle;
    $sql = "SELECT comment_id,comment_member_id,comment_time,comment_text
            , m.member_name, f.manager_displayname 
            FROM " . DB_PREFIX . "comment c
            LEFT JOIN " . DB_PREFIX . "member m on m.member_id = c.comment_member_id
            LEFT JOIN " . DB_PREFIX . "manager f on f.manager_id = c.comment_member_id*-1  "
            . " WHERE comment_parent = :par AND comment_topic_id = :id AND comment_status = 1 "
            . " ORDER BY comment_id DESC ";

    $ret = $database_handle->Select($sql, array('comment'), array(':par' => $parent, ':id' => $topic_id));
    $result = null;
    foreach ($ret as $comment) {
        $result .= '<li>';
        $result .= '<div class="head">
                        <img alt="[avatar]" src="/upload/member/' . $comment['comment_member_id'] . '.jpg" class="avatar">
                        ';
        if (isset($_COOKIE['mid'])) {
            $result .= '<button class="reply left" data-id="' . $comment['comment_id'] . '"> پاسخ</button>';
        }
        if ($comment['comment_member_id'] > 0) {
            $result .= '<a href="/member/' . $comment['comment_member_id'] . '/' . $comment['member_name'] . '">';
        }
        $result.= '<span class="author">
                            ' . $comment['manager_displayname'] . $comment['member_name'] . '
                        </span>';
        if ($comment['comment_member_id'] > 0) {
            $result .= '</a>';
        }
        $result.= '<span class="date">
                            ' . $date->RDate($comment['comment_time']) . '
                        </span>
                    </div>
                    <p>
                        ' . $comment['comment_text'] . '
                    </p>';
        if ($is_child && (CommentChildCount($topic_id, $comment['comment_id']) > 0)) {
            $result .= '<ul>';
            $result .= ShowCommentByParent($topic_id, $comment['comment_id'], $is_child);
            $result .= '</ul>';
        }
        $result .= '</li>';
    }
    return $result;
}
