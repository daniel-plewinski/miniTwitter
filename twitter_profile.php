<?php
session_start();
ob_start();


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
    <title>Twitter - Login</title>
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    



     <br>
  <div class="btn-group btn-group-justified" role="group" aria-label="...">
    <div class="btn-group" role="group">
      <a href="twitter_useredit.php"><button type="button" class="btn btn-default"><div class="glyphicon glyphicon-pencil"></div> Edit</button></a>
    </div>
    <div class="btn-group" role="group">
      <a href="twitter_sendmessage.php"><button type="button" class="btn btn-default"><div class="glyphicon glyphicon-send"></div> Send message</button></a>
    </div>
    <div class="btn-group" role="group">
      <a href="twitter_createpost.php"><button type="button" class="btn btn-default"><div class="glyphicon glyphicon-paperclip"></div> Create post</button></a>
    </div>
    <div class="btn-group" role="group">
      <a href="twitter_logout.php"><button type="button" class="btn btn-default"><div class="glyphicon glyphicon-log-out"></div> Logout</button></a>
    </div>
  </div>
    <br><br>
    
<?php


$sql = "SELECT * FROM Posts WHERE user_id = :user_id";
try {
  $stmt = $conn->prepare($sql);
  $stmt->execute(['user_id' => $_SESSION["userID"]]);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo $e->getMessage();
}

if ($stmt->rowCount() > 0) {
  echo '<div class="panel panel-default">';
  echo '<div class="panel-heading">Panel heading</div>';
  echo '<table class="table">';
  echo '<tr><th>id</th><th>Posty</th><th>Data</th></tr>';
  foreach($result as $row) {
    echo '<tr><td>' . $row["id"] . '</td><td>' . $row["description"] . '</td><td>' . $row["data"] . "</td></tr>";
  }
  echo '</table>';
  echo '</div>';
}
 else {
   echo "Brak wyników";
 }

?>
</div>
</body>
</html>

<?php
    
   


