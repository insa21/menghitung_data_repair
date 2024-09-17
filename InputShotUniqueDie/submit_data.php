<?php
$servername = "localhost"; // Change to your server name
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "monitoring_die";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$shift = $_POST['shift'];
$mesin_dc = $_POST['mesin_dc'];
$general_die = $_POST['general_die'];
$tanggal = $_POST['tanggal'];
$unique_die = $_POST['unique_die'];
$value_die = $_POST['value_die'];
$total_shot = $_POST['total_shot'];

// Insert data into the database
$sql = "INSERT INTO unique_die_shots (shift, mesin_dc, general_die, tanggal, unique_die, value_die, total_shot)
        VALUES ('$shift', '$mesin_dc', '$general_die', '$tanggal', '$unique_die', '$value_die', $total_shot)";

if ($conn->query($sql) === TRUE) {
  echo "<script>alert('Data berhasil disimpan!'); window.location.href = '../index.html';</script>";
} else {
  echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
}

$conn->close();
