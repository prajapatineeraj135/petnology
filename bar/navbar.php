<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Footer</title>
</head>
<body>
    <nav id="navbar">
        <!-- Home Link -->
        <div class="colum">
            <a href="http://localhost:3000/petnology">Home</a>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- User is logged in, show My Account and Log Out -->
            <div class="colum">
                <a href="http://localhost:3000/petnology/pages/my_account.php">My Account</a>
            </div>
            
            <!-- Tracking Link (always visible) -->
            <div class="colum">
            <a href="http://localhost:3000/petnology/pages/tracking.php">Track</a>
            </div>

            <div class="colum">
                <a href="http://localhost:3000/petnology/auth/logout_code.php">Log Out</a>
            </div>
        <?php else: ?>
            <!-- User is not logged in, show Login and Signup -->
            <div class="colum">
                <a href="http://localhost:3000/petnology/pages/login.php">Login</a>
            </div>
            <div class="colum">
                <a href="http://localhost:3000/petnology/pages/signup.php">SignUp</a>
            </div>

            <!-- Tracking Link (always visible) -->
            <div class="colum">
                <a href="http://localhost:3000/petnology/pages/tracking.php">Track</a>
            </div>
        <?php endif; ?>

        
    </nav>
</body>
</html>
