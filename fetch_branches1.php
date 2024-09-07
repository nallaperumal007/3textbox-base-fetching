<?php
// Include your database connection script
include('connect.php');

// Query to fetch brcode and city from the branch table
$sql = "SELECT brcode, city FROM branch";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Fetch all branches as associative array
$branches = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output JSON format response
header('Content-Type: application/json');
echo json_encode($branches);
?>
