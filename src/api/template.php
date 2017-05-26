<?php



$theme_dir = $reg->GetValue(ROOT_SYSTEM, 'theme');

$smarty = new Smarty();

$smarty->caching = 0;


$smarty->template_dir = "./$theme_dir/template/";
$smarty->compile_dir = "./$theme_dir/compile/";
$smarty->config_dir = "./$theme_dir/config/";
$smarty->cache_dir = "./$theme_dir/cash/";

function minify_html($tpl_output, &$smarty) {
    global $url;
    $tpl_output = preg_replace('![\t ]*[\r\n]+[\t ]*!', ' ', $tpl_output);
    $tpl_output = str_replace(array(';', '}'), array('; ' . PHP_EOL, '} ' . PHP_EOL), $tpl_output);
    return $tpl_output;
}

// register the outputfilter
$smarty->register_outputfilter('minify_html');


$templatez = array() ;


$smarty->assign('theme_url', UR_BASE . $theme_dir );


?>