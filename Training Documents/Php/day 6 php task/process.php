<?php

function calculateBMI($weight, $height)
{
    if ($height > 0) {
        return $weight / ($height * $height);
    } else {
        return null; 
    }
}


$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $height = floatval($_POST["height"]);
    $weight = floatval($_POST["weight"]);
    $languages = $_POST["languages"] ?? [];
   
    if (empty($name)) {
        $errors[] = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $errors[] = "Name can only contain letters and spaces.";
    }

    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email address is required.";
    }

   
    if ($height <= 0) {
        $errors[] = "Height must be a positive number.";
    }
    if ($weight <= 0) {
        $errors[] = "Weight must be a positive number.";
    }

    
    $bmi = calculateBMI($weight, $height);



   
    $countAllLanguages = count($languages);


    
    $selectedLanguages = array_filter($languages, function ($lang) {
        return stripos($lang, 'j') !== 0; 
    });
    $countLanguages = count($selectedLanguages);

   
    if (!empty($errors)) {
        echo "<h2>Errors:</h2><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    } else {
        
        echo "<h2>Success!</h2>";
        echo "<p>Name: $name</p>";
        echo "<p>Email: $email</p>";
        echo "<p>BMI: " . number_format($bmi, 2) . "</p>";
        echo "<p>Total languages selected: $countAllLanguages</p>";
       
        echo "<p>Selected Languages:</p >";
        echo "<ul>";
        foreach ($languages as $lang) {
            echo "<li>$lang</li>";
        }
        echo "</ul>";
        echo "<p>Languages Count (excluding start with J): $countLanguages</p>";

       
        if ($countLanguages > 0) {
            echo "<p>Selected Languages (excluding start with J):</p>";
            echo "<ul>";
            foreach ($selectedLanguages as $lang) {
                echo "<li>$lang</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No languages selected after filtering.</p>";
        }
    }
}
