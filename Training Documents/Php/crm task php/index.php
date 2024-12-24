<?php

session_start(); // Start the session

// Check if user is not logged in, redirect to login.php
if (!isset($_SESSION['username'])) {
    header('Location: gologin.php');
    exit;
}

// Database connection settings
$dbhost = 'localhost';
$dbname = 'crm';
$dbuser = 'postgres';
$dbpass = 'postgres';

try {
    // Connect to PostgreSQL using PDO
    $pdo = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




    // Fetch products from database
    $stmt = $pdo->query('SELECT * FROM products where isdeleted=false');
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Fetch cart items with product details including image
    $stmt = $pdo->prepare('SELECT c.product_id, p.name, p.description, p.price, p.image, COUNT(CASE WHEN c.isvisited = false THEN 1 ELSE NULL END) AS count FROM cart c INNER JOIN products p ON c.product_id = p.id GROUP BY c.product_id, p.name, p.description, p.price, p.image ORDER BY p.name');
    $stmt->execute();
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalPrice = 0; // Initialize total price variable

    foreach ($cartItems as $item) {
        $totalPrice += ($item['count']);
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
    <title>CRM SITE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-4 space-y-10">
        <div class="flex justify-between items-center mb-4">
            <div class="">
                <h1 class="text-3xl font-semibold">Grocery store</h1>
            </div>
            <div class="flex gap-4">
                <button id="addProductBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Add Product</button>
                <button id="showCartBtn" class="relative bg-red-500 text-white px-4 py-2 rounded flex space-x-2">
                    <p>show Cart</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                    <div class=" absolute px-2 right-0 bottom-6 bg-white text-black rounded-full"><?php echo "$totalPrice"; ?></div>
                </button>
                <button id="logout">logout</button>
            </div>
        </div>

        <!-- Product Cards -->

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
            <?php foreach ($products as $product) : ?>

                <div class="bg-white p-4 rounded-lg shadow-md">
                    <img src="<?php echo $product['image']; ?>" class="mb-2 rounded-md" alt="<?php echo $product['name']; ?>">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-semibold mb-2"><?php echo $product['name']; ?></h2>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <button type="submit" class="text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <p class="text-gray-600 mb-2"><?php echo $product['description']; ?></p>
                    <p class="font-bold text-gray-800">$<?php echo $product['price']; ?></p>
                    <div class="flex justify-between">
                        <form action="cart.php" method="POST">
                            <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mt-2">Add to Cart</button>
                        </form>
                        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mt-2">Buy Now</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div id="addProductModal" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-8 rounded-lg shadow-md max-w-md">
            <h2 class="text-2xl font-semibold mb-4">Add Product</h2>
            <form action="add_product.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="productName" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" id="productName" name="productName" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="productDesc" class="block text-sm font-medium text-gray-700">Product Description</label>
                    <textarea id="productDesc" name="productDesc" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="productPrice" class="block text-sm font-medium text-gray-700">Product Price ($)</label>
                    <input type="number" id="productPrice" name="productPrice" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" step="0.01" required>
                </div>
                <div class="mb-4">
                    <label for="productImage" class="block text-sm font-medium text-gray-700">Product Image</label>
                    <input type="file" id="productImage" name="productImage" accept="image/*" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Add Product</button>
                    <button type="button" id="closeModalBtn" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded ml-2">Close</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('addProductBtn').addEventListener('click', function() {
            document.getElementById('addProductModal').classList.remove('hidden');
        });

        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('addProductModal').classList.add('hidden');
        });

        if (<?= $totalPrice ?> === 0) {
            document.querySelector('.absolute.px-2.right-0.bottom-6.bg-white.text-black.rounded-full').classList.add('hidden');
        }
        document.getElementById('showCartBtn').addEventListener('click', function() {
            // Redirect to show cart page
            window.location.href = 'show_cart.php';

            <?php

            $stmt = $pdo->prepare('UPDATE cart SET isvisited = true');
            $stmt->execute();

            
            ?>
        });

        document.getElementById('logout').addEventListener('click',function(){

            window.location.href = 'login.php';
            // session_unset();
            session_destroy();
        });

        
    </script>

</body>

</html>