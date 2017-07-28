<?php
//pobierz listę id i tytułu filmów
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Zadanie 1 - modyfikacja danych</title>
        <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <form action="zadanie1.php" method="post" role="form">
                    <legend>Dodawnie postu</legend>

                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" rows="5" id="comment"></textarea>
                    </div>


                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </form>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

            </div>
        </div>
    </div>

</body>
</html>


<?php
//        include 'config.php';
//
//        $postID = $_GET["postID"];
//
//        $sql = "SELECT * FROM Comments WHERE post_id = :post_id ";
//        try {
//            $stmt = $conn->prepare($sql);
//            $stmt->execute(['post_id' => $postID]);
//            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//        }
//
//        if ($stmt->rowCount() > 0) {
//            echo '<div class="panel panel-default">';
//            echo '<div class="panel-heading">Panel heading</div>';
//            echo '<table class="table">';
//            echo '<tr><td>id</td><td>user name</td><td>description</td><td>data</td></tr>';
//            foreach ($result as $row) {
//                echo '<tr><td>' . $row["id"] . "</td><td>" . $row["user_id"] . "</td><td>" . $row["description"] . "</td><td>" . $row["data"] . "</td></tr>";
//            }
//            echo '</table>';
//            echo '</div>';
//        } else {
//            echo "Brak wyników";
//        }
////tutaj wygeneruj linki z przekazaniem id filmu za pomocą GET np:
////<a href="zadanie1_getmovie.php?id=34" target="_blank">tytuł filmu</a>
?>

</body>
</html>
