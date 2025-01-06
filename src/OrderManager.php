<?php
// namespace Ecm\App;
// use Ecm\App\Database;
// use Ecm\App\Order;
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
    
    


    public function placeOrder()
    {
        // Logic to place an order
    }

    public function deleteOrder($orderId)
    {
        // Logic to delete an order
    }
}