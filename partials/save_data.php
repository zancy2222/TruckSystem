<?php
// Include the database connection
include 'dbConn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $plateNumber = $_POST['plateNumber'];
    $truckType = $_POST['truckType'];
    $truckMake = $_POST['truckMake'];
    $engineNumber = $_POST['engineNumber'];
    $chassisNumber = $_POST['chassisNumber'];

    // SQL query to insert data into the Truck table
    $sql = "INSERT INTO Truck (PlateNumber, TruckType, TruckMake, EngineNumber, ChassisNumber) 
            VALUES ('$plateNumber', '$truckType', '$truckMake', '$engineNumber', '$chassisNumber')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
