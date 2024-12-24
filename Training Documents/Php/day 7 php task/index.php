
<h2>add a Product:</h2>
<form method="post" action="practice.php">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>
    <label for="description">Description:</label><br>
    <textarea id="description" name="description" required></textarea><br><br>
    <label for="price">Price:</label><br>
    <input type="number" id="price" name="price" step="0.01" required><br><br>
    <input type="submit" value="Add Product">
</form>
