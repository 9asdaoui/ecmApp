<?php
namespace Ecm\App;
use Ecm\App\Database;
use Ecm\App\Product;

class ProductManager
{
    public function displayAll()
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $products = $stmt->fetchAll();
        $data = [];
        foreach ($products as $product) {
            $data[] = new Product($product['id'], $product['name'], $product['description'], $product['price'], $product['quantity']);
        }
        return $data;// [ Product, Product, Product]
    }

    public function delete($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
        // $stmt->bindParam(':id', $id);
        $stmt->execute([
            ':id' => $id
        ]);
    }    

    public function getProduct($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([
            ':id' => $id
        ]);
        $product = $stmt->fetch();
        return new Product($product['id'], $product['name'], $product['description'], $product['price'], $product['quantity']);
    }

    public function update(Product $product)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE products SET name = :name, description = :description, price = :price, quantity = :quantity WHERE id = :id");
        $stmt->execute([
            ':name' => $product->getName(),
            ':description' => $product->getDescription(),
            ':price' => $product->getPrice(),
            ':quantity' => $product->getQuantity(),
            ':id' => $product->getId()
        ]);
    }
}
