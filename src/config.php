<?php

$path = '/csc301/dennettm1/finalproject1/';


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

$current_url = basename($_SERVER['REQUEST_URI']);

// if customerID is not set in the session and current URL not login.php redirect to login page 
if (!isset($_SESSION["customerID"]) && $current_url != 'login.php' && $current_url != 'preview.php' && $current_url != 'register.php') {
    header("Location: login.php");
}

//Else if session key customerID is set get $customer from the database
elseif (isset($_SESSION["customerID"])) {
	$customer = new Customer($_SESSION["customerID"], $database);
}

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = new ShoppingCart();
}