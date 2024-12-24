<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"],
        .login-container input[type="email"],
        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .login-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .login-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 5px;
            font-size: 0.8em;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login Form</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" name="username" placeholder="Username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required><br>
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['username'])) {
                echo '<p class="error">Username is required</p>';
            } elseif (!preg_match('/^[a-zA-Z]+$/', $_POST['username'])) {
                echo '<p class="error">Username should contain only letters</p>';
            }
        } ?>
        
        <input type="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required><br>
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['email'])) {
                echo '<p class="error">Email is required</p>';
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                echo '<p class="error">Invalid email format</p>';
            }
        } ?>
        
        <input type="password" name="password" placeholder="Password" required><br>
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['password'])) {
                echo '<p class="error">Password is required</p>';
            } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).*$/', $_POST['password'])) {
                echo '<p class="error">Password must contain at least one letter, one number, and one special character</p>';
            }
        } ?>
        
        <input type="submit" name="submit" value="Login">
    </form>
</div>

</body>
</html>
