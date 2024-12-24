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

    // Check if id is set and valid
    if (isset($_POST['id'])) {
        $Id = $_POST['id'];

        // Remove item from cart
        $stmt = $pdo->prepare('update products set isdeleted=true WHERE id = :id');
        $stmt->bindParam(':id', $Id);
        $stmt->execute();

        $stmt = $pdo->prepare('DELETE FROM cart WHERE product_id = :id');
        $stmt->bindParam(':id', $Id);
        $stmt->execute();

        // Redirect back to the cart page (index.php)
        header('Location: index.php');
        exit();
    } else {
        die('Error:  ID not specified.');
    }

} catch (PDOException $e) {
    die("Error: Could not connect to database. " . $e->getMessage());
}


?>