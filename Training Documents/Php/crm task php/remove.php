<?php
    // Database connection settings
$dbhost = 'localhost';
$dbname = 'crm';
$dbuser = 'postgres';
$dbpass = 'postgres';

try {
    // Connect to PostgreSQL using PDO
    $pdo = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if product_id is set and valid
    if (isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];

        // Remove item from cart
        $stmt = $pdo->prepare('DELETE FROM cart WHERE product_id = :product_id');
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();

        // Redirect back to the cart page (index.php)
        header('Location: show_cart.php');
        exit();
    } else {
        die('Error: Product ID not specified.');
    }

} catch (PDOException $e) {
    die("Error: Could not connect to database. " . $e->getMessage());
}


?>