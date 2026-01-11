<?php
$conn = new mysqli("localhost", "root", "", "don_de_sang");
if ($conn->connect_error) exit("Erreur DB");

$sql = "SELECT * FROM demandes ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['blood']}</td>
                <td>{$row['wilaya']}</td>
                <td>{$row['quantity']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>Aucune demande</td></tr>";
}

$conn->close();
?>