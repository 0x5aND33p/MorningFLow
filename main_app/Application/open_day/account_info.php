<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$username = htmlspecialchars($_SESSION['username']);
$email = htmlspecialchars($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Floating button style */
        .floating-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 24px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            cursor: pointer;
            z-index: 1000;
        }

        .account-info {
            position: fixed;
            bottom: 100px;
            right: 30px;
            background-color: white;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 250px;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.4s ease, transform 0.4s ease;
            visibility: hidden;
        }

        .account-info.show {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Welcome, <?php echo $username; ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto">
        <a class="nav-link active" href="#">Home</a>
        <a class="nav-link disabled" href="#" tabindex="-1"><?php echo $email; ?></a>
        <a class="nav-link" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</nav>

<!-- Floating Button -->
<button class="floating-btn" onclick="toggleAccountInfo()">👤</button>

<!-- Animated Account Info -->
<div class="account-info" id="accountInfo">
    <h5>Account Info</h5>
    <p><strong>Username:</strong> <?php echo $username; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
</div>

<script>
    const accountInfo = document.getElementById("accountInfo");
    const toggleButton = document.querySelector(".floating-btn");

    function toggleAccountInfo() {
        accountInfo.classList.toggle("show");
    }

    // Close account info if clicked outside
    document.addEventListener("click", function(event) {
        const isClickInside = accountInfo.contains(event.target) || toggleButton.contains(event.target);

        if (!isClickInside && accountInfo.classList.contains("show")) {
            accountInfo.classList.remove("show");
        }
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
