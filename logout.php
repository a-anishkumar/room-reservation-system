<?php
session_start();
session_unset();
session_destroy();

// Redirect to login or home page
header("Location: login.php"); // Or use index.html if you don't have login
exit;
?>
