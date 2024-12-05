<?php
// Start the session to track the logged-in user
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

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
        <form action="#" id="track_form">
            <h2>Track Your Shipment Here</h2><hr>
            <label for="shipment">Enter Shipment Id</label><br>
            <input type="text" name="shipment" id="input"><br>
            <input type="submit" name="track" id="btn" value="Track">       
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