<?php
// Database connection settings
$dbhost = 'localhost';
$dbname = 'crm';
$dbuser = 'postgres';
$dbpass = 'postgres';

try {
    // Connect to PostgreSQL using PDO
    $pdo = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productName'])) {
        $productName = $_POST['productName'];
        $productDesc = $_POST['productDesc'];
        $productPrice = $_POST['productPrice'];

        // File upload handling
        $targetDir = "file upload";
        $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["productImage"]["tmp_name"]);
        if ($check === false) {
            throw new Exception("File is not an image.");
        }

        // Check file size (max 5MB)
        if ($_FILES["productImage"]["size"] > 5000000) {
            throw new Exception("Sorry, your file is too large.");
        }

        // Allow certain file formats
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Upload file
        if (!move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
            throw new Exception("Sorry, there was an error uploading your file.");
        }

        // Insert product details into database with image path
        $stmt = $pdo->prepare('INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)');
        $stmt->execute([$productName, $productDesc, $productPrice, $targetFile]);

        // Redirect back to index.php after adding product
        header('Location: index.php');
        exit;
    }
} catch (PDOException $e) {
    die("Error: Could not connect to database. " . $e->getMessage());
} catch (Exception $e) {
    die("Failed to add product. " . $e->getMessage());
}
?>
