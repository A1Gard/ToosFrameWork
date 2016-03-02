<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Toos system install - Index </title>
        <link type="text/css" rel="stylesheet" href="assets/css/install.css" />
        <link type="text/css" rel="stylesheet" href="../tcm/assets/css/element.css" />
        <script type="text/javascript" src="../tcm/assets/js/jquery.min.js"></script>
    </head>
    <body>
        <div id="main">
            <h1>
                wellcome to install page
            </h1>
            <div class="notification-bar">
                
            </div>
            <form action="action" method="post" id="install-form" class="notification">
                <table>
                    <tr>
                        <td>Database Host:</td>
                        <td>
                            <input type="text" id="dbhost" name="dbhost" value="127.0.0.1" />
                        </td>
                    </tr>
                    <tr>
                        <td>Database User Name:</td>
                        <td>
                            <input type="text" id="dbuser" name="dbuser" value="root" />
                        </td>
                    </tr>
                    <tr>
                        <td>Database Password:</td>
                        <td>
                            <input type="text" id="dbpass" name="dbpass" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td>Database Name:</td>
                        <td>
                            <input type="text" id="dbname" name="dbname" value="toos" />
                        </td>
                    </tr>
                    <tr>
                        <td>Database Prefix:</td>
                        <td>
                            <input type="text" id="dbprt" name="dbpre" value="ts_" />
                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td>
                            <button id="dbchecker" type="button">Check Database connect</button>
                        </td>
                    </tr>

                </table>

            </form>
        </div>
        <script type="text/javascript" src="assets/js/install.js"></script>
    </body>
</html>
