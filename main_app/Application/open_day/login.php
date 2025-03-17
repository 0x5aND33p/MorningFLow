<?php
session_start();

//Database connection
include("db_connection.php");
$conn = db_connections($password);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $user = $_POST['username'];
    $pass = $_POST['password'];

    //Query to get user info
    $stmt = $conn->prepare("SELECT user_id, password FROM openDay_users
                            WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    // Input validation
    if (empty($user) || empty($pass)) {
        echo "Username and password are required.";
    } else {

        //check to see if user exists
        if($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            //verify password
            if(password_verify($pass,$hashed_password)){
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $user;

                //Regenerate Session ID for security
                session_regenerate_id(true);

                header("Location:index.php");
                exit();
            } else{
                echo "Invalid Password!";
            }
        }else {
            echo "User not found.";
        }

    }
}   
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon"  href="images/unifavicon.ico">
        <title> Login </title>
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
            <form method="POST" action="">
                <label for="username">Username:</label>
                <input type="text" name="username" required><br>

                <label for="password">Password:</label>
                <input type="password" name="password" required><br>

                <button type="submit">Login</button>

                <a href="sign_up.php"> Don't have an account? </a>
            </form>
        </div>
    </body>
</html>