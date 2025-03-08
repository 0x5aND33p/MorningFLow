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

// Login form handling
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Input validation
    if (empty($username) || empty($password)) {
        echo "Username and password are required.";
    } else {
        // Check if the user exists in the database
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
               header('Location: https://mi-linux.wlv.ac.uk/~2349473/Level_5/collab/open_day/index.php');
               exit;
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that username.";
        }
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon"  href="unifavicon.ico">
        <title> Login </title>
        <style>
            body {
                background-image: url('WolverhamptonUni.jpg');
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
            <form method="POST" action="">
                <label for="username">Username:</label>
                <input type="text" name="username" required><br>

                <label for="password">Password:</label>
                <input type="password" name="password" required><br>

                <button type="submit">Login</button>
            </form>
        </div>
    </body>
</html>