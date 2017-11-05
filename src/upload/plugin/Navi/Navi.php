<?php


class Navi {
    public static $version = '0.1';
    public static $author = 'ToosFW Team';
    public static $url = 'http://localhost';
    public static $discrption = 'no dcirption';
    
    
    public static function Active() {
        $p_model = new TModel('hook') ;
        
        
        $data['hook_effect'] = 'P:TNavigator:AddItem';
        $data['hook_function_name'] = 'LinkEditor';
        $data['hook_plugin'] = __CLASS__ ;
        $p_model->Create($data);
        
        $data['hook_effect'] = 'R:TNavigator:Render';
        $data['hook_function_name'] = 'RenderEditor';
        $data['hook_plugin'] = __CLASS__ ;
        $p_model->Create($data);
    }
    
    public static function Deactive() {
        
        $p_model = new TModel('hook') ;
        
        $p_model->db->CustomQuery("DELETE FROM ".DB_PREFIX."hook "
                . "WHERE hook_plugin = '".__CLASS__."' ;");
        
    }
    
    public static function Remove() {
        self::Deactive();
    }

}


function LinkEditor($class,&$text, &$link) {
    $link .= '#God';
    $text .= ' p ';
}

function RenderEditor($class,&$navi) {
    $navi .= ' by ';
}
