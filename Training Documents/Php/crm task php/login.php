<?php
session_start();


class Database {
    private $pdo;

    public function __construct($dbhost, $dbname, $dbuser, $dbpass) {
        try {
            $this->pdo = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error: Could not connect to database. " . $e->getMessage());
        }
    }

    
    public function authenticateUser($username, $password) {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM user_login WHERE username = ? AND password = ?');
            $stmt->execute([$username, $password]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            $_SESSION['error_message'] = 'Error: ' . $e->getMessage();
            return null;
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $dbhost = 'localhost';
    $dbname = 'crm';
    $dbuser = 'postgres';
    $dbpass = 'postgres';

    $db = new Database($dbhost, $dbname, $dbuser, $dbpass);

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $db->authenticateUser($username, $password);

    if ($user) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error_message'] = 'Invalid username or password';
        header('Location: login.php');
        exit;
    }
}
?>

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
        <h2>Login Form</h2><br>
        <form action="login.php" method="post" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required><br>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST['username'])) {
                    echo '<p class="error">Username is required</p>';
                } elseif (!preg_match('/^[a-zA-Z]+$/', $_POST['username'])) {
                    echo '<p class="error">Username should contain only letters</p>';
                }
            } ?>
            <br><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST['password'])) {
                    echo '<p class="error">Password is required</p>';
                } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).*$/', $_POST['password'])) {
                    echo '<p class="error">Password must contain at least one letter, one number, and one special character</p>';
                }
            } ?>
            <br><br>
            <input type="submit" name="submit" value="Login"><br><br>

            <a href="register.php">Don't have an account</a>
    </div>
    </form>
    </div>

    <div>

</body>

</html>