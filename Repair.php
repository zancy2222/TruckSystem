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

        .repair-expenses-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .repair-expenses-table th,
        .repair-expenses-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .repair-expenses-table th {
            background-color: #11101D;
            color: white;
        }

        .repair-expenses-table tbody tr:hover {
            background-color: #f5f5f5;
        }

        .repair-expenses-table td:last-child {
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
    <div class="text">Repair and expenses</div>

    <!-- Add the table for Repair and Expenses data -->
    <table class="repair-expenses-table">
        <thead>
            <tr>
                <th>Plate Number</th>
                <th>Expense Date</th>
                <th>Expense Type</th>
                <th>Cost</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include the database connection
            include 'Partials/dbConn.php';

            // Select data from RepairExpenses table
            $sql = "SELECT * FROM RepairExpenses";
            $result = mysqli_query($conn, $sql);

            // Display data in the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['PlateNumber']}</td>";
                echo "<td>{$row['ExpenseDate']}</td>";
                echo "<td>{$row['ExpenseType']}</td>";
                echo "<td>{$row['Cost']}</td>";
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