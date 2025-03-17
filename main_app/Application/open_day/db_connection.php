<?php
    include("password.php");
    function db_connections($password){
        //connect to database

        $conn = new mysqli("localhost", "2362827", 
                $password, "db2362827");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } //else {
        //     echo "Connection to database was successfull!";
        // }

        return $conn;
    }

?>