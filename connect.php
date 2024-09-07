<?php
$servername = "localhost";
$username = "root";  // Default XAMPP username
$password = "";    // Default XAMPP password is empty
$dbname = "csdexpre_trip";


//$servername = "localhost";
//$username = "csdexpre_tuser";
//$password = "Trip100*";
//$db_name="csdexpre_trip";


try {
    // Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo ""; 
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
