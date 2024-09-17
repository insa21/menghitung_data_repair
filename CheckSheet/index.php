<?php
// Database connection
$servername = "localhost";
$username = "root";  // replace with your db username
$password = "";      // replace with your db password
$dbname = "monitoring_die";  // replace with your db name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data from unique_die_shots
$sql = "SELECT shift, mesin_dc, general_die, tanggal, unique_die, value_die, total_shot FROM unique_die_shots ORDER BY unique_die, value_die ASC";
$result = $conn->query($sql);

// Initialize array to store total shots for each Unique Die
$unique_die_totals = array();

// HTML starts
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Sheet Total Unique Die</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            display: flex;
            justify-content: space-between;
            margin: 20px auto;
            max-width: 1200px;
        }
        .left-table, .right-table {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
        }
        .left-table {
            width: 70%;
        }
        .right-table {
            width: 25%;
            margin-left: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        td {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .summary-table th {
            background-color: #4CAF50;
            color: white;
        }
        .summary-table td {
            background-color: #f9f9f9;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Main Check Sheet Table -->
    <div class="left-table">
        <h1>Check Sheet Total Unique Die</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Shift</th>
                    <th>Mesin DC</th>
                    <th>General Die</th>
                    <th>Tanggal</th>
                    <th>Unique Die N</th>
                    <th>Value Die</th>
                    <th>Total Shot</th>
                </tr>
            </thead>
            <tbody>';

// Fetch data from database and output rows in table
$no = 1;
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo '
        <tr>
            <td>' . $no++ . '</td>
            <td>' . $row["shift"] . '</td>
            <td>' . $row["mesin_dc"] . '</td>
            <td>' . $row["general_die"] . '</td>
            <td>' . date("d/m/Y", strtotime($row["tanggal"])) . '</td>
            <td>' . $row["unique_die"] . '</td>
            <td>' . $row["value_die"] . '</td>
            <td>' . $row["total_shot"] . '</td>
        </tr>';

    // Calculate total shots per Unique Die
    if (isset($unique_die_totals[$row["unique_die"]])) {
      $unique_die_totals[$row["unique_die"]] += $row["total_shot"];
    } else {
      $unique_die_totals[$row["unique_die"]] = $row["total_shot"];
    }
  }
} else {
  echo '<tr><td colspan="8">No data available</td></tr>';
}

echo '
            </tbody>
        </table>
    </div>';

// Summary table for total shots
echo '
    <!-- Total Shot Summary Table -->
    <div class="right-table">
        <table class="summary-table">
            <thead>
                <tr>
                    <th>Total Shot</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>';

// Display total shots for each Unique Die
ksort($unique_die_totals); // Sort by Unique Die (UDN1, UDN2, etc.)
foreach ($unique_die_totals as $unique_die => $total_shot) {
  echo '
    <tr>
        <td>Total Shot ' . $unique_die . '</td>
        <td>' . $total_shot . '</td>
    </tr>';
}

echo '
            </tbody>
        </table>
    </div>
</div>

</body>
</html>';

$conn->close();
