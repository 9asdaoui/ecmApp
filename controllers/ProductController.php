<?php

use Ecm\App\User;
use Ecm\App\Admin;
use Ecm\App\ProductManager;
use Ecm\App\Product;

class ProductController{

    public function addproduct($name,$description,$price,$quantity,$category,$image)
    {
        $newProduct = new Product(null,$name,$description,$price,$quantity,$category,$image);
        ProductManager::insert($newProduct);
        header("location:../layout/admin/product.php");
    }
    public function manageProducts()
    {
        $products = ProductManager::displayAll();
        foreach ($products as $product) {
            echo $product->getName() . "<br>";
        }
    }

    public function deleteProduct($productId)
    {
        ProductManager::delete($productId);
        echo "Product with ID $productId deleted successfully.";
    }

    public function updateProduct(Product $product)
    {
        ProductManager::update($product);
        echo "Product updated successfully.";
    }

    public function viewProduct($productId)
    {
        $product = ProductManager::getProduct($productId);
        echo "Product Name: " . $product->getName();
    }
}