<?php
// Include the database connection
include 'dbConn.php';

// Fetch data from the Truck table to get plate numbers
$sql = "SELECT PlateNumber, COUNT(*) AS count FROM TripMonitor GROUP BY PlateNumber";
$result = mysqli_query($conn, $sql);

// Prepare data for the pie chart
$plateNumbersData = [];
$plateNumbersLabels = [];
$colors = [];

// Generate random colors
function generateRandomColor() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

while ($row = mysqli_fetch_assoc($result)) {
    $plateNumbersData[] = $row['count'];
    $plateNumbersLabels[] = $row['PlateNumber'];
    $colors[] = generateRandomColor();
}

// Close the database connection
mysqli_close($conn);

// Return data as JSON
echo json_encode([
    'plateNumbersData' => $plateNumbersData,
    'plateNumbersLabels' => $plateNumbersLabels,
    'colors' => $colors,
]);
?>
