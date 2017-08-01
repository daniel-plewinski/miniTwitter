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

require 'config.php';
require 'src/User.php';

include 'template/header.php';

?>

<div class="container">
    
<?php

echo '<h4>Witaj <strong>' . $_SESSION["userName"] . '</strong>!</h4>';

$sql = "SELECT * FROM Tweets";

try {
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo $e->getMessage();
}

if ($stmt->rowCount() > 0) {
  echo '<div class="panel panel-default">';
  echo '<div class="panel-heading">Tablica</div>';
  echo '<table class="table">';
  echo '<tr><th>Użytkownik</th><th>Tweet</th><th>Komentarze</th><th>Data</th></tr>';
  foreach($result as $row) {
     
        try {
          $sql1 = "SELECT username FROM Users WHERE id =" .  $row['user_id'] . " LIMIT 1";
          $result1 = $conn->query($sql1);
          $result1 = $result1->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($result1 as $value) {
                 $username1 = $value['username'];
              }
                 
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
      
        echo '<tr><td><a href="twitter_sendmessage.php?id=' . $row['user_id'] . '">' . $username1 . '</a></td><td>' . $row["content"] . '</td><td><a href=twitter_comments.php?twit='. $row["id"] . '><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></a></td><td>' . $row["creation_date"] . "</td></tr>";
  }
  
  echo '</table>';
  echo '</div>';
  
}
 else {
   echo "Brak wyników";
 }

 if (isset($_SESSION['selfError']) && $_SESSION['selfError']) {
     
    echo "Nie można wysłać wiadomości do siebie";
    $_SESSION['selfError'] = false;
     
 }
 
?>
    <p>Kliknij na nazwę użytkownika aby wysłać do niego wiadomość</p>
</div>
</body>
</html>

<?php
    
   


