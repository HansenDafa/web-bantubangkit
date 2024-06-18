<?php
// Start session
session_start();

echo "Session status: ";
var_dump($_SESSION);

// Check if user is already logged in
if (isset($_SESSION['admin_name'])) {
    header('location: admin_page.php');
    exit; // Make sure to exit after redirection
}

if(isset($_POST['submit'])){
   // Your login processing code here
   // Make sure to exit after redirection
}

?>
