<?php
require_once("includes/header.php");

if(!isset($_GET["id"])){
    ErrorMessage::show("Aucun ID n'a été transmis");
}


$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createCategoriesPreviewVideo($_GET["id"]);

$containers = new CategoryContainers($con, $userLoggedIn);
echo $containers->showCategory($_GET["id"]);
?>