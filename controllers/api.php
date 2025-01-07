<?php
require_once __DIR__ . '/../src/Database.php';
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

try {
    $conn = Database::getConnection();
    $data = [];

    if (isset($_GET["itemsIds"]) && !empty($_GET["itemsIds"])) {
        $itemIds = explode(',', $_GET["itemsIds"]);
        $conditions = [];
        $bindings = [];
        
        foreach ($itemIds as $index => $id) {
            $paramName = "id" . ($index + 1);
            $conditions[] = "id = :$paramName";
            $bindings[$paramName] = $id;
        }

        $sql = "SELECT * FROM products WHERE " . implode(' OR ', $conditions);
        $stmt = $conn->prepare($sql);

        foreach ($bindings as $param => $value) {
            $stmt->bindValue(":$param", $value);
        }
    } else {
        $sql = "SELECT * FROM products";
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    $products = $stmt->fetchAll();

        foreach ($products as $product) {
            $data[] = [$product['id'],$product['name'],$product['description'],
            $product['price'],$product['quantity'],$product['category'],$product['image']];
        }
    

    echo json_encode($data);

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
    http_response_code(500);
    exit;
}
