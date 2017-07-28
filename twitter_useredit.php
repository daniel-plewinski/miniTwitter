<?php
session_start();
include 'config.php';
include 'src/User.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twitter - Save</title>
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

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
                    <label for="">Nazwa użytkownika</label>
                    <input type="text" class="form-control" name="userName" id="userName" placeholder="Nazwa użytkownika"
                           value="<?= $_SESSION["userName"] ?>">
                </div>
                <div class="form-group">
                    <label for="">Email użytkownika</label>
                    <input type="text" class="form-control" name="userEmail" id="userEmail"
                           placeholder="Opis użytkownika"
                           value="<?= $_SESSION["userEmail"]; ?>">
                </div>
                <div class="form-group">
                    <label for="">Hasło użytkownika</label>
                    <input type="password" class="form-control" name="userPassword" id="userPassword"
                           placeholder="Hasło użytkownika">
                </div>
                <button type="submit" class="btn btn-primary">Edytuj</button>
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
                     
                 
                 
            }
            ?>
            
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
    </div>
</div>

</body>
</html>
