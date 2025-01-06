<?php
require_once __DIR__ . '/../../controllers/OrderController.php';
include"nav.php";
if(isset($_GET["order_id"])){
 $sm = new OrderController;
 $order = $sm->displayorderinfo($_GET["order_id"]);
 $products = $sm->displayorderitemsinfo($_GET["order_id"]);
}
?>

<style>

    .go-back {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .go-back:hover {
        background-color: #0056b3;
    }

    .order-info {
        margin-bottom: 30px;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .order-info h2 {
        margin-bottom: 10px;
        color: #333;
    }

    .order-info p {
        margin: 5px 0;
        color: #555;
    }
    .product-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Three columns, each taking equal space */
    gap: 20px; /* Space between the cards */
    margin-top: 20px;
    }

    .product-card {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
        overflow: hidden;
        box-sizing: border-box;
    }

    .product-card h4 {
        margin: 10px 0;
        color: #333;
    }

    .product-card p {
        margin: 5px 0;
        color: #555;
    }

    .product-image {
        width: 100%; /* Ensure the image takes the full width of the card */
        height: 200px; /* Fixed height for the image */
        object-fit: cover; /* Ensures the image doesn't stretch and maintains aspect ratio */
        border-radius: 8px;
        margin-bottom: 15px;
    }
    
</style>
<div class="main-content">


    <button class="go-back" onclick="history.back()">Go Back</button>

    <!-- Order Information -->
    <?=$order?>
    <!-- Product Cards -->
    <div class="product">
    <h3>Products</h3>
    <div class="product-cards">
        
    <?php
        echo $products ;
    ?>

    </div>
</div>

    </div>
  </div>
<?php include"footer.php"?>
