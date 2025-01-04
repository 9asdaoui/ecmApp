<?php
namespace Ecm\App;

class Product
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $quantity;
    private $category;
    private $image;

    public function __construct($id, $name, $description, $price, $quantity, $category, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->category = $category;
        $this->image = $image;
    }

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

    public function getCategory()
    {
        return $this->category;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setName($name)
    {
        if (!$name) {
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
        if ($price < 0) {
            echo "Price cannot be negative";
            return;
        }
        $this->price = $price;
    }

    public function setQuantity($quantity)
    {
        if ($quantity < 0) {
            echo "Quantity cannot be negative";
            return;
        }
        $this->quantity = $quantity;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function rendreRow()
    {
        return "<tr>
                    <td>$this->name</td>
                    <td>$this->description</td>
                    <td>$this->price</td>
                    <td>$this->quantity</td>
                    <td>$this->category</td>
                    <td><img src='$this->image' alt='Product Image' style='width: 50px; height: 50px;'></td>
                    <td>
                        <a href='/products/edit.php?id=$this->id'>Edit</a>
                        <a href='/products/delete.php?id=$this->id'>Delete</a>
                    </td>
                </tr>";
    }
}
