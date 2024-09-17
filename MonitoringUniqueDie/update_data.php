<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "monitoring_die";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Ambil data yang dikirim dari frontend
$input = json_decode(file_get_contents('php://input'), true);

// Siapkan query update
$sql = "UPDATE monitoringuniquedie SET A1N = ?, B1N = ?, C1N = ?, C2N = ?, C3N = ?, C4N = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiiiii", $input['A1N'], $input['B1N'], $input['C1N'], $input['C2N'], $input['C3N'], $input['C4N'], $input['id']);

// Eksekusi query
if ($stmt->execute()) {
  echo json_encode(["status" => "success"]);
} else {
  echo json_encode(["status" => "error"]);
}

$stmt->close();
$conn->close();
