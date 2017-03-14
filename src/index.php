<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   index.php
 * @issue : index page link to all CM with bootstrap 
 */

// is user in manager page
define('__MP__', FALSE);
    



session_start();
ob_start();
require_once './tconstant.php';
require_once './inc/header.php';

define('PAGE_C', 24);

require './api/general.php';
require './api/relation.php';

require './tempp/topic.php';

$a = GetTag();

$a = GetRecord($ID);


$dt = new TDate();
$st = new TStatistic();
$st->Count();

$viss['visitcount'] = $st->VisitCount($dt->Today(), time());
$viss['visitorcount'] = $st->VisitorCount($dt->Today(), time());
$viss['y'] = $st->VisitCount($dt->Yesterday(), $dt->Today());
$viss['totoal'] = $st->VisitCount(0, time());
$viss['online'] = $st->OnlineCount();

//print_r($viss);die;
$smarty->assign('vss', $viss);

if (isset($_COOKIE['mid'])) {
    $_SESSION['mid'] = $_COOKIE['mid'];
}

if (isset($url[1]) && ($url[0] == 'form') && isset($_POST)) {

    require './inc/form.php';
} else {

    switch ($url[0]) {
        case 'index.php':
            $smarty->assign('title', $title);
            $smarty->display('header.tpl');
            require './inc/index.php';
            $smarty->display('index.tpl');
            break;
        case 'سرفصل':

            if (CatChildCount($url[1]) == 0) {
                require './inc/clist.php';
                $body = 'list';
            } else {
                require './inc/cats.php';
                $body = 'cats';
            }
            $smarty->assign('title', $title);
            $smarty->display('header.tpl');
            $smarty->display($body . '.tpl');
            break;
        case 'کارنامه':

            if ((int) $url[1] < 1) {
                $smarty->assign('title', '404 : چیزی  پیدا نشد  - ' . $title);
                $smarty->display('header.tpl');
                $smarty->display('404.tpl');
            } else {
                $rm = new TModel('report', 'report_');
                $report = $rm->GetRecord($url[1]);
                print_r($_SESSION);
//                print_r($report );
                if ($report['report_member_id'] != $_SESSION['mid']) {
                    $smarty->assign('title', '404 : چیزی  پیدا نشد  - ' . $title);
                    $smarty->display('header.tpl');
                    $smarty->display('404.tpl');
                } else {

                    $smarty->assign('rp', $report);
                    $smarty->assign('title', $report['report_title'] . '-' . $title);
                    $smarty->display('header.tpl');
                    $smarty->display('report.tpl');
                }
            }
            break;
        case 'یادداشت':

            if ((int) $url[1] < 1) {
                $smarty->assign('title', '404 : چیزی  پیدا نشد  - ' . $title);
                $smarty->display('header.tpl');
                $smarty->display('404.tpl');
            } else {
                $topic = $model->GetRecord($url[1]);
                $model->edit($topic['topic_id'], array('topic_counter' => ($topic['topic_counter'] + 1)));
                if (($topic == FALSE) || $topic['topic_status'] == 0) {
                    $smarty->assign('title', '404 : چیزی  پیدا نشد  - ' . $title);
                    $smarty->display('header.tpl');
                    $smarty->display('404.tpl');
                } else {
                    require './inc/single.php';
                    $smarty->assign('title', $topic['topic_title'] . '-' . $title);
                    $smarty->display('header.tpl');
                    $smarty->display('single.tpl');
                }
            }
            break;
        case 'برنامه':

            if ((int) $url[1] < 1) {
                $smarty->assign('title', '404 : چیزی  پیدا نشد  - ' . $title);
                $smarty->display('header.tpl');
                $smarty->display('404.tpl');
            } else {
                $m = new TModel('req', 'req_');
                $req = $m->GetRecord($url[1]);
                if (($req == FALSE) || $req['req_status'] == 0) {
                    $smarty->assign('title', '404 : چیزی  پیدا نشد  - ' . $title);
                    $smarty->display('header.tpl');
                    $smarty->display('404.tpl');
                } else {

                    $smarty->assign('title', $req['req_title'] . '-' . $title);
                    $smarty->assign('req', $req);
                    $smarty->display('header.tpl');
                    $smarty->display('req.tpl');
                }
            }
            break;
        case 'برچسب':
            if ((int) $url[1] < 1) {
                $smarty->assign('title', '404 : چیزی  پیدا نشد  - ' . $title);
                $smarty->display('header.tpl');
                $smarty->display('404.tpl');
            } else {
                $m = new TModel('tag', 'tag_');
                $tag = $m->GetRecord($url[1]);
                if ($tag == FALSE) {

                    $smarty->assign('title', '404 : چیزی  پیدا نشد  - ' . $title);
                    $smarty->display('header.tpl');
                    $smarty->display('404.tpl');
                } else {

                    $smarty->assign('title', $tag['tag_label'] . '-برچسب-' . $title);
                    $smarty->display('header.tpl');
                    require './inc/tag.php';
                    $smarty->display('list.tpl');
                }
            }
            break;

        case 'search':

            if ((!isset($_GET['search'])) || strlen($_GET['search']) < 3) {

                $smarty->assign('msg', 'عبارت جستجو شده بسیار کوچک است');
                $smarty->display('message.tpl');
            } else {

                $page_count = GetSreachPageCount($_GET['search']);

                if ($page_count == 0) {

                    $smarty->assign('title', '404 : چیزی  پیدا نشد  - ' . $title);
                    $smarty->display('header.tpl');
                    $smarty->display('404.tpl');
                } else {

                    $smarty->assign('title', 'جستجو برای "' . $_GET['search'] . '" - ' . $title);
                    $smarty->display('header.tpl');
                    require './inc/search.php';
                    $smarty->display('list.tpl');
                }
            }
            break;

        case 'ورود':
            $smarty->assign('title', 'ورود به حساب کاربری - ' . $title);
            $smarty->display('header.tpl');
            require_once './inc/login.php';
            $smarty->display('login.tpl');
            break;
        case 'شبکه':

            $smarty->assign('title', 'شبکه اجتماعی دپارتمان - ' . $title);
            $smarty->display('header.tpl');
            require_once './inc/social.php';
            $smarty->display('social.tpl');
            break;
        case 'برنامه-فردی':

            $smarty->assign('title', 'فهرست برنامه های فردی - ' . $title);
            $smarty->display('header.tpl');
            require_once './inc/barn.php';
            $smarty->display('barn.tpl');
            break;
        case 'ثبت-نام':
            $smarty->assign('title', 'ثبت نام  (عضویت) - ' . $title);
            $smarty->display('header.tpl');
            require './inc/regiter.php';
            $smarty->display('regiter.tpl');
            break;
        case 'پروفایل':
            $smarty->assign('title', 'پروفایل شما - ' . $title);
            $smarty->display('header.tpl');
            require './inc/profile.php';
            $smarty->display('profile.tpl');
            break;
        case 'خصوصی':
            $smarty->assign('title', 'حریم خصوصی شما - ' . $title);
            $smarty->display('header.tpl');
            require './inc/private.php';
            $smarty->display('private.tpl');
            break;
        case 'msg':
            if (!isset($url[1])) {
                $url[1] = 'خطا';
            }
            $smarty->assign('title', $url[1] . '-' . $title);
            $smarty->display('header.tpl');
            $smarty->assign('msg', $url[1]);
            $smarty->display('message.tpl');
            break;
        case 'member':

            if ((int) $url[1] < 1) {
                $smarty->assign('title', '404 : چیزی  پیدا نشد  - ' . $title);
                $smarty->display('header.tpl');
                $smarty->display('404.tpl');
            } else {
                $m = new TModel('member', 'member_');
                $member = $m->GetRecord($url[1]);
                if ($member == FALSE) {
                    $smarty->assign('title', '404 : چیزی  پیدا نشد  - ' . $title);
                    $smarty->display('header.tpl');
                    $smarty->display('404.tpl');
                } else {
                    $smarty->assign('title', $member['member_name'] . '- نمایه عضو دپارتمان - ' . $title);
                    $smarty->display('header.tpl');
                    require './inc/member.php';
                    $smarty->display('member.tpl');
                }
            }
            break;
        case 'err':
            $smarty->assign('err', $reg->GetValue(ROOT_SYSTEM, 'error'));
            $smarty->display('error.tpl');
            break;
        case 'خروج':


            // failed
            $_GET['msg'] = 'خروج با موفقیت انجام شد';
            setcookie('mid', null, time() - 300);
            setcookie('mtype', null, time() - 300);
            setcookie('mname', null, time() - 300);
            setcookie('mact', null, time() - 300);
            $smarty->display('header.tpl');
            $smarty->display('message.tpl');

            break;

        default:

            $st->Discount();
            $smarty->assign('title', '404 : چیزی  پیدا نشد  - ' . $title);
            $smarty->display('header.tpl');
            $smarty->display('404.tpl');
            break;
    }

    $smarty->display('footer.tpl');
}
