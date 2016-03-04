<?php
ob_start();

global $database_handle;
define('__MP__', FALSE);
// include all required libs
include_once '../tconstant.php';
include_once '../tconfig.php';
include_once '../libs/TDatabasePDO.php';
include_once '../libs/THash.php';
include_once '../libs/TFunction.php';
include_once '../libs/TRegistry.php';

function _hk() {
    
}

// try to connect with posted value that sure before write on config.
try {
    $database_handle = new TDatabase(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    $reg = new TRegistry();
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
    die('<br /> We can connect to Database please check your input');
}

// else install system
$sqls = glob('./sql/*.sql');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Toos system install - Finalize</title>
        <link type="text/css" rel="stylesheet" href="assets/css/install.css" />
        <link type="text/css" rel="stylesheet" href="../tcm/assets/css/element.css" />
        <script type="text/javascript" src="../tcm/assets/js/jquery.min.js"></script>
    </head>
    <body>
        <div id="main">
            <h1>
                Finalize
            </h1>
            <div style="padding:1em;">
                <div class="notification-bar">
                    <?php foreach ($sqls as $sql_file): ?>
                        <div class="notification info">
                            Try to execute : <b> <?php echo basename($sql_file) ?></b>
                        </div>
                        <div class="notification success">
                            <?php
                            $sql = file_get_contents($sql_file);
                            $sql = str_replace('%dbname%', DB_NAME, $sql);
                            $sql = str_replace('%prefix%', DB_PREFIX, $sql);

                            $sql_queries = explode(';', $sql);

                            foreach ($sql_queries as $query) {
                                $database_handle->query($query . ';');
                            }
                            ?>
                            Executed : <b> <?php echo basename($sql_file) ?></b>
                        </div>
                    <?php endforeach; ?>
                    <div class="notification success">
                        <?php
                        $reg->SetValue(ROOT_SYSTEM, 'title', ($_POST['title']));
                        $reg->SetValue(ROOT_SYSTEM, 'email', ($_POST['email']));

                        $query = "INSERT INTO `" . DB_PREFIX . "manager` ( 
                            `manager_username`, `manager_email`, `manager_password`,
                            `manager_displayname`, `manager_lastlogin`, `manager_type`,
                            `manager_protected`) VALUES
                            ( :username , :email,  :password, :name, :time, 1, b'1');";
                        
                        $stm = $database_handle->prepare($query);
                        
                        $stm->execute( array(':username' => $_POST['manager_username'],
                                ':name' => $_POST['manager_username'],
                                ':password' => Password($_POST['manager_password']),
                                ':time' => time(),
                                ':email' => $_POST['email']
                                ));
                        
                        ?>
                        Update  : <b> Syetem info</b>
                    </div>
                    <div class="notification success">
                        Syetem install successfully.
                        <br />
                        <b style="color: red">
                            Please remove install directory.
                        </b>
                    </div>

                </div>
                <br />


                <button class="button"onclick="window.location.href = '../tcm'">
                    &nbsp;&nbsp;
                    Next
                    &nbsp;&nbsp;
                </button>
            </div>
        </div>
        <script type="text/javascript" src="assets/js/install.js"></script>
    </body>
</html>
