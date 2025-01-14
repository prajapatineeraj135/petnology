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
        <input type="password" name="password" id="input" placeholder="Password" required ><br>
        <input type="password" name="password" id="input" placeholder="Conferm Password" required><br>
        
        <input type="submit" name="signup" id="btn" value="Signup"><br><br>
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