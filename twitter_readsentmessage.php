<?php

session_start();
ob_start();

if(!isset($_SESSION["userID"])){
    header("location: twitter_login.php");
    die();
}

include 'config.php';
include 'src/User.php';
include 'src/Comment.php';
include 'src/Tweet.php';
include 'src/Message.php';

include 'template/header.php';

?>

<div class="container">

<?php    

    
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

   $messageId = $_GET['message_id'];
    
   $messageAr = Message::showMessageById($conn, $messageId);
   
   $toUserName = User::getUsernameByID($conn, $messageAr[0]['to_id']);
   
   
    if ($messageAr[0]['from_id'] != $_SESSION['userID']) {

        echo "Nie masz uprawnień żeby czytać tę wiadomość";

    } else {

        echo "<i>Wiadomość do <strong>$toUserName</strong> wysłana w dniu " . $messageAr[0]['message_date'] . "</i><br>";
        echo "<h4>" . $messageAr[0]['content'] . "</h4>"; 

        echo "Status: ";

        if ($messageAr[0]['is_read'] == 0) {
                echo "Nieprzeczytana";
         
             } else {
                 echo "Przeczytana";
             }
    }
 }         
 
 ?>

    </div>
</body>
</html>



