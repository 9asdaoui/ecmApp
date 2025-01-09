<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/OrderManager.php';


class apiManagerClass{

    private   $data = [];
    private   $conn ;


    public function __construct()
    {
        $this->conn = Database::getConnection(); 
    }

    public function fetch_data()
    {
        $sql = "SELECT * FROM products";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();

        foreach ($products as $product) {
            $this->data[] = [$product['id'],$product['name'],$product['description'],
            $product['price'],$product['quantity'],$product['category'],$product['image']];
        }
        return json_encode($this->data);
    }

    public function getItems($itemIds)
    {
        $conditions = [];
        $bindings = [];
        
        foreach ($itemIds as $index => $id) {
            $paramName = "id" . ($index + 1);
            $conditions[] = "id = :$paramName";
            $bindings[$paramName] = $id;
        }

        $sql = "SELECT * FROM products WHERE " . implode(' OR ', $conditions);
        $stmt = $this->conn->prepare($sql);

        foreach ($bindings as $param => $value) {
            $stmt->bindValue(":$param", $value);
        }
        $stmt->execute();
        $products = $stmt->fetchAll();

        foreach ($products as $product) {
            $this->data[] = [$product['id'],$product['name'],$product['description'],
            $product['price'],$product['quantity'],$product['category'],$product['image']];
        }

        return json_encode($this->data);


    }
    
    public function getOrders($id)
    {
        $sqlOrders = "SELECT * FROM orders WHERE user_id = :id;";
        $stmtOrders = $this->conn->prepare($sqlOrders);
        $stmtOrders->execute([':id' => $id]);
        $orders = $stmtOrders->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($orders as $order) {
            $orderId = $order['id'];
            $sqlProducts = "
                SELECT 
                    products.name AS product_name,
                    products.image AS product_image,
                    order_items.quantity AS product_quantity,
                    order_items.price AS product_price
                FROM order_items
                JOIN products ON order_items.product_id = products.id
                WHERE order_items.order_id = :orderId;
            ";
            $stmtProducts = $this->conn->prepare($sqlProducts);
            $stmtProducts->execute([':orderId' => $orderId]);
            $products = $stmtProducts->fetchAll(PDO::FETCH_ASSOC);
    
            $this->data[] = [
                'order' => $order,
                'products' => $products
            ];
        }
        return json_encode($this->data);

    }
}

