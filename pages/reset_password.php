<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Reset Password</title>

</head>
<body>
<div id="navbar"></div> <!--  this is nav bar dont remove this -->




    
    <div id="form">
    <form action="../auth/reset_password_code.php" method="POST" id="login_form">
        <h2>Reset Password</h2>
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>"><br>
        <label for="password">New Password:</label>
        <input type="password" name="password" id="input" required><br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="input" required>
        <button type="submit" id="btn">Reset Now</button>
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

    fetch("../bar/navbar.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navbar").innerHTML = data;
    });    

</script>