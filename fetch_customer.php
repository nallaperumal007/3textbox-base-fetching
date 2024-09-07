<?php
// Include your database connection script
include('connect.php');

// Query to fetch customer data
$sql = "SELECT cust_name, brcode, cust_code FROM customer";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Fetch all customer data as associative array
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output JSON format response
header('Content-Type: application/json');
echo json_encode($customers);
?>
