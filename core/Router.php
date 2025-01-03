<?php

include "../vendor/autoload.php";
use src\Client;


$url = $_POST["url"];

$routes = [
    'sing'=> [Client::class,"register"]
];

if (isset($routes[$url])){

  [$class, $method] = $routes[$url];
    $object = new $class();
    $object->$method();

}
















// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup-btn'])) {
//     $fullname = $_POST['fullname'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $confirmPassword = $_POST['confirm_password'];

//     $client = new Client();

//     $message = $client->register($fullname, $email, $password, $confirmPassword);

//     if ($message === "Registration successful.") {
//         header("Location: ./log_in.php");
//         exit();
//     } else {
//         echo $message;
//     }
// }
?>
