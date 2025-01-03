<?php
namespace Ecm\App;
// use src\Database;

class Product
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $quantity;
    // private $category;
    // private $image;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setName($name)
    {
        if(!$name){
            echo "Name is required";
            return;
        }
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    public function __construct($id, $name, $description, $price, $quantity)
    {
        echo "Product object is created\n";
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function __destruct()
    {
        echo "Product object is destroyed\n";
    }

    public function rendreRow()
    {
        return "<tr>
                    <td>$this->name</td>
                    <td>$this->description</td>
                    <td>$this->price</td>
                    <td>$this->quantity</td>
                    <td>
                        <a href='/products/edit.php?id=$this->id'>Edit</a>
                        <a href='/products/delete.php?id=$this->id'>Delete</a>
                    </td>
                </tr>";
    }
}
