<?php
$servername = "localhost";  // Server database
$username = "root";         // Username database
$password = "";             // Password database
$dbname = "monitoring_die";    // Nama database

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari tabel
$sql = "SELECT * FROM monitoringuniquedie";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}

header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
