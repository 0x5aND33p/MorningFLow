<?php
session_start();

// Assuming you have a function to authenticate the user
$user = authenticate_user($username, $password);

if ($user) {
    // User authenticated successfully
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header('Location: PUT YOUR INDEX URL');
} else {
    // Authentication failed
    echo "Invalid username or password.";
}
?>