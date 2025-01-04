<?php
require_once "../controllers/AuthController.php";
require_once "../controllers/ProductController.php";
include "../vendor/autoload.php";

// use Ecm\App\Client;
// new Client();
session_start();
    if(isset($_SESSION["error_message"])){
      echo $_SESSION["error_message"];
    }  


$url = $_POST['url'];

$routes = [
    'register' => [
        'controller' => AuthController::class,
        'method' => 'register',
        'params' => ['fullname', 'email','password', 'confirm_password'],
    ],
    'login' => [
        'controller' => AuthController::class,
        'method' => 'login',
        'params' => ['email', 'password'], 
    ], 
    'addproduct' => [
        'controller' => ProductController::class,
        'method' => 'addproduct',
        'params' => ['name', 'description','price', 'quantity','category','image'],
    ]
];


// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adp'])) {
//     echo $name = $_POST['name'] . "<br>";
//     echo $description = $_POST['description']. "<br>";
//     echo $price = $_POST['price']. "<br>";
//     echo $addproduct = $_POST['url']. "<br>";


// }
if (isset($routes[$url])) {
    $route = $routes[$url];
    $class = $route['controller'];
    $method = $route['method'];
    $expectedParams = $route['params'];

    $object = new $class();

    if (method_exists($object, $method)) {
        $inputs = [];
        foreach ($expectedParams as $param) {
            $inputs[] = $_POST[$param];
        }

        call_user_func_array([$object, $method], $inputs);
        echo "still here";
    } else {
        echo "Method $method does not exist in $class.";
    }
} else {
    echo "Route not found or no URL specified.";
}






?>
