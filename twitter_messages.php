<?php
session_start();
ob_start();

if(!isset($_SESSION["userID"])){
    header("location: twitter_login.php");
    die();
}

require 'config.php';
require 'src/User.php';
require 'src/Comment.php';
require 'src/Tweet.php';
require 'src/Message.php';

include 'template/header.php';
?>


<div class="container">


<?php

$inboxAr = Message::showInbox($conn, $_SESSION['userID']);
$outboxAr = Message::showOutbox($conn, $_SESSION['userID']);

echo '<div class="panel panel-default">';
echo '<div class="panel-heading">Wiadomości otrzymane</div>';
echo '<table class="table">';
  
echo '<tr><th>Nadawca</th><th>Treść wiadomości</th><th>Data</th><th>Status</th></tr>';
  
foreach ($inboxAr as $inMessage) {
      
       try {
          $sql1 = "SELECT username FROM Users WHERE id =" .  $inMessage['from_id'] . " LIMIT 1";
          $result1 = $conn->query($sql1);
          $result1 = $result1->fetchAll(PDO::FETCH_ASSOC);
            
          foreach ($result1 as $value) {
               $username1 = $value['username'];
            }
                 
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
        
        echo '<tr><td>' . $username1 . '</td><td><a href="twitter_readmessage.php?message_id=' . $inMessage['id'] . '">' . substr($inMessage['content'],0,20 ) . '</a>';
        echo ' ...</td><td>' . $inMessage['message_date'] . '<td>'; 
            if ($inMessage['is_read'] == 0) {
               echo "Nieprzeczytana";

            } else {
                echo "Przeczytana";
            }
            echo '</td></tr>';
        
 } 
 
echo '</table>';
echo '</div>';
 
echo '<div class="panel panel-default">';
echo '<div class="panel-heading">Wiadomości wysłane</div>';
echo '<table class="table">';
  
echo '<tr><th>Odbiorca</th><th>Treść wiadomości</th><th>Data</th><th>Status</th></tr>';
  
foreach ($outboxAr as $outMessage) {
      
       try {
          $sql1 = "SELECT username FROM Users WHERE id =" .  $outMessage['to_id'] . " LIMIT 1";
          $result1 = $conn->query($sql1);
          $result1 = $result1->fetchAll(PDO::FETCH_ASSOC);
            
          foreach ($result1 as $value) {
               $username1 = $value['username'];
            }
                 
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
        
         echo '<tr><td>' . $username1 . '</td><td><a href="twitter_readsentmessage.php?message_id=' . $outMessage['id'] . '">' . substr($outMessage['content'],0,20 ) . '</a>';
        echo ' ...</td><td>' . $outMessage['message_date'] . '<td>'; 
            if ($outMessage['is_read'] == 0) {
               echo "Nieprzeczytana";

            } else {
                echo "Przeczytana";
            }
            echo '</td></tr>';
}
 
echo '</table>';
echo '</div>';
?>
    </div>
</body>
</html>


     
