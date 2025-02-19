<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-wrap: nowrap;
        }

        .contents {
            flex-grow: 1;
            padding: 20px;
        }

        .nav {
            gap: 20px;
        }

        .content {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            padding: 20px;
            border-radius: 8px;
        }

        .icon-wrapper {
            font-size: 24px;
            color: #007bff;
        }

        h3 {
            font-size: 15px;
            font-weight: 400;
        }

        canvas {
            width: 200px;
        }
    </style>
</head>

<body>
    <!-- Navbar for Mobile Sidebar Trigger -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
                <i class="fas fa-bars"></i> Menu
            </button>
        </div>
    </nav>

    <!-- Offcanvas Sidebar -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu">
        <div class="offcanvas-header">
            <h5>Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="nav flex-column">
                <a class="nav-link" href="#">Home</a>
                <a class="nav-link" href="#">Employee List</a>
                <a class="nav-link" href="#">Leaves Approve</a>
                <a class="nav-link" href="#">Department</a>
                <a class="nav-link" href="#">Profile</a>
            </nav>
        </div>
    </div>

    <?php include('side.php') ?>
    <div class="contents">
        <h1>Welcome to Employee Dashboard</h1>
        <p>This is where the main content goes.</p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-user"></i></span>
                        <h3>Registered Employees</h3>
                    </div>
                    <h4 id="employee-count">Loading...</h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-building"></i></span>
                        <h3>Listed Departments</h3>
                    </div>
                    <h4 id="department-count">Loading...</h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-clipboard-list"></i></span>
                        <h3>Accepted Leave</h3>
                    </div>
                    <h4 id="accepted-leave-count">Loading...</h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-times-circle"></i></span>
                        <h3>Rejected Leave</h3>
                    </div>
                    <h4 id="rejected-leave-count">Loading...</h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-hourglass-half"></i></span>
                        <h3>Pending Leave</h3>
                    </div>
                    <h4 id="pending-leave-count">Loading...</h4>
                </div>
            </div>
        </div>

        <!-- Moved Canvas below the leave list section -->
        <div class="py-5">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function () {
        // Define variables to store the counts
        let employeeCount = 0;
        let departmentCount = 0;
        let acceptedLeaveCount = 0;
        let rejectedLeaveCount = 0;
        let pendingLeaveCount = 0;
        let countReceived = 0; // To track when all counts are fetched
        let myChart = null; // This will hold the chart instance

        // Fetch the employee count when the page loads
        fetchEmployeeCount();
        fetchDepartmentCount();
        fetchAcceptedLeaveCount();
        fetchRejectedLeaveCount();
        fetchPendingLeaveCount();

        // Fetch employee count
        function fetchEmployeeCount() {
            $.ajax({
                url: '../api/get_employee_count.php', // The PHP script to fetch employee count
                method: 'GET',
                success: function (response) {
                    const data = JSON.parse(response);
                    employeeCount = data.count || 0;
                    countReceived++;
                    updateChart();
                },
                error: function () {
                    employeeCount = 0;
                    countReceived++;
                    updateChart();
                }
            });
        }

        // Fetch department count
        function fetchDepartmentCount() {
            $.ajax({
                url: '../api/get_department_count.php', // PHP file to get department count
                method: 'GET',
                success: function (response) {
                    const data = JSON.parse(response);
                    departmentCount = data.count || 0;
                    countReceived++;
                    updateChart();
                },
                error: function () {
                    departmentCount = 0;
                    countReceived++;
                    updateChart();
                }
            });
        }

        // Fetch accepted leave count
        function fetchAcceptedLeaveCount() {
            $.ajax({
                url: '../api/get_accepted_leave_count.php', // PHP file to get accepted leave count
                method: 'GET',
                success: function (response) {
                    const data = JSON.parse(response);
                    acceptedLeaveCount = data.count || 0;
                    countReceived++;
                    updateChart();
                },
                error: function () {
                    acceptedLeaveCount = 0;
                    countReceived++;
                    updateChart();
                }
            });
        }

        // Fetch rejected leave count
        function fetchRejectedLeaveCount() {
            $.ajax({
                url: '../api/get_rejected_leave_count.php', // PHP file to get rejected leave count
                method: 'GET',
                success: function (response) {
                    const data = JSON.parse(response);
                    rejectedLeaveCount = data.count || 0;
                    countReceived++;
                    updateChart();
                },
                error: function () {
                    rejectedLeaveCount = 0;
                    countReceived++;
                    updateChart();
                }
            });
        }

        // Fetch pending leave count
        function fetchPendingLeaveCount() {
            $.ajax({
                url: '../api/get_pending_leave_count.php', // PHP file to get pending leave count
                method: 'GET',
                success: function (response) {
                    const data = JSON.parse(response);
                    pendingLeaveCount = data.count || 0;
                    countReceived++;
                    updateChart();
                },
                error: function () {
                    pendingLeaveCount = 0;
                    countReceived++;
                    updateChart();
                }
            });
        }

        // Function to update the chart after all counts are received
        function updateChart() {
            if (countReceived === 5) { // Check if all counts are received
                // Update the text for each count
                $('#employee-count').text(employeeCount);
                $('#department-count').text(departmentCount);
                $('#accepted-leave-count').text(acceptedLeaveCount);
                $('#rejected-leave-count').text(rejectedLeaveCount);
                $('#pending-leave-count').text(pendingLeaveCount);

                // Destroy the existing chart if it exists
                if (myChart !== null) {
                    myChart.destroy();
                }

                // Create a new chart with the fetched data
                const ctx = document.getElementById('myChart').getContext('2d');
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Registered Employees', 'Listed Departments', 'Accepted Leave', 'Rejected Leave', 'Pending Leave'],
                        datasets: [{
                            label: 'Counts',
                            data: [employeeCount, departmentCount, acceptedLeaveCount, rejectedLeaveCount, pendingLeaveCount],  // Use the dynamic counts here
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgb(16, 92, 15)',
                                'rgb(235, 0, 0)',
                                'rgb(251, 255, 0)'
                            ],
                            
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        }
    });
</script>



</body>

</html>