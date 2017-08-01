<?php
session_start();

/**
* File of miniTwitter
*
* @author     	Daniel Plewinski
* @author  		email: dplewinski@gmail.com
* @link     	https://github.com/daniel-plewinski/miniTwitter
*/

if(!isset($_SESSION["userID"])){
    header("location: twitter_login.php");
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
                <legend>Edycja użytkownika</legend>
                <div class="form-group">
                    <label for="">Id użytkownika (Nie da się zmienić)</label>
                    <input type="text" class="form-control" readonly name="userId" id="userId" placeholder="Id użytkownika"
                           value="<?= $_SESSION["userID"] ?>">
                </div>
                <div class="form-group">
                    <label for="">Nowa nazwa użytkownika</label>
                    <input type="text" class="form-control" name="userName" id="userName" placeholder="Nazwa użytkownika"
                           value="<?= $_SESSION["userName"] ?>">
                </div>
                <div class="form-group">
                    <label for="">Nowy e-mail</label>
                    <input type="text" class="form-control" name="userEmail" id="userEmail"
                           placeholder="Opis użytkownika"
                           value="<?= $_SESSION["userEmail"]; ?>">
                </div>
                <div class="form-group">
                    <label for="">Nowe hasło</label>
                    <input type="password" class="form-control" name="userPassword" id="userPassword"
                           placeholder="">
                </div>
                <button type="submit" class="btn btn-primary">Zmień swoje dane</button>
            </form>
<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    $newUserName = $_POST['userName'];
    $newUserEmail = $_POST['userEmail'];
    $newUserPassword = $_POST['userPassword'];

    if ($_SESSION["userName"] != $newUserName) {

       if (USER::checkUsernameIfUnique($conn, $_SESSION["userID"], $newUserName)) {
           USER::saveNewUsername($conn, $newUserName, $_SESSION["userID"]);
           echo "Nazwa użytkownika została zmieniona na " . $newUserName;
       } else {
           echo "Ta nazwa użytkownika już istnieje<br>";
       }
    }

     if ($_SESSION["userEmail"] != $newUserEmail) {

       if (USER::checkEMailIfUnique($conn, $_SESSION["userID"], $newUserEmail)) {
           USER::saveNewUserEmail($conn, $newUserEmail, $_SESSION["userID"]);
           echo "E-mail użytkownika została zmieniony na " . $newUserEmail;
       } else {
           echo "Ten e-mail jest już używany przez innego użytkownika";
       }
    }

    if ($_SESSION['userPassword'] != $newUserPassword && !empty($newUserPassword)) {
        USER::saveNewUserPassword($conn, $newUserPassword, $_SESSION["userID"]);
        echo "Hasło zostało zmienione";
    }
}

?>

            </div>
        </div>
    </div>
</body>
</html>
