<?php

$clean = array_map('strip_tags', $_POST);

$result['success'] = false;
$result['value'] = 'unknow error';

switch ($url[1]) {
    case 'regiter':

        $valid = array('member_name', 'member_email', 'member_password', 'member_password2', 'member_degree', 'member_field', 'member_number', 'member_city');

        $insert = promis($clean, $valid);

        if ($insert['member_password'] != $insert['member_password2']) {
            $result['value'] = 'پسورد ها یکی نیستند';
            echo json_encode($result);
            die;
        } else {

            $insert['member_password'] = Password($insert['member_password']);
            unset($insert['member_password2']);
        }



        if (!filter_var($insert['member_email'], FILTER_VALIDATE_EMAIL)) {
            $result['value'] = '   ایمیل معتبر نیست';
            echo json_encode($result);
            die;
        }


        if ((strlen($insert['member_name']) < 5) || strlen($insert['member_password']) < 5) {
            $result['value'] = ' نام یا گذرواژه خیلی کوتاه است ';
            echo json_encode($result);
            die;
        }
        
        if ((strlen($insert['member_number']) != 11) || (substr($insert['member_number'], 0, 2) != '09')) {
            $result['value'] = ' شماره مورد نظر اشتباه است ';
            echo json_encode($result);
            die;
        }
        
        


        $m = new TModel('member', 'member_');

        $sql = "SELECT COUNT(*) AS 'count' FROM %table% "
            . "WHERE member_email = :mail  ";
        $result = $m->db->Select($sql, array('member'), array('type' => 's',
        ":mail" => $insert['member_email'] ));

        $count = $result[0]['count'];
        
        if ( $count > 0) {
            $result['value'] = '  این ایمیل قبلا ثبت شده  است';
            echo json_encode($result);
            die;
        }
        
        $insert['member_register_time'] = time();
        $m->Create($insert);

        $result['success'] = true;
        $result['value'] = '/msg/ثبت نام شما با موفقیت انجام شد ، از ثبت نام شما متشکر هستیم شما میبایستی تا تایید مدیر سایت صبر کنید این فرآیند ممکن است چند ساعت طول بکشد';
        echo json_encode($result);
        die;

        break;
    case 'barname':

        $valid = array('req_title', 'req_text');

        $insert = promis($clean, $valid);



        if ((strlen($insert['req_title']) < 5) || strlen($insert['req_text']) < 10) {
            Redirect('/msg/' . ' عنوان یا درخواست خیلی کوتاه است');
        } else {


            $m = new TModel('req', 'req_');

            $insert['req_member_id'] = $_COOKIE['mid'];

            
            $a = $m->Create($insert);
            Redirect('/msg/' . ' برنامه درخواستی شما ثبت شد و به زودی ترتیب اثر داده خواهد شد');
        }

        break;
    case 'profile':

        $valid = array('member_name', 'member_degree', 'member_field', 'member_number', 'member_city', 'member_status');

        $edit = promis($clean, $valid);
        $m = new TModel('member', 'member_');

        $m->Edit($_COOKIE['mid'], $edit);

        if (isset($_FILES['member_avatar'])) {
            $up = new TUpload();
            $up->SaveAvatar('member_avatar', $_COOKIE['mid']);
        }
        GoBack();
        $result['success'] = false;
        $result['value'] = 'ویرایش با موفقیت انجام شد';
        echo json_encode($result);
        die;

        break;
    case 'like':
        if (isset($_COOKIE['mid'])) {

            $r = TRelation::GetInstance();
            if ($clean['like'] == 1) {
                $b = $r->Has($_COOKIE['mid'], $clean['id'], REALTION_LIKE);
                if ($b) {
                    $result['success'] = false;
                    $result['value'] = 'شما قبلا این پست را لایک کرده اید.';
                    echo json_encode($result);
                    die;
                } else {

                    $result['success'] = $r->Add($_COOKIE['mid'], $clean['id'], REALTION_LIKE);
                    $result['value'] = 'لایک با موفقیت انجام نشد';
                    echo json_encode($result);
                    die;
                }
            } else {
                $result['success'] = $r->Remove($_COOKIE['mid'], $clean['id'], REALTION_LIKE);
                $result['value'] = 'لایک با موفقیت انجام نشد';
                echo json_encode($result);
                die;
            }
        }
        $result['success'] = false;
        $result['value'] = 'اعتبار حساب کاربری شما برای لایک خدشه دار است.';
        echo json_encode($result);
        break;



    case 'friend':
        if (isset($_COOKIE['mid'])) {

            $r = TRelation::GetInstance();

            if ($_COOKIE['mid'] == $clean['id']) {
                $result['success'] = false;
                $result['value'] = 'شما نمیتوانید خودتان را به عنوان دوست انتخاب کنید';
                echo json_encode($result);
                die;
            }

            if ($clean['frnd'] == 1) {
                $b = $r->Has($_COOKIE['mid'], $clean['id'], REALTION_FRIEND);
                if ($b) {
                    $result['success'] = false;
                    $result['value'] = 'شما قبلا به دوستان اضافه کرده اید.';
                    echo json_encode($result);
                    die;
                } else {

                    $result['success'] = $r->Add($_COOKIE['mid'], $clean['id'], REALTION_FRIEND);
                    $result['value'] = 'افزودن با موفقیت انجام نشد';
                    echo json_encode($result);
                    die;
                }
            } else {
                $result['success'] = $r->Remove($_COOKIE['mid'], $clean['id'], REALTION_FRIEND);
                $result['value'] = 'افزودن با موفقیت انجام نشد';
                echo json_encode($result);
                die;
            }
        }
        $result['success'] = false;
        $result['value'] = 'اعتبار حساب کاربری شما برای لایک خدشه دار است.';
        echo json_encode($result);
        break;
    case 'comment';
        if (isset($_COOKIE['mid'])) {
            $valid = array('comment_parent', 'comment_text', 'comment_topic_id');

            $edit = promis($clean, $valid);
            $m = new TModel('comment', 'comment_');
            $data = array('comment_parent' => $clean['comment_parent'],
                'comment_text' => $clean['comment_text'],
                'comment_topic_id' => $clean['comment_topic_id'],
                'comment_member_id' => $_COOKIE['mid'],
                'comment_time' => time(),
                'comment_ip' => _ipi());
            $tmp = $m->Create($data);
            if (isset($clean['ajax'])) {
                $result['success'] = ($tmp != false ? true : false);
                echo json_encode($result);
                die;
            } else {
                GoBack();
            }
        } else {

            $result['value'] = 'شما بایستی وارده شده باشید';
            echo json_encode($result);
            die;
        }
        break;
    default:
        break;
}

