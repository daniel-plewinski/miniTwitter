<?php

include 'template/header.php';

if(isset($_SESSION['userID'])){
    header("location: twitter_profile.php");
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
</html>
