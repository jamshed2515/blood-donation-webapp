<?php
$servername = "localhost";
$username = "root";
$password = ""; // change if your DB has a password
$dbname = "blood_bank";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch latest 5 donors (you can change the LIMIT if needed)
$sql = "SELECT donor_name, donor_blood FROM donor_details ORDER BY donor_id DESC LIMIT 5";
$result = $conn->query($sql);

$donors = [];

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $donors[] = $row;
  }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($donors);
?>
