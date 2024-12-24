<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['regsubmit'])) {
    $errors = []; // Array to store validation errors

    // Validate newuser field
    $newuser = $_POST['newuser'];
    if (empty($newuser)) {
        $errors['newuser'] = 'Username is required';
    } elseif (!preg_match('/^[a-zA-Z]+$/', $newuser)) {
        $errors['newuser'] = 'Username should contain only letters';
    }

    // Validate newpassword field
    $newpassword = $_POST['newpassword'];
    if (empty($newpassword)) {
        $errors['newpassword'] = 'Password is required';
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).*$/', $newpassword)) {
        $errors['newpassword'] = 'Password must contain at least one letter, one number, and one special character';
    }

    if (!empty($errors)) {
        // Redisplay the form with errors
        include 'register.php'; // or use require_once 'register.php'; if preferred
        exit; // Stop further execution
    }
    header('Location: login.php');

    // Database connection settings
    $dbhost = 'localhost';
    $dbname = 'crm';
    $dbuser = 'postgres';
    $dbpass = 'postgres';

    try {
        // Connect to PostgreSQL using PDO
        $pdo = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo print_r($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newuser'])) {

            $newuser = $_POST['newuser'];
            $newpwd = $_POST['newpassword'];
        }

        $stmt = $pdo->prepare('INSERT into user_login (username,password) values (?,?)');

        $stmt->execute([$newuser, $newpwd]);
    } catch (PDOException $e) {
        die("Error: Could not connect to database. " . $e->getMessage());
    }

    exit;
}
