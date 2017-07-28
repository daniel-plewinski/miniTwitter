<?php
session_start();

if(isset($_SESSION['userID'])){
    session_destroy();
    header("location: twitter.php");
}
