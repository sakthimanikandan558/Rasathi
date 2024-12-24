<?php
session_start(); // Start or resume the session



// Require the Product class file
require 'product.php';

echo "<pre>";

echo print_r($_POST);

// Display products in a table format
echo "<h2>Products List:</h2>";
echo "<table border='1'>";
echo "<tr><th>Name</th><th>Description</th><th>Price</th></tr>";
if (!empty($_SESSION['products'])) {
    foreach ($_SESSION['products'] as $product) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($product['name']) . "</td>";
        echo "<td>" . htmlspecialchars($product['description']) . "</td>";
        echo "<td>$" . number_format($product['price'], 2) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No products added yet.</td></tr>";
}
echo "</table>";

echo "<pre>";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Create a new instance of Product
    $product = new Product($name, $description, $price);

    

    // Store product data in session
    $_SESSION['products'][] = [
        'name' => $product->name,
        'description' => $product->description,
        'price' => $product->price
    ];

    // Redirect to prevent form resubmission on refresh
    // header("Location: index.php");
    exit();
}


