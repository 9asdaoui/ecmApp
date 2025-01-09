<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/OrderManager.php';
require_once __DIR__ . '/../Controllers/apiController.php';

header("Access-Control-Allow-Origin: *"); //CORS policy localhost 
header('Content-Type: application/json');

try {

    $api = new apiManagerClass;
    
        if (isset($_GET["user_id"])) {

            $id = $_GET["user_id"];
            $data = $api->getOrders($id);
            
        }else if (isset($_POST["userId"])) {

            $userId = $_POST["userId"];
            $total_price = $_POST["price"];
            $order = new OrderManager;
            $orderData = $order->placeOrder($userId,$total_price);
            $data = json_encode($orderData);

        }else if (isset($_GET["itemsIds"])) {

            $itemIds = explode(',', $_GET["itemsIds"]);
            $data = $api->getItems($itemIds);

        } else {
            $data = $api->fetch_data();
        }
        echo $data;
} catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
        exit;
}