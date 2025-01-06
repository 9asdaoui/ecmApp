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

    public function displayorderinfo($id)
    {
        $Orders = OrderManager::displayorder($id);

         $tableRows = $Orders[0]->getOrderInfoHtml();
      
    
        return $tableRows;
    }
    
    public function displayorderitemsinfo($id)
    {
        $Orders = OrderManager::displayorder($id);
        
        $tableRow = [];

        foreach ($Orders as $order) {
            $tableRow[] = $order->getProductCardsHtml();
        }
    
        return implode('', $tableRow);    
    }
    
}
