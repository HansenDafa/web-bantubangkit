<?php
// Set the session timeout to 1 hour (3600 seconds)
$timeout = 3600;

// Check if the session variable for last activity time is set
if (isset($_SESSION['last_activity'])) {
    // Calculate the time since the last activity
    $elapsed_time = time() - $_SESSION['last_activity'];

    // If elapsed time is greater than the timeout, destroy the session
    if ($elapsed_time > $timeout) {
        session_unset();    // Unset all session variables
        session_destroy();  // Destroy the session data

        // Display an alert before redirecting
        echo 
        "<script>alert('Session has timed out. Please log in again.');
        window.location.href = 'login_form.php'</script>";

    }
}

// Update the last activity time
$_SESSION['last_activity'] = time();
