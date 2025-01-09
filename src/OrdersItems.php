<?php
class OrderItems {
    private $order_id;
    private $client_name;
    private $client_image;
    private $order_status;
    private $order_total_price;
    private $order_date;
    private $product_name;
    private $product_image;
    private $product_quantity;
    private $product_price;

    
    public function __construct($order_id, $client_name, $client_image, $order_status, $order_total_price, $order_date, $product_name,
    $product_image , $product_quantity, $product_price) {
        $this->order_id = $order_id;
        $this->client_name = $client_name;
        $this->client_image = $client_image;
        $this->order_status = $order_status;
        $this->order_total_price = $order_total_price;
        $this->order_date = $order_date;   
        $this->product_name = $product_name;
        $this->product_image = $product_image;
        $this->product_quantity = $product_quantity;
        $this->product_price = $product_price;
    }

    public function getOrderInfoHtml() {
        return "
            <div class='order-info'>
                <h2>Order Details</h2>
                <p><strong>Order ID:</strong> {$this->order_id}</p>
                <p><strong>Order Status:</strong> {$this->order_status}</p>
                <p><strong>Total Price:</strong> \${$this->order_total_price}</p>
                <p><strong>Order Date:</strong> {$this->order_date}</p>
                <img src='../{$this->client_image}' alt='Client Image'>
                <p><strong>Client Name:</strong> {$this->client_name}</p>
            </div>
        ";
    }

    public function getProductCardsHtml() {
        return  "
                <div class='product-card'>
                    <img src='{$this->product_image}'class='product-image'>
                    <h4>Product Name: {$this->product_name}</h4>
                    <p><strong>Quantity:</strong> {$this->product_quantity}</p>
                    <p><strong>Price:</strong> \${$this->product_price} each</p>
                </div>
            ";
        
       
    }
}
?>
