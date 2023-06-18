<?php
require_once("includes/config.php");
require_once("includes/classes/PreviewProvider.php");
require_once("includes/classes/CategoryContainers.php");
require_once("includes/classes/Entity.php");
require_once("includes/classes/ErrorMessage.php");
require_once("includes/classes/EntityProvider.php");
require_once("includes/classes/SeasonProvider.php");
require_once("includes/classes/Season.php");
require_once("includes/classes/Video.php");
require_once("includes/classes/videoProvider.php");




if(!isset($_SESSION["userLoggedIn"])){
     header("Location: register.php");
}
$userLoggedIn  = $_SESSION["userLoggedIn"];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WatchIt</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/db51009301.js" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>
 <div class="wrapper">


<?php
if(!isset($hideNav)){

    include_once("includes/navBar.php");

}

?>
