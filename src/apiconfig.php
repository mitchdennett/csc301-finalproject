<?php

// Connecting to the MySQL database
$DB_USER = "dennettm1";
$DB_PASSWORD = "y5Sa#@So";

$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_fall18_dennettm1', $DB_USER, $DB_PASSWORD);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

// autoloader
function my_autoloader($class) {
    include('class.' . $class . '.php');
}

spl_autoload_register('my_autoloader');

//Secure Cookies
session_set_cookie_params(0, '/', '', False, True);

// Start the session
session_start();


if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = new ShoppingCart();
}

?>