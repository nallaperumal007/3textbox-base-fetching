<?php
// Include your database connection script
include('connect.php');

// Query to fetch city and brcode from the branch table
$sql = "SELECT brcode, city FROM branch";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Fetch all cities with brcode as associative array
$branches = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output JSON format response
header('Content-Type: application/json');
echo json_encode($branches);
?>
