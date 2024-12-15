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
    
    <form action="../auth/login_code.php" id="login_form" method="POST">

    <?php
             session_start();
            if (isset($_SESSION['error'])) {
                echo "<strong style='color: red; content-align: center;'>" . htmlspecialchars($_SESSION['error']) . "</strong>";
                unset($_SESSION['error']); // Clear the error message after it's displayed
            }

            if (isset($_GET['message']) && $_GET['message'] == 'verified') 
            {
            echo "<div class='alert alert-success'><stron>Your Account Verified Successfully</strong></div>";
            }

            if (isset($_GET['message']) && $_GET['message'] == 'reset') 
            {
            echo "<div class='alert alert-success'><strong>Your Password Reset Succefully</strong></div>";
            }

            if (isset($_GET['message']) && $_GET['message'] == 'mail') 
            {
            echo "<div class='alert alert-success'><strong>Reset link sent to your email</strong></div>";
            }
    ?>
        
         <h2>Login</h2> <hr>
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