<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    
    <title>OTP Login</title>
</head>
<body>
<div id="navbar"></div> <!--  this is nav bar dont remove this -->
 


<div id="form">

   
    

    <form action="../auth/send_otp.php" id="login_form" method="POST">
    <?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>

    <h2>Login with OTP</h2>

        <label for="email">Email:</label><br>
        <input type="email" name="email" id="input" placeholder="Enter your email" required><br>
        <a href="login.php">Login With Password</a><br><br>
        <input type="submit" id="btn" value="Send OTP">
    </form>

</div> 



<div id="footer"></div> <!--  this is footer dont remove this -->
</body>
</html>
<script>
    // import footer file script

    fetch("../bar/footer.html")
        .then(response => response.text())
        .then(data => {
            document.getElementById("footer").innerHTML = data;
        });

    fetch("../bar/navbar.php")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navbar").innerHTML = data;
    });    

</script>