<!-- <?php
include 'process.php';
?> -->
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Form</h2>
    <form action="process.php" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="height">Height:</label><br>
        <input type="number" id="height" name="height" step="0.01" required><br><br>

        <label for="weight">Weight:</label><br>
        <input type="number" id="weight" name="weight" step="0.1" required><br><br>

        <label>Languages known :</label><br>
        <input type="checkbox" id="java" name="languages[]" value="java">
        <label for="java">Java</label><br>
        
        <input type="checkbox" id="javascript" name="languages[]" value="javascript">
        <label for="javascript">JavaScript</label><br>
        
        <input type="checkbox" id="python" name="languages[]" value="python">
        <label for="python">Python</label><br>
        
        <input type="checkbox" id="php" name="languages[]" value="php">
        <label for="php">PHP</label><br>
        
        <input type="checkbox" id="ruby" name="languages[]" value="ruby">
        <label for="ruby">Ruby</label><br>
        
        <input type="checkbox" id="csharp" name="languages[]" value="csharp">
        <label for="csharp">C#</label><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
