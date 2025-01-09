<?php
require_once "Database.php";
require_once "Order.php";
require_once "OrdersItems.php";

class OrderManager
{



    public static function displayAll()
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("    SELECT 
                                    orders.id AS order_id,
                                    users.id AS client_id,                                    
                                    users.name AS client_name,
                                    orders.order_date AS order_date,
                                    orders.status AS order_status,
                                    SUM(orders.total_price) AS order_total_price
                                    FROM 
                                        users
                                    INNER JOIN 
                                        orders ON users.id = orders.user_id
                                    INNER JOIN 
                                        order_items ON orders.id = order_items.order_id
                                    GROUP BY 
                                        orders.id, users.name, orders.status, orders.order_date;");
        $stmt->execute();
        $Orders = $stmt->fetchAll();
        $data = [];
        foreach ($Orders as $Order) {
            $data[] = new Order($Order['order_id'],$Order['client_id'],$Order['client_name'],
                                $Order['order_status'],$Order['order_date'],$Order['order_total_price']);
        }
        return $data;
    }



    public static function displayorder($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT 
                                    orders.id AS order_id,
                                    users.name AS client_name,
                                    users.image AS client_image,
                                    orders.status AS order_status,
                                    orders.total_price AS order_total_price,
                                    orders.order_date AS order_date,
                                    products.name AS product_name,
                                    products.image AS product_image,
                                    order_items.quantity AS product_quantity,
                                    order_items.price AS product_price
                                FROM 
                                    users
                                INNER JOIN 
                                    orders ON users.id = orders.user_id
                                INNER JOIN 
                                    order_items ON orders.id = order_items.order_id
                                INNER JOIN 
                                    products ON order_items.product_id = products.id
                                WHERE orders.id = :id");
        $stmt->execute([':id' => $id]); 
        $Orders = $stmt->fetchAll();
        
        $data = [];
        foreach ($Orders as $Order) {
            $data[] = new OrderItems(
                $Order['order_id'],
                $Order['client_name'],
                $Order['client_image'],
                $Order['order_status'],
                $Order['order_date'],
                $Order['order_total_price'],
                $Order['product_name'],
                $Order['product_image'],
                $Order['product_quantity'],
                $Order['product_price']
            );
        }
    
        return $data;
    }
    



    public function placeOrder($userId,$total_price)
    {
        $conn = Database::getConnection();

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
            return 'succes';
            
        } catch (Exception $e) {
            $conn->rollBack();
            return 'not succes';
        }

    }
}