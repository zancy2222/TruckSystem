<?php
// Include the database connection
include 'dbConn.php';

// Fetch data from the TripMonitor table to get destinations
$sql = "SELECT Destination, COUNT(*) AS count FROM TripMonitor GROUP BY Destination";
$result = mysqli_query($conn, $sql);

// Prepare data for the bar chart
$destinationsData = [];
$destinationsLabels = [];
$colors = [];

// Generate random colors
function generateRandomColor() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

while ($row = mysqli_fetch_assoc($result)) {
    $destinationsData[] = $row['count'];
    $destinationsLabels[] = $row['Destination'];
    $colors[] = generateRandomColor();
}

// Close the database connection
mysqli_close($conn);

// Return data as JSON
echo json_encode([
    'destinationsData' => $destinationsData,
    'destinationsLabels' => $destinationsLabels,
    'colors' => $colors,
]);
?>
