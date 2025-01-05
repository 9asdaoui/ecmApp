<?php
require_once "../controllers/AuthController.php";
require_once "../controllers/ProductController.php";
include "../vendor/autoload.php";

$url = $_REQUEST['url'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

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
    ],
     'Delet' => [
        'controller' => ProductController::class,
        'method' => 'deleteProduct',
        'params' => ['id'],
    ]
];


if (isset($routes[$url])) {
    $route = $routes[$url];
    $class = $route['controller'];
    $method = $route['method'];
    $expectedParams = $route['params'];

    $object = new $class();

    if (method_exists($object, $method)) {
        $inputs = [];
    
        foreach ($expectedParams as $param) {
            if ($requestMethod === 'POST') {
                $inputs[] = $_POST[$param];
            } elseif ($requestMethod === 'GET') {
                $inputs[] = $_GET[$param];
            }
        }

        call_user_func_array([$object, $method], $inputs);
        echo "still here";
    } else {
        echo "Method $method does not exist in $class.";
    }
} else {
    echo "Route not found or no URL specified.";
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adp'])) {
//     echo $name = $_POST['name'] . "<br>";
//     echo $description = $_POST['description']. "<br>";
//     echo $price = $_POST['price']. "<br>";
//     echo $addproduct = $_POST['url']. "<br>";
// }