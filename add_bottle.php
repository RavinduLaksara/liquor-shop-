<?php
include 'db.php';

$supplier_id = $_POST['supplier_id'];
$name = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

$sql = "INSERT INTO bottles (supplier_id, name, price, quantity) VALUES ('$supplier_id', '$name', '$price', '$quantity')";

if (mysqli_query($conn, $sql)) {
    echo "Bottle added successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
