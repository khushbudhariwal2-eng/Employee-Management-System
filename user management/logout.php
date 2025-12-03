<?php
session_start();
include 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('You are not logged in.');
        window.location.href = 'login.php';
    </script>";
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    session_unset();
    session_destroy();

    echo "<script>
        alert('You are logged out. Please login again to access your profile.');
        window.location.href = 'login.php';
    </script>";
    exit();
} else {
    echo "<script>
        alert('Error deleting record: " . addslashes($conn->error) . "');
        window.location.href = 'login.php';
    </script>";
}

$stmt->close();
$conn->close();
?>
