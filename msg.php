<?php

include('user.php'); // Include your database connection details

$sql = "SELECT * FROM msg";
$query = mysqli_query($con, $sql);

if (!$query) {
    die("Query failed: " . mysqli_error($con));
}

$rows = array();
while ($row = mysqli_fetch_assoc($query)) {
    $rows[] = $row;
}

// Send the data as JSON
header('Content-Type: application/json');
echo json_encode($rows);

// Close the database connection
mysqli_close($con);

?>
