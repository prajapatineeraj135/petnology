<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Forget Password</title>

</head>
<body>
<div id="navbar"></div> <!--  this is nav bar dont remove this -->
   
<!-- There Is Loging Form For User  -->

        
        <div id="form">
        <form action="../auth/forget_password_code.php" method="POST" id="login_form">
        <h2>Recover Your Password</h2>
        <label for="email">Enter your email:</label>
        <input type="email" name="email" id="input" required>
        <button type="submit" id="btn">Reset</button>
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