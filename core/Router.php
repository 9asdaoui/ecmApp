<?php
require_once "../controllers/AuthController.php";
include "../vendor/autoload.php";

// use Ecm\App\Client;
// new Client();


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
