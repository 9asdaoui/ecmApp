<?php
// use Ecm\App\OrderManager;
// use Ecm\App\Order;
require_once __DIR__ . '/../src/OrderManager.php';
require_once __DIR__ . '/../src/Order.php';



class OrderController{

    public function displayAll()
    {
        $Orders = OrderManager::displayAll();
        
        $tableRows = "";

        foreach ($Orders as $Order) {
            $tableRows .= $Order->rendreRow();
        }
        return $tableRows;
    }
}