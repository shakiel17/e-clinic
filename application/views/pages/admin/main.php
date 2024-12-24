
<main id="main" class="main">
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Total Number of Doctors </h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <img src="<?=base_url('design/assets/img/DocAni2.gif');?>" alt="Profile" class="rounded-circle" style="width:130px; height:auto;">
                </div>
                <div class="ps-3 text-center">
                  <h6><?=count($doctors);?></h6>
                  <i class="bi bi-circle-fill" style='color:green'></i> <span class="text-muted small pt-2 ps-1"> Active Doctors</span>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Total Number of Patients</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <!-- <i class="bi bi-people-fill fs-2 text-info"></i> -->
                  <img src="<?=base_url('design/assets/img/patientAni.gif');?>" alt="Profile" class="rounded-circle" style="width:130px; height:auto;">
                </div>
                <div class="ps-3 text-center">
                  <h6><?=$patients['ptCount'];?></h6>
                  <i class="bi bi-circle-fill" style='color:purple'></i><span class="text-muted small pt-2 ps-1">Today's Admission</span>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-xl-12">

          <div class="card info-card customers-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Number of Appointments</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <img src="<?=base_url('design/assets/img/appntAni.gif');?>" alt="Profile" class="rounded-circle" style="width:100px; height:auto;">
                </div>
                <div class="ps-3 text-center">
                  <h6><?=$appntsCount;?></h6>
                  <i class="bi bi-circle-fill" style='color:orange'></i><span class="text-muted small pt-2 ps-1">Scheduled Today</span>
                </div>
              </div>

            </div>
          </div>

        </div><!-- End Customers Card -->

        <!-- Reports -->
        <div class="col-12">
          <div class="card">

            <div class="filter">
              <a class="icon" href="#" id="previousWeekendBtn"><i class="bi bi-arrow-left-circle-fill"></i></a>
              <a class="icon" href="#" id="nextWeekendBtn"><i class="bi bi-arrow-right-circle-fill"></i></a>
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Reports <span>/Today</span></h5>

              <!-- Line Chart -->
              <div id="reportsChart"></div>
            </div>

          </div>
        </div><!-- End Reports -->

        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Recent Appointments <span>| Today</span></h5>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Doctor's Name</th>
                    <th scope="col">Patient's Name</th>
                    <th scope="col">Date of Appointment</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $n = 0;
                    foreach ($appointments as $appnt){
                    ?>
                    <tr>
                      <td><?=$n;?>.</td>
                      <td>DR. <?=$appnt['name'];?> </td>
                      <td><?=$appnt['firstname'];?> <?=substr($appnt['middlename'], 0, 1);?> <?=$appnt['lastname'];?></td>
                      <td><?=$appnt['appointment_date'];?></td>
                      <td><?=$appnt['status'];?></td>
                    </tr>
                    <?php
                      $n++;
                    }
                  ?>
                </tbody>
               
              </table>

            </div>

          </div>
        </div><!-- End Recent Sales -->

        <!-- Top Selling -->
        <div class="col-12">
          <div class="card top-selling overflow-auto">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Active Doctors <span>| Today</span></h5>

              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col"> Doctor's Name</th>
                    <th scope="col"> Specialization</th>
                    <th scope="col"> Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  foreach ($doctors as $doctor){
                  ?>
                  <tr>
                    <th scope="row"><img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($doctor['pic']);?>" alt=""> Dr. <?=$doctor['name'];?></th>
                    <td><?=$doctor['specialization'];?></td>
                    <td></td>
                  </tr>
                  <?php 
                    }
                  ?>
                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Top Selling -->

      </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-4">

      <!-- Recent Activity -->
      <div class="card">
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>

            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
          </ul>
        </div>

        <div class="card-body">
          <h5 class="card-title">Recent Activity <span>| Today</span></h5>
          <div class="activity" id="activity-container"></div>
        </div>
      </div><!-- End Recent Activity -->

      <!-- Budget Report -->
      <div class="card">
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>

            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
          </ul>
        </div>

        <div class="card-body pb-0">
          <h5 class="card-title">Budget Report <span>| This Month</span></h5>

          <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

          <script>
            document.addEventListener("DOMContentLoaded", () => {
              var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                legend: {
                  data: ['Allocated Budget', 'Actual Spending']
                },
                radar: {
                  // shape: 'circle',
                  indicator: [{
                      name: 'Sales',
                      max: 6500
                    },
                    {
                      name: 'Administration',
                      max: 16000
                    },
                    {
                      name: 'Information Technology',
                      max: 30000
                    },
                    {
                      name: 'Customer Support',
                      max: 38000
                    },
                    {
                      name: 'Development',
                      max: 52000
                    },
                    {
                      name: 'Marketing',
                      max: 25000
                    }
                  ]
                },
                series: [{
                  name: 'Budget vs spending',
                  type: 'radar',
                  data: [{
                      value: [4200, 3000, 20000, 35000, 50000, 18000],
                      name: 'Allocated Budget'
                    },
                    {
                      value: [5000, 14000, 28000, 26000, 42000, 21000],
                      name: 'Actual Spending'
                    }
                  ]
                }]
              });
            });
          </script>

        </div>
      </div><!-- End Budget Report -->

      <!-- Website Traffic -->
      <div class="card">
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>

            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
          </ul>
        </div>

        <div class="card-body pb-0">
          <h5 class="card-title">Website Traffic <span>| Today</span></h5>

          <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

          <script>
            document.addEventListener("DOMContentLoaded", () => {
              echarts.init(document.querySelector("#trafficChart")).setOption({
                tooltip: {
                  trigger: 'item'
                },
                legend: {
                  top: '5%',
                  left: 'center'
                },
                series: [{
                  name: 'Access From',
                  type: 'pie',
                  radius: ['40%', '70%'],
                  avoidLabelOverlap: false,
                  label: {
                    show: false,
                    position: 'center'
                  },
                  emphasis: {
                    label: {
                      show: true,
                      fontSize: '18',
                      fontWeight: 'bold'
                    }
                  },
                  labelLine: {
                    show: false
                  },
                  data: [{
                      value: 1048,
                      name: 'Search Engine'
                    },
                    {
                      value: 735,
                      name: 'Direct'
                    },
                    {
                      value: 580,
                      name: 'Email'
                    },
                    {
                      value: 484,
                      name: 'Union Ads'
                    },
                    {
                      value: 300,
                      name: 'Video Ads'
                    }
                  ]
                }]
              });
            });
          </script>

        </div>
      </div><!-- End Website Traffic -->

      <!-- News & Updates Traffic -->
      <div class="card">
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>

            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
          </ul>
        </div>
        
      </div><!-- End News & Updates -->

    </div><!-- End Right side columns -->

  </div>
</section>

</main><!-- End #main -->

<script>
  // Sample data (replace with data fetched from the backend)
const activityData = [
  {
    time: "24 min",
    status: "success",
    content: "Patient A got an appointment with Doc Q"
  },
  {
    time: "56 min",
    status: "danger",
    content: "Patient B's follow-up was delayed"
  },
  {
    time: "1 hr",
    status: "primary",
    content: "Patient C checked out of Room 101"
  }
];

// Function to map status to badge color
const getStatusClass = (status) => {
  switch (status) {
    case "success":
      return "text-success";
    case "danger":
      return "text-danger";
    case "primary":
      return "text-primary";
    case "info":
      return "text-info";
    case "warning":
      return "text-warning";
    default:
      return "text-muted";
  }
};

// Populate activities
const populateActivities = (activities) => {
  const container = document.getElementById("activity-container");
  container.innerHTML = ""; // Clear existing activities

  activities.forEach((activity) => {
    const activityItem = `
      <div class="activity-item d-flex">
        <div class="activite-label">${activity.time}</div>
        <i class="bi bi-circle-fill activity-badge ${getStatusClass(activity.status)} align-self-start"></i>
        <div class="activity-content">
          ${activity.content}
        </div>
      </div>
    `;
    container.insertAdjacentHTML("beforeend", activityItem);
  });
};

// Call the function with sample data
populateActivities(activityData);
</script>

<script>
             document.addEventListener("DOMContentLoaded", () => {
  let today = new Date(); // Current date
  let currentYear = today.getFullYear(); // Get current year

  // Function to get the months of the current year
  function getMonthsOfYear(year) {
    const months = [
      "January", "February", "March", "April", "May", "June", 
      "July", "August", "September", "October", "November", "December"
    ];

    return months.map((month, index) => ({
      month: month,
      date: new Date(year, index, 1).toISOString().slice(0, 10), // Format as YYYY-MM-DD
    }));
  }

  // Function to get the previous year's months
  function getPreviousYearMonths(date) {
    const previousYear = date.getFullYear() - 1; // Previous year
    return getMonthsOfYear(previousYear); // Get months of the previous year
  }

  // Initialize current year view data
  let currentViewData = getMonthsOfYear(currentYear);

  // Initial chart rendering
  function renderChart() {
    new ApexCharts(document.querySelector("#reportsChart"), {
      series: [{
        name: 'Appointments',
        data: currentViewData.map(month => Math.floor(Math.random() * 100) + 20), // Random data for appointments
      }, {
        name: 'Patients',
        data: currentViewData.map(month => Math.floor(Math.random() * 50) + 5), // Random data for patients
      }],
      chart: {
        height: 350,
        type: 'area',
        toolbar: {
          show: false
        },
      },
      markers: {
        size: 4
      },
      colors: ['#2eca6a', '#ff771d'],
      fill: {
        type: "gradient",
        gradient: {
          shadeIntensity: 1,
          opacityFrom: 0.3,
          opacityTo: 0.4,
          stops: [0, 90, 100]
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 2
      },
      xaxis: {
        categories: currentViewData.map(month => month.month), // Display month names (January, February, etc.)
      },
      tooltip: {
        x: {
          formatter: function(value, { seriesIndex, dataPointIndex, w }) {
            return currentViewData[dataPointIndex].date;
          }
        }
      }
    }).render();
  }

  // Check if the button exists before adding the event listener
  const previousYearBtn = document.querySelector("#previousYearBtn");
  if (previousYearBtn) {
    previousYearBtn.addEventListener("click", () => {
      const previousYearMonths = getPreviousYearMonths(today);
      currentViewData = previousYearMonths;

      // Re-render the chart with the previous year's data
      renderChart();
    });
  }

  renderChart(); // Initial render
});
</script>