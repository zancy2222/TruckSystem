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
       <a href="graphs.php">
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
     <li>
       <a href="Total.php">
       <i class='bx bx-money'></i>
       <span class="links_name">Total Earnings</span>
       </a>
       <span class="tooltip">Total Earnings</span>
     </li>
     <li>
       <a href="Tire.php">
       <i class='bx bxs-car-mechanic'></i>
       <span class="links_name">Wheel Module</span>
       </a>
       <span class="tooltip">Wheel Module</span>
     </li>

     <li>
       <a href="Fuel.php">
       <i class='bx bxs-gas-pump'></i>
       <span class="links_name">Fuel Module</span>
       </a>
       <span class="tooltip">Fuel Module</span>
     </li>
  
     <li class="profile">
         
     </li>
    </ul>
  </div>

  <section class="home-section">
    <div class="text">Generate reports</div>

    <form action="#" method="post" class="report-form">
        <!-- Checkbox to select all clients -->
        <label for="selectAllClients">Select all clients:</label>
        <input type="checkbox" id="selectAllClients" name="selectAllClients">

        <!-- Select client name -->
        <label for="client">Select Client Name:</label>
        <select name="client" id="client">
            <?php
            include 'Partials/dbConn.php';

            // Fetch unique client names from the TripMonitor table
            $sql = "SELECT DISTINCT ClientName FROM TripMonitor";
            $result = mysqli_query($conn, $sql);

            // Populate the dropdown menu with client names
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $clientName = $row['ClientName'];
                    echo "<option value='$clientName'>$clientName</option>";
                }
            }
            ?>
        </select>

        <!-- Select year -->
        <label for="year">Select Year:</label>
        <select name="year" id="year">
            <?php
            $startYear = 2020;
            $endYear = 2030;

            for ($year = $startYear; $year <= $endYear; $year++) {
                echo "<option value='$year'>$year</option>";
            }
            ?>
        </select>

        <!-- Checkbox to select all months -->
        <label for="selectAllMonths">Select all months on this year:</label>
        <input type="checkbox" id="selectAllMonths" name="selectAllMonths">

        <!-- Select individual month -->
        <label for="month">Select Month:</label>
        <select name="month" id="month">
            <?php
            $months = [
                1 => 'January',
                2 => 'February',
                3 => 'March',
                4 => 'April',
                5 => 'May',
                6 => 'June',
                7 => 'July',
                8 => 'August',
                9 => 'September',
                10 => 'October',
                11 => 'November',
                12 => 'December'
            ];

            foreach ($months as $monthNumber => $monthName) {
                echo "<option value='$monthNumber'>$monthName</option>";
            }
            ?>
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
            include 'Partials/dbConn.php';
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $selectedYear = $_POST['year'];

                // Check if "Select all months" checkbox is checked
                if (isset($_POST['selectAllMonths'])) {
                    // Generate reports for all months of the selected year
                    $sql = "SELECT * FROM TripMonitor WHERE YEAR(DeliveryDate) = $selectedYear";
                } else {
                    // If not checked, generate report for the selected month and year
                    $selectedMonth = $_POST['month'];
                    $sql = "SELECT * FROM TripMonitor WHERE MONTH(DeliveryDate) = $selectedMonth AND YEAR(DeliveryDate) = $selectedYear";
                }

                // Fetch data based on selected client name(s)
                if (isset($_POST['selectAllClients'])) {
                    // Select all clients
                    $sql .= " GROUP BY ClientName";
                } else {
                    // Select individual client
                    $selectedClient = $_POST['client'];
                    $sql .= " AND ClientName = '$selectedClient'";
                }

                $result = mysqli_query($conn, $sql);

                // Initialize variables for total rate earnings, highest and lowest trips
                $totalRateEarnings = 0;
                $locationTrips = [];
                $sourceTrips = [];
                $totalTrips = 0;

                if (mysqli_num_rows($result) > 0) {
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

                        $totalRateEarnings += $row['Rate'];

                        $source = trim($row['Source']);
                        $destinations = explode(',', $row['Destination']);
                        foreach ($destinations as $destination) {
                            $destination = trim($destination);
                            $location = $source . ' to ' . $destination;
                            if (empty($locationTrips[$location])) {
                                $locationTrips[$location] = 1;
                            } else {
                                $locationTrips[$location]++;
                            }
                        }

                      
                        if (empty($sourceTrips[$source])) {
                            $sourceTrips[$source] = 1;
                        } else {
                            $sourceTrips[$source]++;
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
                } else {
                    echo "<tr><td colspan='7'>No records found</td></tr>";
                }

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