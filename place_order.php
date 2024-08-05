<?php
include 'db.php';

$user_id = $_POST['user_id'];
$bottle_id = $_POST['bottle_id'];
$quantity = $_POST['quantity'];

$sql = "INSERT INTO orders (user_id, bottle_id, quantity) VALUES ('$user_id', '$bottle_id', '$quantity')";

if (mysqli_query($conn, $sql)) {
    echo "Order placed successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
