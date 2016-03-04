<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Toos system install - Website information </title>
        <link type="text/css" rel="stylesheet" href="assets/css/install.css" />
        <link type="text/css" rel="stylesheet" href="../tcm/assets/css/element.css" />
        <script type="text/javascript" src="../tcm/assets/js/jquery.min.js"></script>
    </head>
    <body>
        <div id="main">
            <h1>
                Website information
            </h1>
            <div class="notification-bar">
                
            </div>
            <form action="install.php" method="post" id="info-form" class="notification">
                <table>
                    <tr>
                        <td>Manager username:</td>
                        <td>
                            <input type="text" id="manager_username" name="manager_username" value="admin" />
                        </td>
                    </tr>
                    <tr>
                        <td>Manager Password:</td>
                        <td>
                            <input type="password" id="manager_password" name="manager_password" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td>Manager Password repeat:</td>
                        <td>
                            <input type="password" id="manager_password2"  value="" />
                        </td>
                    </tr>
                    <tr>
                        <td>Website & admin email:</td>
                        <td>
                            <input type="text" id="email" name="email" value="test@test.test" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Website title:</td>
                        <td>
                            <input type="text" id="title" name="title" value="Another website with toos framwork" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>

                        </td>
                        <td>
                            <button id="nfocheck" type="button"> Next </button>
                        </td>
                    </tr>

                </table>

            </form>
        </div>
        <script type="text/javascript" src="assets/js/install.js"></script>
    </body>
</html>
