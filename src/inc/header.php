<?php


// define db & golobal
$database_handle = null;
$hook_store = null;


// include config file to do 
require 'tconfig.php';
// include constant file 
require PA_CM . '/' . PA_CORE . 'Function.php';
require PA_CM . '/' . PA_CORE . 'Model.php';


/* @var $request string get apache request passed to index */
if (isset($_REQUEST['req']) && $_REQUEST['req'] != '') {

    $request = rtrim($_REQUEST['req'], '/');
    $url = explode('/', $request);
    
} else {
    
    // set deafult index
    $url = array(0 => 'index.php');
}


require './libs/Smarty.class.php';
require './libs/TDatabasePDO.php';


$pdbc = new Model('topic','topic_');
$model = new Model('topic','topic_');

require_once './libs/TMagicFunctions.php';

require_once './inc/fnc.php';

$smarty = new Smarty();

$smarty->caching = 0;


$smarty->template_dir = './soh3il/template/';
$smarty->compile_dir = './soh3il/compile/';
$smarty->config_dir = './soh3il/config/';
$smarty->cache_dir = './soh3il/cash/';

//$smarty->debugging = true;


$reg = TRegistry::GetInstance(); 

$title = $reg->GetValue(ROOT_SYSTEM,'title');
$footer = $reg->GetValue(ROOT_SYSTEM,'footer');
$links = $reg->GetValue(ROOT_SYSTEM,'links');

$smarty->assign('footer', $footer);
$smarty->assign('links', $links);
$cat = TCategory::GetInstance();
$smarty->assign('cat_list', $cat->CategoryUL());


$menu = new TDropDownMenu();

$tmp = $menu->DropDownUL();

$smarty->assign('menu',$tmp);

$smarty->assign('memberz',  GetCount('member'));
$smarty->assign('likez',  GetCount('relation',' typ = 4 '));
$smarty->assign('frnz',  GetCount('relation',' typ = 5 '));
$smarty->assign('topiczz',  GetCount('topic',' topic_status > 0 '));
$smarty->assign('stopic',  GetCount('topic',' topic_status = 2 '));
$smarty->assign('comment',  GetCount('comment'));
$smarty->assign('rtag', TagRandom());


