<?php
session_start(); // Start the session
session_destroy(); // Destroy the session
header("Location: ../"); // Redirect to login page
exit;
?>