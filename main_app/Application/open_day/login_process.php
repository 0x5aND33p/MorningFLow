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

    

?>