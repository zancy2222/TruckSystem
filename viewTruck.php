<?php
// Include the database connection
include 'Partials/dbConn.php';

// SQL query to retrieve data from the Truck table
$sql = "SELECT * FROM Truck";
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
        
        .truck-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        
        .truck-table th,
        .truck-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        
        .truck-table th {
            background-color: #11101D;
            color: white;
        }
        
        .truck-table tbody tr:hover {
            background-color: #f5f5f5;
        }
        
        .truck-table td:last-child {
            display: flex;
            gap: 10px;
            justify-content: center; 
        }
        
        .update-link,
        .delete-link {
            padding: 8px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        .update-link {
            background-color: #3498db;
            color: #fff;
        }
        
        .update-link:hover {
            background-color: #2980b9;
        }
        
        .delete-link {
            background-color: #e74c3c;
            color: #fff;
        }
        
        .delete-link:hover {
            background-color: #c0392b;
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
  
     <li class="profile">
         
     </li>
    </ul>
  </div>
  
  <section class="home-section">
    <div class="text">View Trucks</div>
    <table class="truck-table">
        <thead>
            <tr>
                <th>PLATE NUMBER</th>
                <th>TRUCK TYPE</th>
                <th>TRUCK MAKE</th>
                <th>ENGINE NUMBER</th>
                <th>CHASSIS NUMBER</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through the result set and generate table rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['PlateNumber']}</td>";
                echo "<td>{$row['TruckType']}</td>";
                echo "<td>{$row['TruckMake']}</td>";
                echo "<td>{$row['EngineNumber']}</td>";
                echo "<td>{$row['ChassisNumber']}</td>";
                echo "<td>
                        <a href='#' class='update-link'>UPDATE</a>
                        <a href='#' class='delete-link'>DELETE</a>
                      </td>";
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
// Close the database connection
mysqli_close($conn);
?>