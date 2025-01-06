<?php
// namespace Ecm\App;
// use Ecm\App\Database;
// use Ecm\App\Order;
require_once "Database.php";
require_once "Order.php";

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



    public static function getOrder($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM Orders WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $Order = $stmt->fetch();
        return new Order(
            $Order['id'], 
            $Order['name'], 
            $Order['description'], 
            $Order['price'], 
            $Order['quantity'], 
            $Order['category'], 
            $Order['image']
        );
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