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

$inboxAr = Message::showInbox($conn, $_SESSION['userID']);

$outboxAr = Message::showOutbox($conn, $_SESSION['userID']);

echo '<div class="panel panel-default">';
echo '<div class="panel-heading">Wiadomości otrzymane</div>';
echo '<table class="table">';
  
echo '<tr><th>Nadawca</th><th>Treść wiadomości</th><th>Data</th></tr>';
  
foreach($inboxAr as $inMessage) {
      
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
        
        echo '<tr><td>' . $username1 . '</td><td>' . $inMessage['content'] . '</td><td>' . $inMessage['message_date'] . '</tr>';
        
 } 
 
 echo '</table>';
 echo '</div>';
 
 
 // Outbox
 
echo '<div class="panel panel-default">';
echo '<div class="panel-heading">Wiadomości wysłane</div>';
echo '<table class="table">';
  
echo '<tr><th>Odbiorca</th><th>Treść wiadomości</th><th>Data</th></tr>';
  
foreach($outboxAr as $outMessage) {
      
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
        
        echo '<tr><td>' . $username1 . '</td><td>' . $outMessage['content'] . '</td><td>' . $outMessage['message_date'] . '</tr>';
        
 } 
 
 echo '</table>';
 echo '</div>';
 



     
