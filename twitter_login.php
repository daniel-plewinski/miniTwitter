<?php

session_start();
ob_start();

if(isset($_SESSION["userID"])){
    header("location: twitter_wall.php");
    die();
}

require 'config.php';
require 'src/User.php';

include 'template/header.php';

?>

<div class="container">
    
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <form action="" method="post" role="form">
                <legend>Logowanie użytkownika</legend>
                <div class="form-group">
                    <label for="">E-mail użytkownika</label>
                    <input type="email" class="form-control" name="userEmail" id="userEmail" placeholder="Nazwa użytkownika">
                </div>
                <div class="form-group">
                    <label for="">Hasło użytkownika</label>
                    <input type="password" class="form-control" name="userPassword" id="userPassword"
                           placeholder="Hasło użytkownika">
                </div>
                <button type="submit" class="btn btn-primary">Wejdź</button>
                 <input type="button" class="btn btn-info" value="Rejestracja" onclick="location.href = 'twitter_register.php';">
            </form>
            <br>
            
 <?php
    
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (password_verify($_POST['userPassword'], User::getPasswordHashByEmail($conn, $_POST['userEmail']))) {
        echo "Pasuje";        
        $_SESSION["userEmail"] = $_POST['userEmail'];
        $_SESSION['userPassword'] = $_POST['userPassword'];
        $_SESSION["userID"] = USER::getIdByUserEmail($conn, $_SESSION["userEmail"]);
        $_SESSION["userName"] = USER::getUsernameByID($conn, $_SESSION["userID"]);
        header("location: twitter_wall.php");
        die();

    } else {

            echo '<div class="alert alert-danger">Podałeś niewłaściwe dane logowania!</div>';
    }
}         
?> 
        </div>
    </div>
</body>
</html>

  
