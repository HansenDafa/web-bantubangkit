<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    // Set an alert message
    echo "<script>
    alert('Anda Bukan User!');
    alert('Mohon Lakukan Login Terlebih Dahulu!');
    window.location.href = 'login_form.php'; // Redirect after displaying the alert
  </script>";
  exit(); // Stop script execution
}
