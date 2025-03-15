<?php 
    session_start();
    session_destroy();
    header('Location: YOUR LOGIN PAGE');
?>