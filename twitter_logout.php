<?php
session_start();
ob_start();

if(isset($_SESSION['userID'])){
    session_destroy();
    header("location: index.php");
} else {
    header("location: index.php");
}
