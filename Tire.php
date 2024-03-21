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

.wheel-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

.wheel-table th,
.wheel-table td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

.wheel-table th {
    background-color: #11101D;
    color: white;
}

.wheel-table tbody tr:hover {
    background-color: #f5f5f5;
}

.wheel-table td:last-child {
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
    <div class="text">Tire Section</div>

    <table class="wheel-table">
        <thead>
            <tr>
                <th>Wheel ID</th>
                <th>Supplier</th>
                <th>Date Delivered</th>
                <th>Sales Invoice</th>
                <th>Tire Price</th>
                <th>Received By</th>
                <th>Brand</th>
                <th>Tire Size</th>
                <th>Tire Serial</th>
                <th>Location</th>
                <th>Transaction Date</th>
                <th>Plate Number</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include the database connection
            include 'Partials/dbConn.php';

            // Fetch data from the WheelModule table
            $sql = "SELECT * FROM WheelModule";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['WheelID']}</td>";
                    echo "<td>{$row['Supplier']}</td>";
                    echo "<td>{$row['DateDelivered']}</td>";
                    echo "<td>{$row['SalesInvoice']}</td>";
                    echo "<td>{$row['TirePrice']}</td>";
                    echo "<td>{$row['ReceivedBy']}</td>";
                    echo "<td>{$row['Brand']}</td>";
                    echo "<td>{$row['TireSize']}</td>";
                    echo "<td>{$row['TireSerial']}</td>";
                    echo "<td>{$row['Location']}</td>";
                    echo "<td>{$row['TransactionDate']}</td>";
                    echo "<td>{$row['PlateNumber']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='12'>No data available</td></tr>";
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