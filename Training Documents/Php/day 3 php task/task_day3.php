<?php

$cookie_name = "user";
$cookie_value = "Rasathi";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
session_start();

// Initialize counter if it doesn't exist
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 1;
} else {
    // Increment counter for each visit
    $_SESSION['counter']++;
}

echo "Session ID: " . session_id() . "<br>";
echo "<h3>You visited this page " . $_SESSION['counter'] . " times</h3>";

echo "<h4>filter_list()</h4>";
foreach (filter_list() as $id => $filter) {
    echo "$filter (" . filter_id($filter) . ")<br>";
}

echo "<h3>filter_var()</h3>";

// Example usage of filter_var()

// Validate a float
$x = 0.50;
if (filter_var($x, FILTER_VALIDATE_FLOAT)) {
    echo "$x is a float<br>";
}

// Validate an IP address
$ip = "127.0.0.1";
if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
    echo("$ip is a valid IP address<br>");
} else {
    echo("$ip is not a valid IP address<br>");
}

// Sanitize a string to remove non-numeric characters
$number = "123abc";
$filtered_number = filter_var($number, FILTER_SANITIZE_NUMBER_INT);
echo "Filtered number: $filtered_number<br>";

// Sanitize a string to remove HTML tags
$input_string = "<script>alert('Hello');</script>";
$filtered_string = filter_var($input_string, FILTER_SANITIZE_STRING);
echo "Filtered string: $filtered_string<br>";

echo "<h3>Cookie</h3>";
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
  } else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
  }
?>
