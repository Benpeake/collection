<?php
session_start();

require_once 'vendor/autoload.php';
// $displayFormSucces = false;
$_SESSION['formSuccess'] = 'Record added to collection :)';
header('Location: index.php');




?>