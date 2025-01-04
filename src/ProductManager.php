<?php
namespace Ecm\App;

use Ecm\App\Database;
use Ecm\App\Product;

class ProductManager
{

    public static function insert(Product $product)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare(
            "INSERT INTO products (name, description, price, quantity, category, image) 
            VALUES (:name, :description, :price, :quantity, :category, :image)"
        );
        $stmt->execute([
            ':name' => $product->getName(),
            ':description' => $product->getDescription(),
            ':price' => $product->getPrice(),
            ':quantity' => $product->getQuantity(),
            ':category' => $product->getCategory(),
            ':image' => $product->getImage()
        ]);

    }

    public static function displayAll()
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $products = $stmt->fetchAll();
        $data = [];
        foreach ($products as $product) {
            $data[] = new Product(
                $product['id'], 
                $product['name'], 
                $product['description'], 
                $product['price'], 
                $product['quantity'], 
                $product['category'], 
                $product['image']
            );
        }
        return $data;
    }

    public static function delete($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }

    public static function getProduct($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $product = $stmt->fetch();
        return new Product(
            $product['id'], 
            $product['name'], 
            $product['description'], 
            $product['price'], 
            $product['quantity'], 
            $product['category'], 
            $product['image']
        );
    }

    public static function update(Product $product)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare(
            "UPDATE products SET 
                name = :name, 
                description = :description, 
                price = :price, 
                quantity = :quantity, 
                category = :category, 
                image = :image 
            WHERE id = :id"
        );
        $stmt->execute([
            ':name' => $product->getName(),
            ':description' => $product->getDescription(),
            ':price' => $product->getPrice(),
            ':quantity' => $product->getQuantity(),
            ':category' => $product->getCategory(),
            ':image' => $product->getImage(),
            ':id' => $product->getId()
        ]);
    }
}