<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="assets/style.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
 .home-section {
            padding: 20px;
        }
        .trip-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .trip-table th,
        .trip-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .trip-table th {
            background-color: #11101D;
            color: white;
        }

        .trip-table tbody tr:hover {
            background-color: #f5f5f5;
        }

        .trip-table td:last-child {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .report-form {
        margin-bottom: 20px;
    }

    .report-form label,
    .report-form select,
    .report-form button {
        margin-right: 10px;
    }
     </style>
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">Truck Management</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="index.php">
            <i class='bx bxs-ambulance'></i>

            <span class="links_name">Add truck</span>
        </a>
         <span class="tooltip">Add trucks</span>
      </li>
      <li>
       <a href="viewTruck.php">
        <i class='bx bxs-truck'></i>
         <span class="links_name">View Truck</span>
       </a>
       <span class="tooltip">View Truck</span>
     </li>
     <li>
      <a href="TripMonitor.php">
       <i class='bx bxs-folder-open'></i>
        <span class="links_name">Trip Monitor</span>
      </a>
      <span class="tooltip">Trip Monitor</span>
    </li>
     <li>
       <a href="#">
         <i class='bx bx-pie-chart-alt-2' ></i>
         <span class="links_name">Analytics</span>
       </a>
       <span class="tooltip">Analytics</span>
     </li>
     <li>
       <a href="generate.php">
        <i class='bx bxs-report' ></i>
         <span class="links_name">Generate Reports</span>
       </a>
       <span class="tooltip">Generate Reports</span>
     </li>
     <li>
       <a href="Repair.php">
        <i class='bx bx-cog'></i>
         <span class="links_name">Repair & Expenses</span>
       </a>
       <span class="tooltip">Repair & Expenses</span>
     </li>
  
     <li class="profile">
         
     </li>
    </ul>
  </div>
  
  <section class="home-section">
        <div class="text">Generate reports</div>

        <form action="#" method="post" class="report-form">
            <label for="reportType">Select Report Type:</label>
            <select name="reportType" id="reportType">
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
            <button type="submit">Generate Report</button>
        </form>

        <table class="trip-table">
            <thead>
                <tr>
                    <th>TRIP ID</th>
                    <th>CLIENT NAME</th>
                    <th>PLATE NUMBER</th>
                    <th>DELIVERY DATE</th>
                    <th>SOURCE</th>
                    <th>DESTINATIONS</th>
                    <th>RATE</th>
                </tr>
            </thead>
            <tbody>
            <?php
// Include the database connection
include 'Partials/dbConn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected report type
    $selectedReportType = $_POST['reportType'];

    // Adjust your SQL query based on the selected report type
    $sql = "SELECT * FROM TripMonitor WHERE ";
    if ($selectedReportType == "monthly") {
        $sql .= "MONTH(DeliveryDate) = MONTH(CURRENT_DATE())";
    } elseif ($selectedReportType == "yearly") {
        $sql .= "YEAR(DeliveryDate) = YEAR(CURRENT_DATE())";
    }

    $result = mysqli_query($conn, $sql);

    // Initialize variables for total rate earnings, highest and lowest trips
    $totalRateEarnings = 0;
    $locationTrips = [];
    $totalTrips = 0;

    // Loop through the result set and generate table rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['TripID']}</td>";
        echo "<td>{$row['ClientName']}</td>";
        echo "<td>{$row['PlateNumber']}</td>";
        echo "<td>{$row['DeliveryDate']}</td>";
        echo "<td>{$row['Source']}</td>";
        echo "<td>{$row['Destination']}</td>";
        echo "<td>{$row['Rate']}</td>";
        echo "</tr>";

        // Calculate total rate earnings
        $totalRateEarnings += $row['Rate'];

        // Process destination information
        $destinations = explode(',', $row['Destination']);
        foreach ($destinations as $destination) {
            $destination = trim($destination);
            if (empty($locationTrips[$destination])) {
                $locationTrips[$destination] = 1;
            } else {
                $locationTrips[$destination]++;
            }
        }

        // Count total trips
        $totalTrips++;
    }

    // Display summary information
    echo "<tr>";
    echo "<td colspan='6'><b>Total Rate Earnings:</b></td>";
    echo "<td><b>{$totalRateEarnings}</b></td>";
    echo "</tr>";

    // Find highest location trip
    $highestLocationTrip = array_search(max($locationTrips), $locationTrips);
    echo "<tr>";
    echo "<td colspan='6'><b>Highest Location Trip:</b></td>";
    echo "<td><b>{$highestLocationTrip} - {$locationTrips[$highestLocationTrip]}</b></td>";
    echo "</tr>";

    // Find lowest location trip
    $lowestLocationTrip = array_search(min($locationTrips), $locationTrips);
    echo "<tr>";
    echo "<td colspan='6'><b>Lowest Location Trip:</b></td>";
    echo "<td><b>{$lowestLocationTrip} - {$locationTrips[$lowestLocationTrip]}</b></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td colspan='6'><b>Total Trips:</b></td>";
    echo "<td><b>{$totalTrips}</b></td>";
    echo "</tr>";
}

// Close the database connection
mysqli_close($conn);
?>
</tbody>
        </table>
    </section>

  <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();
  });

  searchBtn.addEventListener("click", ()=>{ 
    sidebar.classList.toggle("open");
    menuBtnChange(); 
  });

  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
   }
  }
  </script>
</body>
</html>