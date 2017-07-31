<?php

session_start();

if(isset($_SESSION["userID"])){
    header("location: twitter_wall.php");
    die();
}

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
    <title>Twitter - Utworzenie użytkownika</title>
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    
     <br>
    
           <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <a href="twitter_profile.php"><button type="button" class="btn btn-default"><div class="glyphicon glyphicon-asterisk"></div> Profil</button></a>
                </div>
              
            </div>
        </div>
    <br>
    
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <form action="  " method="post" role="form">
                <legend>Utworzenie użytkownika</legend>
               
                <div class="form-group">
                    <label for="">Email użytkownika</label>
                    <input type="text" class="form-control" name="userEmail" id="userEmail"
                           placeholder="Email użytkownika">
                </div>
                
                 <div class="form-group">
                    <label for="">Nazwa użytkownika</label>
                    <input type="text" class="form-control" name="userName" id="userName" placeholder="Nazwa użytkownika">
                </div>
                
                <div class="form-group">
                    <label for="">Hasło użytkownika</label>
                    <input type="password" class="form-control" name="userPassword" id="userPassword"
                           placeholder="Hasło użytkownika">
                </div>
                <button type="submit" class="btn btn-primary">Stwórz</button>
            </form>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            
            <?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
   $user = new User();
    
   
   $user->setEmail($_POST['userEmail']);
   $user->setUsername($_POST['userName']);
   $user->setPassword($_POST['userPassword']);
   
   
   if ($user->saveToDB($conn)) {
   
   $_SESSION["userEmail"] = $_POST['userEmail'];
   $_SESSION['userName'] = $_POST['userName'];
   $_SESSION['userPassword'] = $_POST['userPassword'];
   
    $_SESSION["userID"] = USER::getIdByUserEmail($conn, $_POST['userEmail']);
    echo "Nowy użytkownik został zarejestrowany<br>Przejdź do strony ze swoim profilem";
    
   } else {
       echo "Nazwa użytkownika lub email już istnieją";
   }

} 
        
?>   

        </div>
    </div>
</div>

</body>
</html>



