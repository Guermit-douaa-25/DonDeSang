<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "don_de_sang");

if ($conn->connect_error) {
    echo json_encode(["status" => "db_error"]);
    exit;
}

if (
    empty($_POST['name']) ||
    empty($_POST['email']) ||
    empty($_POST['phone']) ||
    empty($_POST['blood']) ||
    empty($_POST['wilaya']) ||
    empty($_POST['quantity'])
) {
    echo json_encode(["status" => "missing"]);
    exit;
}

$name     = $_POST['name'];
$email    = $_POST['email'];
$phone    = $_POST['phone'];
$blood    = $_POST['blood'];
$wilaya   = $_POST['wilaya'];
$quantity = $_POST['quantity'];

$sql = "INSERT INTO demandes (name,email,phone,blood,wilaya,quantity)
        VALUES ('$name','$email','$phone','$blood','$wilaya','$quantity')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "sql_error", "error" => $conn->error]);
}

$conn->close();
?>