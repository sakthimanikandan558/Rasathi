<?php

session_start();

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

    // Handle adding product to cart
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId'])) {
        $productId = $_POST['productId'];

        $username = $_SESSION['username'];
       
        // Fetch cart items with product details including image
        $stmt = $pdo->prepare("SELECT id FROM user_login WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $userid = $user['id'];

            // Example: Add product to cart (simulated by adding to cart table)
            $stmt = $pdo->prepare('INSERT INTO cart (product_id, userid) VALUES (?, ?)');
            $stmt->execute([$productId, $userid]);

            header('Location: index.php');
            exit;
        } else {
            die("User not found."); // Handle this case as needed
        }
    }
} catch (PDOException $e) {
    die("Error: Could not connect to database. " . $e->getMessage());
}
