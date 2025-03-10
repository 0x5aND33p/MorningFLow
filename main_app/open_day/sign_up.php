<?php
// Database credentials
$servername = "localhost";
$username = "2362827";   // Your MySQL username
$password = "Zaman2023@";       // Your MySQL password
$dbname = "db2362827";  // The database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form input values
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Input validation
    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the username or email already exists
        $sql_check = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $result = $conn->query($sql_check);

        if ($result->num_rows > 0) {
            echo "Username or Email already exists.";
        } else {
            // Prepare the SQL query to insert the new user
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                // Output the success message and trigger a redirect after 3 seconds
                echo "<script>alert('Sign Up Successful! Redirecting to page...'); window.location.href = 'index.php';</script>";
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon"  href="images/unifavicon.ico">
        <title> Sign Up</title>
        <style>
            body {
                background-image: url('images/WolverhamptonUni.jpg');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f9;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .form-container {
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 400px;
            }
            .form-container h2 {
                text-align: center;
                margin-bottom: 20px;
            }
            .form-container label {
                display: block;
                margin: 10px 0 5px;
            }
            .form-container input {
                width: 95%;
                padding: 10px;
                margin-bottom: 15px;
                border-radius: 4px;
                border: 1px solid #ccc;
            }
            .form-container button {
                width: 100%;
                padding: 10px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            .form-container button:hover {
                background-color: #45a049;
            }
            .error {
                color: red;
                font-size: 12px;
            }
        </style>
    </head>
    <body>

        <div class="form-container">
            <h2>Sign Up</h2>
            <form method="POST" action="">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="email">Email:</label>
                <input type="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>
                <p>Already have an account? <a href="login.php"> Login here </a> </p>
                <button type="submit">Sign Up</button>
          
                
            </form>
        </div>
    </body>
</html>