<?php
if (!file_exists( '../../tconfig.php')) {
    die('Config file not exists.');
}
include_once '../../tconfig.php';
include_once '../../libs/TDatabasePDO.php';
error_reporting(1);
try {
    $dbcon = new TDatabase(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
    die('<br /> We can connect to Database please check your input');
}
?>
<script type="text/javascript">
    location.href = 'systemSetting.php';
</script>