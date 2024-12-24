<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form for PHP Task</title>
</head>

<body>
    <?php echo "<b>Today's Date is " . date("Y/m/d") . "</b><br>";
        echo "Today is " . date("l")."<br>";
        date_default_timezone_set("Asia/kolkatta");
        echo "The time is " . date("h:i:sa");
    ?>
    <form id="form" action="day2_task.php" enctype="multipart/form-data" method="post" style="padding: 10px; border: 2px solid; text-align: center; width: 30%; margin: auto; border-color:violet; margin-top: 6%;">
        <h2 style="color:red;">Register Here</h2>
        <label>Name: </label>
        <input type="text" name="username" value="" required pattern="[A-Za-z\s]{2,}">
        
        <br><br>
        <label>Email: </label>
        <input type="email" name="email" value="" required>
        
        <br><br>
        <label>DOB: </label>
        <input type="date" name="date" value="" required>

        <br><br>
        <label>Gender: </label>
        <input type="radio" name="gender" value="female" required> Female
        <input type="radio" name="gender" value="male" > Male
        <input type="radio" name="gender" value="other"> Other

        <br><br>
        <label>upload Photo: </label>
        <input type="file" name="file" value="" required>

        <br><br>
        <label>Comment: </label>
        <textarea name="comment" rows="4" cols="30"></textarea>
        <br><br>
        <button  type="submit" name="submit" style="padding: 10px;background:green;border: none;color: white;"><b>Submit</b></button>
    </form>
    <?php
    echo "<pre>";
            echo"<h1>Normal Array</h1>"; 
                $a=array(1,2,10,200,5,"hi",10);
                print_r($a[0]);
                echo"<br><br>";
            echo "<pre>";
            echo"<h1> Associative array</h1>";
                $b=array("num1"=>20,"num2"=>10,"num3"=>5);
                print_r($b);
                echo "<pre>";
            echo"<h1>Multi dimentional array</h1>"; 
                $c=array([1,2],["num1"=>10,"num2"=>20]);
                print_r($c);
                echo $c[1]['num1'];
            echo "<pre>";
            echo"<h1>Array sorting</h1> ";
                sort($a);
                rsort($a);
                print_r($a);
            echo"<h1>Associative array sort</h1> ";
                asort($b);
                arsort($b);
                print_r($b);
            echo"<h1>Associative array sort based on key</h1> ";
            $d=array("num1"=>20,"num2"=>10,"num3"=>5,"num4"=>12);
                ksort($d);
                krsort($d);
                print_r($d);
            echo"<h1>Array functions</h1> ";
            $e='name1,name2,name3';
                $e=explode(",",$e);
                print_r($e[0]);
            echo "<pre>";
            $f=array('name1','name2','name3');
                $f=implode($f);
                // $f=implode(",",$f);
                print_r(var_dump($f));
            echo "<pre>";
            $g=array('name1','name2','name3');
            $h=array_slice($g,0,2);
    ?>
</body>

</html>
