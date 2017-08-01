<?php

/**
* File of miniTwitter
*
* @author     	Daniel Plewinski
* @author  		email: dplewinski@gmail.com
* @link     	https://github.com/daniel-plewinski/miniTwitter
*/


session_start();
ob_start();

if(!isset($_SESSION["userID"])){
    header("location: twitter_login.php");
    die();
}

require ''; 'config.php';
require 'src/User.php';
require 'src/Comment.php';
require 'src/Tweet.php';
require 'src/Message.php';

include 'template/header.php';

?>

<div class="container">

<?php    

    
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

   $messageId = $_GET['message_id'];
    
   $messageAr = Message::showMessageById($conn, $messageId);
   
   $fromUserName = User::getUsernameByID($conn, $messageAr[0]['from_id']);
   
   
    if ($messageAr[0]['to_id'] != $_SESSION['userID']) {

        echo "Nie masz uprawnień żeby czytać tę wiadomość";

    } else {

        echo "<i>Wiadomość od <strong>$fromUserName</strong> wysłana w dniu " . $messageAr[0]['message_date'] . "</i><br>";
        echo "<h4>" . $messageAr[0]['content'] . "</h4>"; 

        echo "Status: ";

        if ($messageAr[0]['is_read'] == 0) {
                echo "Nieprzeczytana";
                Message::markAsRead($conn, $messageId);  
         
             } else {
                 echo "Przeczytana";
             }
    }
 }         
?>

    </div>
</body>
</html>