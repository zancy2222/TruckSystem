<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="assets/style.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <!-- Material Icons -->    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>

     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
.charts {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-top: 60px;
  }
  
  .charts-card {
    background: linear-gradient(to right, #153B5F, #FF9D1E);
    margin-bottom: 20px;
    padding: 25px;
    box-sizing: border-box;
    -webkit-column-break-inside: avoid;
    border-radius: 5px;
    box-shadow: 0 6px 7px -4px rgba(0, 0, 0, 0.2);
    color: white; /* Adjust text color for better visibility */
}


  
  .chart-title {
    display: flex;
    align-items: center;
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
    <div class="text">Graph</div>
    <div class="charts">

<div class="charts-card">
  <h2 class="chart-title">Destination</h2>
  <div id="bar-chart"></div>
</div>

<div class="charts-card">
  <h2 class="chart-title">Plate Numbers</h2>
  <div id="pie-chart"></div>
</div>


</div>
  </section>




  <script src="Assets/index.js"></script>
    <script>
// Fetch data for the bar chart from PHP using AJAX
fetch('partials/get_destinations.php')
    .then(response => response.json())
    .then(data => {
        const barChartOptions = {
            series: [{
                data: data.destinationsData,
                name: 'Destinations', // Changed name to Destinations
            }],
            chart: {
                type: 'bar',
                background: 'transparent',
                height: 350,
                toolbar: {
                    show: false,
                },
            },
            colors: data.colors, // Use colors generated from PHP
            plotOptions: {
                bar: {
                    distributed: true,
                    borderRadius: 4,
                    horizontal: false,
                    columnWidth: '40%',
                },
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            grid: {
                borderColor: '#55596e',
                yaxis: {
                    lines: {
                        show: true,
                    },
                },
                xaxis: {
                    lines: {
                        show: true,
                    },
                },
            },
            legend: {
                labels: {
                    colors: '#f5f7ff',
                },
                show: true,
                position: 'top',
            },
            stroke: {
                colors: ['transparent'],
                show: true,
                width: 2,
            },
            tooltip: {
                shared: true,
                intersect: false,
                theme: 'dark',
            },
            xaxis: {
                categories: data.destinationsLabels, // Use destinations labels from PHP
                title: {
                    style: {
                        color: '#f5f7ff',
                    },
                },
                axisBorder: {
                    show: true,
                    color: '#55596e',
                },
                axisTicks: {
                    show: true,
                    color: '#55596e',
                },
                labels: {
                    style: {
                        colors: '#f5f7ff',
                    },
                },
            },
            yaxis: {
                title: {
                    text: 'Count',
                    style: {
                        color: '#f5f7ff',
                    },
                },
                axisBorder: {
                    color: '#55596e',
                    show: true,
                },
                axisTicks: {
                    color: '#55596e',
                    show: true,
                },
                labels: {
                    style: {
                        colors: '#f5f7ff',
                    },
                },
            },
        };

        const barChart = new ApexCharts(
            document.querySelector('#bar-chart'),
            barChartOptions
        );
        barChart.render();
    })
    .catch(error => console.error('Error fetching data:', error));

  
  
// Fetch data for the pie chart from PHP using AJAX
fetch('partials/get_plate_numbers.php') // Change the URL to match the PHP script for plate numbers
    .then(response => response.json())
    .then(data => {
        const pieChartOptions = {
            series: data.plateNumbersData, // Use plate numbers data from PHP
            chart: {
                type: 'pie',
                background: 'transparent',
                height: 350,
            },
            labels: data.plateNumbersLabels, // Use plate numbers labels from PHP
            colors: data.colors, // Use colors generated from PHP
            legend: {
                labels: {
                    colors: '#f5f7ff',
                },
                show: true,
                position: 'bottom',
            },
            tooltip: {
                shared: true,
                intersect: false,
                theme: 'dark',
            },
        };

        const pieChart = new ApexCharts(
            document.querySelector('#pie-chart'),
            pieChartOptions
        );
        pieChart.render();
    })
    .catch(error => console.error('Error fetching data:', error));


  
  
  document.addEventListener('DOMContentLoaded', function () {
    var dropdown = document.getElementById('customerDropdown');
    var dropdownMenu = dropdown.querySelector('.dropdown-menu');

    dropdown.addEventListener('click', function (event) {
        event.stopPropagation(); // Prevent the window click event from immediately closing the dropdown

        if (dropdownMenu.style.display === 'block') {
            dropdownMenu.style.display = 'none';
        } else {
            dropdownMenu.style.display = 'block';
        }
    });

    // Close the dropdown if the user clicks outside of it
    window.addEventListener('click', function () {
        dropdownMenu.style.display = 'none';
    });
});

    </script>
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