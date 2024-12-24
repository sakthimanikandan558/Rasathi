<?php
    require 'task_day4.php';
    use Rasathi\practice as R;
    use PDO;
    use PDOException;
    
    $obj = new R();
    $obj->hello();

    // Connect to PostgreSQL
    $servername = "localhost";
    $username = "postgres";
    $password = "postgres";
    $dbname = "Task1";

    try {
        //create object for connection
        $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
        //create error mode
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        echo "<br>Database $dbname connected <br>";

        //create table user
        $craete_table = "CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL,
            password VARCHAR(8) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        // Use PDO to prepare and execute the SQL statement
        $conn->exec($craete_table);

        echo "Table users created successfully<br>";

        if(isset($_POST['submit'])){
            $username=$_POST['username'];
            $email= $_POST['email'];
            $password= $_POST['password'];
            $insert_table = "insert into users (username,email,password) values ('$username','$email','$password')";
            $conn->exec($insert_table);
            echo "Records inserted into users table successfully<br>";
        }
         

            

            $stmt = $conn->prepare("SELECT * FROM users");
            $stmt->execute();
            echo "<h1>User Details</h1>";
            echo "
                <table border=1 style='border-collapse: collapse;margin-top:10px'>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>E-Mail</th>
                    <th>Password</th>
                    <th>Created_at</th>
                </tr>
            ";
            foreach(($stmt->fetchAll()) as $row) {
                echo "
                    <tr>
                        <td style='padding:10px'>$row[id]</td>
                        <td style='padding:10px'>$row[username]</td>
                        <td style='padding:10px'>$row[email]</td>
                        <td style='padding:10px'>$row[password]</td>
                        <td style='padding:10px'>$row[created_at]</td>
                    </tr>
                ";
            
             }
             echo "</table>";
    


        // //insert data to user
        // ,
        // ('sample2','demo2@gmail.com'),
        // ('sample3','demo3@gmail.com'),
        // ('sample4','demo4@gmail.com'),
        // ('sample5','demo5@gmail.com')";

        // $conn->exec($insert_table);
        // echo "Records inserted into users table successfully<br>";
        
        // //get lastid
        // $last_id = $conn->lastInsertId();
        // echo "Last Inserted record id: $last_id";

        // //prepare statement
        // $prepare_stmt = $conn->prepare("insert into users(username,email) values (:username,:email)");
        // $prepare_stmt->bindparam(':username',$username);
        // $prepare_stmt->bindparam(':email',$email);


    } catch(PDOException $e){
        echo "Connection $dbname is failed due to".$e->getMessage();
    }

    $conn = null;
?>