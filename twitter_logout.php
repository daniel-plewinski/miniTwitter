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

if(isset($_SESSION['userID'])){
    session_destroy();
    header("location: index.php");
} else {
    header("location: index.php");
}
