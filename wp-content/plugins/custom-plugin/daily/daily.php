<?php
global $wpdb;
require_once __DIR__ .'/../includes/function.php';

$myrows = $wpdb->get_results( "SELECT * FROM useragency" );


$module_path = 'admin.php?page=daily';
$module_pathadd = 'admin.php?page=adddaily';
$sub = trim($_GET['sub']);

$module_short_url = str_replace('admin.php?page=','', $module_path);

$mess = '';
$mdlconf = array('title'=>'Tài khoản');


if($sub==''){
    include_once __DIR__ .'/daily_list.php';

}else if($sub=='edit'){
    include_once __DIR__ .'/daily_edit.php';

}else if($sub=='add'){

    include_once __DIR__ .'/adddaily.php';

}

?>


