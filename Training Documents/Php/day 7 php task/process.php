<?php
// Require the Product class file
require 'product.php';



// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Create a new instance of Product
    $product1 = new Product($name, $description, $price);

    // Display product information
    echo "<h2>Product Information:</h2>";
    echo "<p>Name: " . htmlspecialchars($product1->$name) . "</p>";
    echo "<p>Description: " . htmlspecialchars($product1->$description) . "</p>";
    echo "<p>Price: $" . number_format($product1->$price, 2) . "</p>";
} else {
    // Redirect back to the form if accessed directly without POST data
    header("Location: index.php");
    exit();
}
?>
