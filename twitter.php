<?php

if(isset($_SESSION['userID'])){
    header("location: twitter_profile.php");
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Twitter - Login</title>
        <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>

        <?php
        if (is_array($_POST) && $_POST) {
            include 'config.php';
            include 'src/User.php';
            $userName = $_POST['userName'];
            $userEmail = $_POST['userEmail'];
            $userPassword = $_POST['userPassword'];
            $user = new User();
            $user->setUsername($userName);
            $user->setEmail($userEmail);
            $user->setPassword($userPassword);
            if ($user->validate($conn)) {
                $user->saveToDB($conn);
            } else {
                echo "Podałeś złe dane!!!!";
            }
        }
        ?>

        <div class="container">
            <h1>Twitter</h1>
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <a href="twitter_register.php"><button type="button" class="btn btn-default"><div class="glyphicon glyphicon-asterisk"></div> Register</button></a>
                </div>
                <div class="btn-group" role="group">
                    <a href="twitter_login.php"><button type="button" class="btn btn-default"><div class="glyphicon glyphicon-user"></div> Login</button></a>
                </div>
            </div>
        </div>

    </body>
</html>
