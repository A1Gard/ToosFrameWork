<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   THash
 * @todo : THash creator in cm 
 * @author jessy -> http://jream.com/ | modifed by Toos FrameWork
 */


class THash {
    
    /**
     *
     * @param string $algo The algorithm (md5, sha1, whirlpool, etc)
     * @param string $data The data to encode
     * @return string The hashed/salted data
     */
    public static function Create($algo, $data) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $algo, $data);
        $context = hash_init($algo, HASH_HMAC, HASH_KEY);
        hash_update($context, $data);
        $result = hash_final($context);
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        return $result;
        
    }
    
}
?>
