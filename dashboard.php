<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

echo "<h2>Welcome, " . htmlspecialchars($_SESSION['user_name']) . "!</h2>";
echo "<a href='logout.php'>Logout</a>";
?>
