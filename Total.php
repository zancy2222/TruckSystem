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
    <div class="text">Total Earnings and Trips</div>

    <form action="#" method="post" class="report-form">
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

        <button type="submit">Generate Report</button>
    </form>

    <table class="trip-table">
        <thead>
        <tr>
            <th>Plate Number</th>
            <th>Total Earnings</th>
            <th>Total Trips</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Include the database connection
        include 'Partials/dbConn.php';

        // Fetch total earnings and trips for each plate number
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selectedMonth = $_POST['month'];
            $selectedYear = $_POST['year'];

            $sql = "SELECT tm.PlateNumber, SUM(tm.Rate) AS TotalEarnings, COUNT(*) AS TotalTrips
                    FROM tripmonitor tm
                    WHERE MONTH(tm.DeliveryDate) = $selectedMonth AND YEAR(tm.DeliveryDate) = $selectedYear
                    GROUP BY tm.PlateNumber";

            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $plateNumber = $row['PlateNumber'];
                    $totalEarnings = $row['TotalEarnings'];
                    $totalTrips = $row['TotalTrips'];

                    // Get total repair cost for the plate number
                    $sqlRepair = "SELECT SUM(Cost) AS TotalRepairCost FROM repairexpenses WHERE PlateNumber = '$plateNumber'";
                    $resultRepair = mysqli_query($conn, $sqlRepair);
                    $rowRepair = mysqli_fetch_assoc($resultRepair);
                    $totalRepairCost = $rowRepair['TotalRepairCost'];

                    // Calculate net earnings
                    $netEarnings = $totalEarnings - $totalRepairCost;

                    echo "<tr>";
                    echo "<td>{$plateNumber}</td>";
                    echo "<td>{$netEarnings}</td>";
                    echo "<td>{$totalTrips}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No data available</td></tr>";
            }
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