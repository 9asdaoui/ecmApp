<?php
// namespace Ecm\App;

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
        return "
        <div class='product-card'>
            <div class='product-image'>
                <img src='$this->image' alt='Product Image'>
            </div>
            <div class='product-details'>
                <h3 class='product-name'>$this->name</h3>
                <p class='product-description'>$this->description</p>
                <p class='product-price'>$this->price</p>
                <p class='product-quantity'>Quantity: $this->quantity</p>
                <p class='product-category'>Category: $this->category</p>
                <div class='product-actions'>
                
                <form action='/products/edit.php' method='GET' style='display:inline;'>
                    <input type='hidden' name='url' value='Edit' />
                    <input type='hidden' name='id' value='$this->id' />
                    <button type='submit' class='edit-btn' style='
                        background:none;
                        border:none;
                        color:#007bff;
                        text-decoration:underline;
                        cursor:pointer;
                        font-size:16px;
                        font-weight:500;
                        transition: color 0.3s ease, text-decoration 0.3s ease;
                        padding:0;'>Edit</button>
                </form>

                <form action='../../core/Router.php' method='GET' style='display:inline;'>
                    <input type='hidden' name='url' value='Delet' />
                    <input type='hidden' name='id' value='$this->id' />
                    <button type='submit' class='delete-btn' style='
                        background:none;
                        border:none;
                        color:#dc3545;
                        text-decoration:underline;
                        cursor:pointer;
                        font-size:16px;
                        font-weight:500;
                        transition: color 0.3s ease, text-decoration 0.3s ease;
                        padding:0;'>Delete</button>
                </form>
                </div>
            </div>
        </div>
    ";
    }
}
