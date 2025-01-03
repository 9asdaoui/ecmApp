<?php
namespace src;
// use src\Database;

class Order
{
    private $id;
    private $userId;
    private $productId;
    private $price;
    private $quantity;

    public function __construct($id, $userId, $productId, $price, $quantity)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->productId = $productId;
        $this->price = $price;
        $this->quantity = $quantity;
    }

}
?>