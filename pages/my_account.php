<?php
// Start the session to track the logged-in user
session_start();

// Include the database connection file
include('../auth/connection.php');

// Check if the user is logged in; if not, redirect them to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the logged-in user's ID from the session
$user_id = $_SESSION['user_id'];

// Fetch user details from the 'users' table
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result); // Store user details

// Fetch user address from the 'address' table
$address_query = "SELECT * FROM address WHERE user_id = $user_id";
$address_result = mysqli_query($conn, $address_query);
$address = mysqli_fetch_assoc($address_result); // Store address details

// Fetch pickup address or warehouse details from the 'wherehouse' table
$wherehouse_query = "SELECT * FROM wherehouse WHERE user_id = $user_id";
$wherehouse_result = mysqli_query($conn, $wherehouse_query);
$wherehouse = mysqli_fetch_assoc($wherehouse_result); // Store warehouse details

// If there's no warehouse result, set a default value to prevent the undefined key error
// $warehouse_location = $wherehouse['warehouse_id'] ?? 'Not available';

// Fetch user shipments from the 'shipments' table
$shipment_query = "SELECT * FROM shipments WHERE user_id = $user_id";
$shipment_result = mysqli_query($conn, $shipment_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Petnology Home</title>
</head>
<body>

<div id="navbar"></div> <!-- Navbar will be loaded dynamically -->

<div class="user_details">
    <!-- Sidebar with navigation options -->
    <div class="sidebar">
        <ul>
            <li><a href="?section=details">Details</a></li>
            <li><a href="?section=address">Address</a></li>
            <li><a href="?section=pickup_address">Pickup Address</a></li>
            <li><a href="?section=shipments">Shipments</a></li>
        </ul>
        <!-- Logout button -->
        <form action="../auth/logout_code.php" method="POST">
            <button type="submit">Logout</button>
        </form>
    </div>

    <!-- Main content area that changes based on the selected section -->
    <div class="main-content">
        <?php
        // Determine which section to display based on the URL parameter
        $section = isset($_GET['section']) ? $_GET['section'] : 'details';

        // User details section
        if ($section == 'details') {
            echo "<h2>User Details</h2>";
            echo "<p>User Id: " . $user['id'] . "</p>";
            echo "<p>Name: " . $user['name'] . "</p>";
            echo "<p>Contact: " . $user['contact'] . "</p>";
            echo "<p>Email: " . $user['email'] . "</p>";
            echo "<a href='edit.php?section=details'>Edit</a>";

        // User address section
        } elseif ($section == 'address') {
            echo "<h2>Your Address</h2>";
            echo "<p>Stree1: " . $address['street1'] . "</p>";
            echo "<p>Street2: " . $address['street2'] . "</p>";
            echo "<p>Landmark: " . $address['locality'] . "</p>";
            echo "<p>Pincode: " . $address['pincode'] . "</p>";
            echo "<p>City: " . $address['city'] . "</p>";
            echo "<a href='edit.php?section=address'>Edit</a>";

            
        // Pickup or warehouse address section
        } elseif ($section == 'pickup_address') {
            echo "<h2>Your Pickup Address</h2>";
            echo "<p>Nickname: " . $wherehouse['nickname']  . "</p>";
            echo "<p>Contact Person: " . $wherehouse['name']  . "</p>";
            echo "<p>Contact: " . $wherehouse['phone']  . "</p>";
            echo "<p>Alt Contact: " . $wherehouse['alt_phone']  . "</p>";
            echo "<p>Street 1: " . $wherehouse['street1']  . "</p>";
            echo "<p>Street 2: " . $wherehouse['street2']  . "</p>";
            echo "<p>Landmark: " . $wherehouse['locality']  . "</p>";
            echo "<p>Pincode: " . $wherehouse['pincode']  . "</p>";
            echo "<p>City: " . $wherehouse['city']  . "</p>";

            echo "<a href='edit.php?section=pickup_address'>Edit</a>";
            


        // User shipments section
        } elseif ($section == 'shipments') {
            echo "<h2>All Shipments</h2>";
            if (mysqli_num_rows($shipment_result) > 0) {
                // Display each shipment's details
                while ($shipment = mysqli_fetch_assoc($shipment_result)) {
                    echo "<p>Shipment ID: " . $shipment['shipment_id'] . "  AWS Create: " . $shipment['aws'] . "</p>";
                }
            } else {
                echo "<p>No Shipments Available</p>";
            }
        }
        ?>
    </div>
</div>

<?php
// Close the database connection
mysqli_close($conn);
?>


<div id="footer"></div> <!-- Footer will be loaded dynamically -->

<!-- Script to dynamically load navbar and footer -->
<script>
    // Fetch the footer content and insert it into the footer div
    fetch("../bar/footer.html")
        .then(response => response.text())
        .then(data => {
            document.getElementById("footer").innerHTML = data;
        });

    // Fetch the navbar content and insert it into the navbar div
    fetch("../bar/navbar.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navbar").innerHTML = data;
    });    
</script>

</body>
</html>