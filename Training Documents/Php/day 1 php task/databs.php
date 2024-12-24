<?php

$name=$_POST['name'];
$r=$_POST['rollno'];

$host = "localhost"; // Replace with your PostgreSQL host name or IP address
$port = "5432"; // Replace with your PostgreSQL port number
$dbname = "Task1"; // Replac6e with your PostgreSQL database name
$user = "postgres"; // Replace with your PostgreSQL username
$password = "postgres"; // Replace with your PostgreSQL password

// Establish a connection to the PostgreSQL database
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}else{
    echo "Successfully connected";
}

$query = "CREATE TABLE student (
    id SERIAL PRIMARY KEY,
Student_name VARCHAR(100) NOT NULL,
    rollno VARCHAR(100) NOT NULL
   
  )";

$query2="insert into student(Student_name,rollno) values('$name','$r')";
$query3="select * from student";


  $result = pg_query($conn,$query);
  $result2 = pg_query($conn,$query2);
  $result3=pg_query($conn,$query3);

echo "User Details:";
echo "<table border=1 style=border-collapse>
        <tr>
            <th>StudentName</th>
            <th>RollNo</th>
        </tr>
";
while($row=pg_fetch_assoc($result3)){
         echo "<tr>
            <td>$row[student_name]</td>
            <td>$row[rollno]</td>
         </tr>";
         
}
echo "</table>";

  if(!$result2){
    die( pg_last_error());
  }
  else{
    echo "value inserted successfully";
  }
?>