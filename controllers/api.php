<?php
require_once __DIR__ . '/../src/Database.php';
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

try {
    $conn = Database::getConnection();
    $data = [];

    if (isset($_POST["userId"])) {

        $userId = $_POST["userId"];
        $total_price = $_POST["price"];
        
        try {
            $conn->beginTransaction();
            
            $orderQuery = "INSERT INTO orders (user_id, total_price) VALUES (:userId, :total_price)";
            $stmtOrder = $conn->prepare($orderQuery);
            $stmtOrder->execute([
                ':userId' => $userId,
                ':total_price' => $total_price
            ]);
            
            $orderId = $conn->lastInsertId();
            
            $itemQuery = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:orderId, :productId, :quantity, :price)";
            $stmtItem = $conn->prepare($itemQuery);
            
            $priceQuery = "SELECT price FROM products WHERE id = :productId";
            $stmtPrice = $conn->prepare($priceQuery);
            
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'product_id_') === 0) {
                    $num = str_replace('product_id_', '', $key);
                    $productId = $value;
                    
                    $quantityKey = "quantity_$num";
                    $quantity = $_POST[$quantityKey] ?? 1;
                    
                    $stmtPrice->execute([':productId' => $productId]);
                    $product = $stmtPrice->fetch(PDO::FETCH_ASSOC);
                    
                    if (!$product) {
                        throw new Exception("Product not found: $productId");
                    }
                    
                    $price = $product['price'];
                    
                    $stmtItem->execute([
                        ':orderId' => $orderId,
                        ':productId' => $productId,
                        ':quantity' => $quantity,
                        ':price' => $price
                    ]);
                }
            }
            
            $conn->commit();
            
            http_response_code(200);
            echo json_encode(['success' => true, 'orderId' => $orderId]);
            
        } catch (Exception $e) {
            $conn->rollBack();
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }

    }else if (isset($_GET["itemsIds"]) && !empty($_GET["itemsIds"])) {
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
        $stmt->execute();
    $products = $stmt->fetchAll();

        foreach ($products as $product) {
            $data[] = [$product['id'],$product['name'],$product['description'],
            $product['price'],$product['quantity'],$product['category'],$product['image']];
        }



    } else {






        $sql = "SELECT * FROM products";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    $products = $stmt->fetchAll();

        foreach ($products as $product) {
            $data[] = [$product['id'],$product['name'],$product['description'],
            $product['price'],$product['quantity'],$product['category'],$product['image']];
        }
    }

    
    

    echo json_encode($data);

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
    http_response_code(500);
    exit;
}



// if(isset($_POST["userId"])){
       
    

        

// }