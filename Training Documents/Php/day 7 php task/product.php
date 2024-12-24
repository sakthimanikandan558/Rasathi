<?php
// Define the Product class
class Product {
    // Properties
    public string $name;
    public string $description;
    public float $price;

    // Constructor
    public function __construct(string $name, string $description, float $price) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }
}
?>