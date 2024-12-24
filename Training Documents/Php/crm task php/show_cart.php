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
    $username = $_SESSION['username'];
    
    // Fetch cart items with product details including image

    $stmt = $pdo->prepare('SELECT c.product_id, p.name, p.description, p.price, p.image, COUNT(*) AS count FROM cart c INNER JOIN products p ON c.product_id = p.id INNER JOIN user_login u ON c.userid = u.id where username=:username GROUP BY c.product_id, p.name, p.description, p.price, p.image ORDER BY p.name');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalPrice = 0; // Initialize total price variable

    foreach ($cartItems as $item) {
        $totalPrice += ($item['price'] * $item['count']);
    }

    
} catch (PDOException $e) {
    die("Error: Could not connect to database. " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Items</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .product-image {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="flex justify-between">
            <h1 class="text-3xl font-semibold mb-4">Cart Items</h1>
            <div class="total-price">
                Total Price: $<?= number_format($totalPrice, 2) ?>
            </div>
        </div>

        <?php if (empty($cartItems)) : ?>
            <p>No items in the cart.</p>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Count</th>
                        <th>Price ($)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item) : ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="product-image"></td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= htmlspecialchars($item['description']) ?></td>
                            <td><?= $item['count'] ?></td>
                            <td>$<?= number_format($item['price'] * $item['count'], 2) ?></td>
                            <td>
                                <form action="remove.php" method="post">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <button type="submit" class="text-red-600">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="index.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mt-4 inline-block">Back to Home</a>
    </div>
</body>

</html>