<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission Result</title>
</head>

<body>
    <?php
    // Function to test input data
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Initialize variables
    $username = $email = $date = $gender = $file = $comment = "";
    $errors = [];

    // Validate form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and test each input
        $username = test_input($_POST["username"]);
        $email = test_input($_POST["email"]);
        $date = test_input($_POST["date"]);
        $gender = isset($_POST["gender"]) ? test_input($_POST["gender"]) : "";
        $file = test_input($_POST["file"]);
        $comment = test_input($_POST["comment"]);

        // Validate name (at least 2 characters)
        if (strlen($username) < 2) {
            $errors['username'] = "Name must be at least 2 characters long.";
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format.";
        }

        // Validate date (optional: additional validation can be added based on requirements)
        // Example: Check if date is in the past or future
        $current_date = date('Y-m-d');
        if ($date > $current_date) {
            $errors['date'] = "Date of Birth cannot be in the future.";
        }

        // Validate gender (at least one radio button checked)
        if (empty($gender)) {
            $errors['gender'] = "Please select a gender.";
        }

        //file upload 
        $targetDirectory = "file upload/";  // Directory where uploaded files will be stored
        $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);  // Path of the uploaded file

        $uploadOk = 1;  // Flag to track if file upload was successful

        // Check if file is actually uploaded and not an empty file
        if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
            // Check file size if needed
            if ($_FILES["file"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow only certain file formats
            $allowedExtensions = array("jpg", "jpeg", "png", "gif");
            $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            // if ($uploadOk == 0) {
            //     echo "Sorry, your file was not uploaded.";
            // } else {
            //     // If everything is ok, try to upload file
            //     if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            //         echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
            //     } else {
            //         echo "Sorry, there was an error uploading your file.";
            //     }
            // }
        } else {
            echo "No file selected or there was an error during file upload.";
        }

        // If there are no errors, proceed with form submission
        if (empty($errors)) {
            // Example: Displaying input details
            echo "<h2>Form Submission Successful</h2>";
            echo "<p>Welcome, <b>$username</b>! Your form has been submitted successfully.</p>";
            echo "<p><b>Details:</b></p>";
            echo "<ul>";
            echo "<li><b>Name:</b> $username</li>";
            echo "<li><b>Email:</b> $email</li>";
            echo "<li><b>Date of Birth:</b> $date</li>";
            echo "<li><b>Gender:</b> $gender</li>";
            echo "<li><b>file:</b> ".htmlspecialchars( basename( $_FILES["file"]["name"]))."</li>";
            echo "<li><b>Comment:</b> $comment</li>";
            echo "</ul>";

            // Example: File handling - writing to a file
            $file = fopen("data.txt", "a") or die("Unable to open file!");
            fwrite($file, "Name: $username, Email: $email, Date of Birth: $date, file:".htmlspecialchars( basename( $_FILES["file"]["name"])).",Gender:$gender, Comment: $comment\n");
            fclose($file);

            // Example: File handling - reading from a file (previous entries)
            echo "<h2>File Handling</h2>";
            echo "<h3>Previous Entries:</h3>";
            if (file_exists("data.txt")) {
                $entries = file("data.txt");
                foreach ($entries as $entry) {
                    echo "<p>$entry</p>";
                }
            } else {
                echo "<p>No previous entries found.</p>";
            }
        } else {
            // Display errors if any
            echo "<h2>Form Submission Failed</h2>";
            echo "<p>Please fix the following errors:</p>";
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
        }
    }

    // Open sample.txt for reading and display its content
    $file = fopen("sample.txt",'w+');
    $txt = "Hello PHP file";
    fwrite($file,$txt);
    $file_content = "";
    $file_handle = fopen("sample.txt", "r");
    if ($file_handle) {
        $file_content = fread($file_handle, filesize("sample.txt"));
        fclose($file_handle);
    } else {
        echo "Failed to open sample.txt for reading.";
    }

    // Display the content of sample.txt
    echo "<h3>Content of sample.txt using fread()</h3>";
    echo "<p>$file_content</p>";
    ?>
</body>

</html>
