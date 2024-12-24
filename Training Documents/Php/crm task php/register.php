<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
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
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"],
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
    <h2>Register..!</h2><br>
    <form action="validate.php method="POST" enctype="multipart/form-data">
        <input type="text" name="newuser" placeholder="Username" value="<?php echo isset($_POST['newuser']) ? htmlspecialchars($_POST['newuser']) : ''; ?>" required><br>
        
        <br><br>
        <input type="password" name="newpassword" placeholder="Password" required><br>
       
        <br><br>
        <input type="submit" name="regsubmit" value="Register"><br><br>

        <a href="login.php">Already a user..?</a>
    </form>
</div>

</body>
</html>
