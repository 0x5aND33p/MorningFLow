<?php
    session_start(); // Start the session
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session

    // Redirect to login or home page after logging out
    header("Location: index.php");
    exit();
?>