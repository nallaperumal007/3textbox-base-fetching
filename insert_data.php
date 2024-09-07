<?php
include('connect.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare SQL statement for inserting data into cust_tariff3
    $sql = "INSERT INTO cust_tariff3 (
                cust_brcode, cust_code, name, veh_type, org, dest, rate, km_rate, type, 
                type_name_a1, type_name_a2, type_name_a3
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Count number of rows to insert
    $row_count = count($_POST['org']);

    // Loop through each row of data
    for ($i = 0; $i < $row_count; $i++) {
        // Retrieve data for this row
        $cust_brcode = $_POST['Branch'][$i];
        $cust_code = $_POST['Code'][$i];
        $name = $_POST['name1'][$i];
        $veh_type = $_POST['veh_type'][$i];
        $org = $_POST['org'][$i];
        $dest = $_POST['dest'][$i];
        $rate = $_POST['rate'][$i];
        $km_rate = $_POST['km_rate'][$i];
        $type = $_POST['type'][$i];

        // Default values for type_name columns
        $type_name_a1 = $type_name_a2 = $type_name_a3 = '0';

        // Set type_name values based on the selected type
        if ($type === 'a') {
            $type_name_a1 = $_POST['type_name_a'][0] ?? '0';
            $type_name_a2 = $_POST['type_name_a'][1] ?? '0';
            $type_name_a3 = $_POST['type_name_a'][2] ?? '0';
        } 

        // Bind parameters
        $stmt->bindParam(1, $cust_brcode);
        $stmt->bindParam(2, $cust_code);
        $stmt->bindParam(3, $name);
        $stmt->bindParam(4, $veh_type);
        $stmt->bindParam(5, $org);
        $stmt->bindParam(6, $dest);
        $stmt->bindParam(7, $rate);
        $stmt->bindParam(8, $km_rate);
        $stmt->bindParam(9, $type);
        $stmt->bindParam(10, $type_name_a1);
        $stmt->bindParam(11, $type_name_a2);
        $stmt->bindParam(12, $type_name_a3);

        // Execute the query
        if ($stmt->execute()) {
            echo "New record created successfully for row $i<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $stmt->errorInfo()[2];
        }
    }

    // Close the statement cursor
    $stmt->closeCursor();
}

// Close the connection
$conn = null;
?>
