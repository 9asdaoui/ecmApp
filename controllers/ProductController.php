<?php
// use Ecm\App\ProductManager;
// use Ecm\App\Product;
require_once __DIR__ . '/../src/ProductManager.php';
require_once __DIR__ . '/../src/Product.php';



class ProductController{

    public function addproduct($name,$description,$price,$quantity,$category,$image)
    {
        $newProduct = new Product(null,$name,$description,$price,$quantity,$category,$image);
        $meesage = ProductManager::insert($newProduct);
        session_start();
        $_SESSION["succesMessage"] = $meesage;
        header("location:../layout/admin/product.php");
        
    }
    
    public function displayAll()
    {
        $products = ProductManager::displayAll();
        
        $tableRows = "";

        foreach ($products as $product) {
            $tableRows .= $product->rendreRow();
        }
        return $tableRows;
    }

    public function deleteProduct($productId)
    {
        ProductManager::delete($productId);
        session_start();
        $meesage = "Product with ID $productId deleted successfully.";
        $_SESSION["succesMessage"] = $meesage;
        header("location:../layout/admin/product.php");
    }

    public function updateProduct($productId,$name,$description,$price,$quantity,$category,$image)
    {
        $productobj = new Product($productId,$name,$description,$price,$quantity,$category,$image);
        ProductManager::update($productobj);
        session_start();
        $meesage = "Product updated successfully.";
        $_SESSION["succesMessage"] = $meesage;
        header("location:../layout/admin/product.php");
    }

    public function viewProduct($productId)
    {
        return $product = ProductManager::getProduct($productId);
    }
}

