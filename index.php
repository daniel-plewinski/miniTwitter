<?php

include 'template/header.php';

if(isset($_SESSION['userID'])){
    header("location: twitter_profile.php");
}

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
                    <a href="twitter_register.php"><button type="button" class="btn btn-default"><div class="glyphicon glyphicon-asterisk"></div> Rejestracja</button></a>
                </div>
                <div class="btn-group" role="group">
                    <a href="twitter_login.php"><button type="button" class="btn btn-default"><div class="glyphicon glyphicon-user"></div> Logowanie</button></a>
                </div>
            </div>
        </div>

    </body>
    <?php include 'template/footer.php'; ?>
    
</html>
