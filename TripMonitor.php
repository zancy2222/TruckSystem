<?php
include 'Partials/dbConn.php';
$sql = "SELECT * FROM TripMonitor";
$result = mysqli_query($conn, $sql);
?>
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
    <div class="text">Trip Monitor</div>
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
            }
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

<?php
mysqli_close($conn);
?>