<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Login</title>

</head>
<body>
<div id="navbar"></div> <!--  this is nav bar dont remove this -->


<div id="form">
    <!-- There Is Loging Form For User  -->
    <form action="#" id="login_form" method="POST">
        
        <?php include '../auth/login_code.php'; ?>
         <h2>Login</h2><hr>
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="input"><br>
        
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="input"><br>
        <a href="forget_password.php">Forget Pasword</a><br>
        <input type="submit" name="login" id="btn" value="Login">  
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