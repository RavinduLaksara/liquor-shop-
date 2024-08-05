<?php
session_start(); // Start the session

include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Use prepared statements to prevent SQL injection
$supplier_query = $conn->prepare("SELECT * FROM supplier WHERE email = ?");
$supplier_query->bind_param("s", $email);
$supplier_query->execute();
$supplier_result = $supplier_query->get_result();

$user_query = $conn->prepare("SELECT * FROM registered_user WHERE email = ?");
$user_query->bind_param("s", $email);
$user_query->execute();
$user_result = $user_query->get_result();

if ($supplier_result->num_rows > 0) {
    $supplier = $supplier_result->fetch_assoc();
    if (password_verify($password, $supplier['password'])) {
        $_SESSION['user_id'] = $supplier['id'];
        $_SESSION['user_type'] = 'supplier'; // Store user type
        header("Location: supplier_dashboard.html"); // Redirect to supplier dashboard
        exit();
    } else {
        echo "Invalid password";
    }
} elseif ($user_result->num_rows > 0) {
    $user = $user_result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = 'user'; // Store user type
        header("Location: user_dashboard.html"); // Redirect to user dashboard
        exit();
    } else {
        echo "Invalid password";
    }
} else {
    echo "No account found with this email";
}

mysqli_close($conn);
?>
