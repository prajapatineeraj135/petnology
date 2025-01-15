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
    <title>Verify OTP</title>
</head>
<body>


<div id="navbar"></div> <!--  this is nav bar dont remove this -->

    <div id="form">

    

    <form action="check_otp.php" id="login_form" method="POST">
    <?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>
    <h2>Verify OTP</h2>
        <label for="otp">Enter OTP:</label><br>
        <input type="text" name="otp" id="otp" placeholder="Enter the OTP" required><br>
        <input type="submit" id="btn" value="Verify OTP">
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
