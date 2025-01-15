<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Signup</title>

</head>
<body>
<div id="navbar"></div> <!--  this is nav bar dont remove this -->
               
<div id="form">
    <!-- This Is Form For  user Signup   -->
    <form action="" id="signup_form" method="POST">
        <?php include "../auth/signup_code.php"; ?>
        <h2>Signup</h2><hr>
        <label for="full name" >Full Name:</label><br>
        <input type="text" name="name" id="input" required><br>


        <label for="contact">Contact:</label><br>
        <input type="text" name="contact" id="input" required pattern="[0-9]{10}" title="Please enter a valid 10-digit phone number"><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" id="input" required><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" placeholder="Password" 
        pattern="(?=.*[A-Z])(?=.*[@$&*])(?=.*[0-9])[A-Za-z\d@$&*]+" 
        title="Password must contain at least 1 capital letter, 1 special character (@, $, &, *), and 1 number (1-9)." 
        required><br> 
    
        <!-- Toggle password visibility checkbox -->
        <input type="checkbox" id="togglePassword"> Show Password<br><br>

        <p id="password-error" style="color: red; display: none;">Passwords do not match!</p>

        <input type="submit" name="signup" id="btn" value="SignUp"><br><br>
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



            // Toggle password visibility
            document.getElementById('togglePassword').addEventListener('change', function() {
            const password = document.getElementById('password');
            const confirm_password = document.getElementById('confirm_password');
            const type = this.checked ? 'text' : 'password';
            password.type = type;
            confirm_password.type = type;
            });

            
            </script>