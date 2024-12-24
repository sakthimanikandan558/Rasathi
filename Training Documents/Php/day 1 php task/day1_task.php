<?php

// Variables
$name = "Rasathi";
$age = 20;
echo "<h2>Rasathi</h2>";
// Echo and print statements
echo "<h3>Echo and print statements</h3>";
echo "Hello, $name! You are $age years old.<br>";
print "Welcome, $name!<br>";

// Data Types
echo "<h3>Data Types</h3>";
echo "<h4>There are 4 scalar data types in PHP.It holds only single value.</h4>";
$number = 10; // integer
var_dump($number); //to identify the data type
echo "<br>";
$float_number = 3.14; // float
var_dump($float_number); //to identify the data type
echo "<br>";
$is_student = true; // boolean
var_dump($is_student); //to identify the data type
echo "<br>";
$message = "Hello Rasathi!";//string
var_dump($message);

echo "<h4> There are 2 compound data types in PHP.It can hold multiple values.</h4>";
$fruits = array("Apple", "Banana", "Cherry"); // array
var_dump($fruits);
echo "<br>";

class dog {
    public $dog;
    public $price;

    public function __construct($dog,$price)
    {
       $this->dog = $dog;
       $this->price = $price;
    }

    public function dog(){
        echo "this is how we declare object here in php<br>$this->dog : $this->price";
    }
    
}

$buy = new dog("American Pit Bull Terrier",800);
echo var_dump($buy);
echo "<br>";

echo "<h3>There are 2 special data types in PHP</h3> 1.Resource<br> 2.NULL<br>";
$x = "Hello world!";
$x = null;
var_dump($x);
echo "<br>";
// Strings
echo "<h3>Strings</h3>";
$message = "Hello Rasathi!";
echo "String: $message<br>";

//Sting Functions
echo "<h3>Sting Functions</h3>";
echo "Hello world!<br>";
echo "strlen : ";
echo strlen("Hello world!");
echo "<br>";
echo "str_word_count : ";
echo str_word_count("Hello world!");
echo "<br>";
echo "strpos : ";
echo strpos("Hello world!", "world");
echo "<br>";
echo "strtoupper : ";
$x = "Hello Rasathi!";
echo strtoupper($x);
echo "<br>";
echo "strtolower : ";
echo strtolower($x);
echo "<br>";
echo "str_replace : ";
echo str_replace("Rasathi", "Shami Kanna", $x);
echo "<br>";
echo "strrev : ";
echo strrev($x);
echo "<br>";
echo "trim : ";
echo trim($x,"H");
echo "<br>";
echo "explode : ";
$y = explode(" ", $x);
print_r($y);
echo "<br>";
echo "String Concatenation : ";
$x = "Hello";
$y = "World";
$z = $x ." ".$y;
echo $z;
echo "<br>";
echo "substr : ";
$x = "Hello Rasathi!";
echo substr($x, 6,strlen($x));
echo "<br>";
echo "Escape Characters : ";
echo "\"Hello Rasathi\"";
echo "<br>";

//single quote
echo "<h3>Single quoted strings does not perform actions, it returns the string like it was written, with the variable name:</h3>";
echo 'Hello $x <br>';

// Numbers
echo "<h3>Numbers</h3>";
$num1 = 10;
$num2 = 5;
echo "is_int : ";
$x = 5985;
var_dump(is_int($num1));
echo "<br>";
echo "is_float : ";
var_dump(is_float($num1));
echo "<br>";
$x = 1.9e411;
var_dump($x);
echo "<br>";
$x = acos(8);
var_dump($x);
echo "<br>";
echo "is_numeric : ";
$x = 5985;
var_dump(is_numeric($x));

$x = "5985";
var_dump(is_numeric($x));


// Casting
echo "<h3>Casting</h3>";
$result = (int)($num1 / $num2); // Cast float result to integer
echo "Result after casting: $result<br>";

echo "<pre>";
$a = 5;       // Integer
$b = 5.34;    // Float
$c = "hello"; // String
$d = true;    // Boolean
$e = NULL;    // NULL

$a = (string) $a;
$b = (string) $b;
$c = (string) $c;
$d = (string) $d;
$e = (string) $e;
var_dump($a);
var_dump($b);
var_dump($c);
var_dump($d);
var_dump($e);
echo "</pre>";



// Math
echo "<h3>Math</h3>";
$sum = $num1 + $num2;
$product = $num1 * $num2;
echo "Sum: $sum, Product: $product<br>";

// Constants
echo "<h3>Constants</h3>";
define("PI", 3.14159);
echo "Value of PI: " . PI . "<br>";

// Magic Constants
echo "<h2>Magic Constants</h2>";
echo "Line number: " . __LINE__ . "<br>";
class Fruits {
    public function myValue(){
      return __CLASS__;
    }
  }
  $kiwi = new Fruits();
  echo $kiwi->myValue();
  echo "<br>";
  echo __DIR__;
  echo "<br>";
  echo __FILE__;
  echo "<br>";
  function myValue(){
    return __FUNCTION__;
  }
  echo myValue();
  echo "<br>";
  class Apple {
    public function red(){
      return __METHOD__;
    }
  }
  $method = new Apple();
  echo $method->red();

// Operators
echo "<h3>Operators</h3>";
$a = 10;
$b = 3;

echo "Addition: " . ($a + $b) . "<br>";
echo "Subtraction: " . ($a - $b) . "<br>";
echo "Multiplication: " . ($a * $b) . "<br>";
echo "Division: " . ($a / $b) . "<br>";
echo "Modulus: " . ($a % $b) . "<br>";

// Increment and Decrement
echo "<h3>Increment and Decrement</h3>";
$c = 5;
echo "Pre Increment c: " . ++$c . "<br>";
echo "Pre Decrement c: " . --$c . "<br>";
echo "Post Increment c: " . $c++ . "<br>";
echo "Post Decrement c: " . $c --. "<br>";

// Concatenation

$str1 = "Hello";
$str2 = "World";
echo $str1 . " " . $str2 . "<br>";

// Comparison Operators
echo "<h3>Comparison Operators</h3>";
$x = 10;
$y = "10";
var_dump($x == $y);
echo "<br>";  // true, same value
var_dump($x === $y); // false, different types

// Logical Operators
echo "<h3>Logical Operators</h3>";
$bool1 = true;
$bool2 = false;
var_dump($bool1 && $bool2); // false, AND
echo "<br>";
var_dump($bool1 || $bool2); // true, OR
echo "<br>";
var_dump(!$bool1);          // false, NOT

?>

