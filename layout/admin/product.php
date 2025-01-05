<?php
require_once __DIR__ . '/../../controllers/ProductController.php';
include"nav.php";

?>
<style>
    .form-container {
        position: absolute;
        margin: 0px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        top: 105px;
        left: 660px;
        width: 800px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: none;
            grid-column: span 2;
        }

        .btnsub {
            grid-column: span 2;
            padding: 10px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btnsub:hover {
            background-color: #0056b3;
        }
    .cards-contuner{
        display: grid;
        grid-template-columns: auto auto auto auto;

    }    
    .product-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 280px;
        margin: 16px;
        display: inline-block;
        vertical-align: top;
        background-color: #fff;
        transition: transform 0.2s ease-in-out;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-image img {
        width: 279px;
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid #ddd;
    }

    .product-details {
        padding: 16px;
        text-align: left;
    }

    .product-name {
        font-size: 1.5rem;
        font-weight: bold;
        margin: 0 0 8px 0;
        color: #333;
    }

    .product-description {
        font-size: 0.9rem;
        color: #666;
        margin: 0 0 12px 0;
    }

    .product-price {
        font-size: 1.2rem;
        font-weight: bold;
        color: #007bff;
        margin: 0 0 8px 0;
    }

    .product-quantity,
    .product-category {
        font-size: 0.9rem;
        color: #666;
        margin: 0 0 4px 0;
    }

    .product-actions {
        margin-top: 12px;
        display: flex;
        justify-content: space-between;
    }

    .edit-btn,
    .delete-btn {
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 0.9rem;
        color: #fff;
    }

    .edit-btn {
        background-color: #28a745;
    }

    .delete-btn {
        background-color: #dc3545;
    }

    .edit-btn:hover {
        background-color: #218838;
    }

    .delete-btn:hover {
        background-color: #c82333;
    }

</style>

<div class="main-content">
<div class="main-content-nav" >
    <h2 class="succes">
    <?php 
        if (isset($_SESSION["succesMessage"])) {  
        echo $_SESSION["succesMessage"];
        unset($_SESSION["succesMessage"]);
        }            
    ?> 
</h2>
<button popovertarget="my-formproduct" id="addFormProduct">
    add new product
</button>
</div>
<div class="cards-contuner">
    <?php
        $class = new ProductController;
        echo $class->displayAll(); 
    ?> 
</div>
   

<div class="form-container" popover id="my-formproduct">
        <h2>Add New Product</h2>
        
        <?php 
        if(isset($_GET["Edite-id"])){
            $productm = new ProductController;
            $product = $productm->viewProduct($_GET["Edite-id"]);

            echo "<script> document.getElementById('addFormProduct').click();</script>";
        }
        ?>

        <form id="addProductForm" action="../../core/Router.php" method="POST">
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" id="productName" name="name" placeholder="Enter product name" required value="<?php if(isset($_GET["Edite-id"])){ echo $product->getName();}  ?>">
            </div>
            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" id="price" name="price" step="0.01" min="0" placeholder="Enter price" required value="<?php if(isset($_GET["Edite-id"])){ echo $product->getPrice();}  ?>">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" min="1" placeholder="Enter quantity" required value="<?php if(isset($_GET["Edite-id"])){ echo $product->getQuantity();}  ?>">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="" <?php if(!isset($_GET["Edite-id"])){ echo "selected";}?> disabled > Select category </option>
                    <option value="Electronics" <?php if(isset($_GET["Edite-id"])){  if($product->getCategory()=="Electronics"){ echo "selected";}}?> >Electronics</option>
                    <option value="Fashion" <?php if(isset($_GET["Edite-id"])){  if($product->getCategory()=="Fashion"){ echo "selected";}}?>>Fashion</option>
                    <option value="Home" <?php if(isset($_GET["Edite-id"])){  if($product->getCategory()=="Home"){ echo "selected";}}?>>Home</option>
                    <option value="Beauty" <?php if(isset($_GET["Edite-id"])){  if($product->getCategory()=="Beauty"){ echo "selected";}}?>>Beauty</option>
                    <option value="Sports" <?php if(isset($_GET["Edite-id"])){  if($product->getCategory()=="Sports"){ echo "selected";}}?>>Sports</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Product Image URL</label>
                <input type="text" id="image" name="image" placeholder="Enter image URL" value="<?php if(isset($_GET["Edite-id"])){ echo $product->getImage();}  ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" placeholder="Write a short description" ><?php if(isset($_GET["Edite-id"])){ echo $product->getDescription();}  ?></textarea>
            </div>
            <?php
            if(isset($_GET["Edite-id"])){
               echo "<input type='hidden' name='Edite-id' value='".$product->getId()."' />";
               echo'<input type="hidden" name="url" value="Edit">';

            }else{
                echo'<input type="hidden" name="url" value="addproduct">';
            }
            ?>
            <button type="submit" class="btnsub" name="adp">Add Product</button>
        </form>
    </div>
  </div>
  </div>

<?php include"footer.php"?>
