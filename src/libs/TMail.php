<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 10-July-2014 (19 - 04 - 93)
 * @time : 15:39 
 * @subpackage   TMail
 * @version 0.8.5
 * @todo : send email class
 */

class TMail {
    /**
     * 
     * @param string $to mail address
     * @param string $subject
     * @param string $message
     * @param string $from mail address
     * @param string $file attached file addres
     * @return bool
     * @source http://stackoverflow.com/questions/4586557/php-send-email-with-attachment
     */
    public static function SendMailWidthAttachment($to, $subject, $message, $from, $file) {
        
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $to, $subject,
                $message, $from, $file);
        
        
        // $file should include path and filename
        $filename = basename($file);
        $file_size = filesize($file);
        $content = chunk_split(base64_encode(file_get_contents($file)));
        $uid = md5(uniqid(time()));
        $from = str_replace(array("\r", "\n"), '', $from); // to prevent email injection
        $subject = "=?utf-8?b?" . base64_encode($subject) . "?=";
        $header = "From: " . $from . "\r\n"
                . "MIME-Version: 1.0\r\n"
                . "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n"
                . "This is a multi-part message in MIME format.\r\n"
                . "--" . $uid . "\r\n"
                . "Content-type:text/plain; charset=utf-8\r\n"
                . "Content-Transfer-Encoding: 7bit\r\n\r\n"
                . $message . "\r\n\r\n"
                . "--" . $uid . "\r\n"
                . "Content-Type: application/octet-stream; name=\"" . $filename . "\"\r\n"
                . "Content-Transfer-Encoding: base64\r\n"
                . "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n"
                . $content . "\r\n\r\n"
                . "--" . $uid . "--";
        $result = mail($to, $subject, "", $header);
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        
        
        return $result;
    }

    /**
     * send usual mail to any one
     * @param string $to mail addr
     * @param string $subject
     * @param string $message
     * @param string $from_name snder name
     * @param string $from_mail sender mail addr
     * @param string $reply reply mail
     * @return bool
     */
    public static function SendMail($to, $subject, $message, $from_name = "Toos FrameWork", $from_mail = null, $reply = null) {
        
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $to, $subject, $from_name, $from_mail, $reply);
        
        
        if ($reply == null){
            $reply = $from_mail;
        }
        
        $subject = "=?utf-8?b?" . base64_encode($subject) . "?=";
        $headers = "MIME-Version: 1.0\r\n";
        $headers.= "From: =?utf-8?b?" . base64_encode($from_name) . "?= <" . $from_mail . ">\r\n";
        $headers.= "Content-Type: text/plain;charset=utf-8\r\n";
        $headers.= "Reply-To: $reply\r\n";
        $headers.= "X-Mailer: PHP/" . phpversion();
        $result = mail($to, $subject, $message, $headers);
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        
        return $result;
    }

}
