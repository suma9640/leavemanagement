<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Homepage</title>
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
            background-color: #f4f4f4;
        }

        .contents {
            flex-grow: 1;
            padding: 20px;
        }

        .content {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            padding: 20px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
        }

        .icon-wrapper {
            font-size: 24px;
            color: #007bff;
        }

        h3 {
            font-size: 15px;
            font-weight: 400;
            color: #333;
        }

        h4 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        p {
            font-size: 16px;
            color: #555;
        }

        .leave-summary {
            box-shadow: rgba(0, 0, 0, 0.25) 0px 5px 20px;
            padding: 25px;
            border-radius: 12px;
            background-color: #f9f9f9;
            text-align: center;
            min-height: 250px;
        }

        .leave-summary h4 {
            font-size: 22px;
            color: #007bff;
        }

        .leave-summary p {
            font-size: 18px;
            color: #555;
            margin: 10px 0;
        }

        canvas {
            width: 100%;
            height: 400px; /* Set a fixed height for the canvas to improve appearance */
            max-width: 100%;
            margin-top: 20px;
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
                <a class="nav-link" href="#">Display Holidays</a>
                <a class="nav-link" href="#">Apply Leave</a>
                <a class="nav-link" href="#">Leave History</a>
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
                <div class="content">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-user"></i></span>
                        <h3>SL (Sick Leave)</h3>
                    </div>
                    <h4>3/10</h4> <!-- Displaying leaves taken/total leaves -->
                </div>
            </div>

            <div class="col-md-4">
                <div class="content">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-building"></i></span>
                        <h3>CL (Casual Leave)</h3>
                    </div>
                    <h4>2/8</h4> <!-- Displaying leaves taken/total leaves -->
                </div>
            </div>

            <div class="col-md-4">
                <div class="content">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-clipboard-list"></i></span>
                        <h3>OD (Official Duty)</h3>
                    </div>
                    <h4>5/15</h4> <!-- Displaying leaves taken/total leaves -->
                </div>
            </div>
        </div>

        <!-- <div class="row g-4 mt-3">
            <div class="col-md-4">
                <div class="content">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-user"></i></span>
                        <h3>CF (Compensatory Leave)</h3>
                    </div>
                    <h4>1/5</h4> 
                </div>
            </div>

            <div class="col-md-4">
                <div class="content">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-building"></i></span>
                        <h3>EL (Earned Leave)</h3>
                    </div>
                    <h4>4/12</h4> 
                </div>
            </div>
        </div> -->

        <!-- Leave Summary Box -->
        <!-- <div class="row g-4 mt-3">
            <div class="col-md-4">
                <div class="leave-summary">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <span class="icon-wrapper me-3"><i class="fas fa-calendar-check"></i></span>
                        <h3>Leave Summary</h3>
                    </div>
                    <h4>Total Leaves: <strong>50</strong></h4>
                    <p>Leaves Taken: <strong>15</strong></p>
                    <p>Leaves Left: <strong>35</strong></p> <!-- Displaying the remaining leaves -->
                <!-- </div> -->
            <!-- </div> -->
        <!-- </div> -->

        <div class="py-5">
            <!-- The canvas element will now take up 100% width and fit the page -->
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const labels = ['SL', 'CL', 'OD',];
        const data = {
            labels: labels,
            datasets: [{
                label: 'Leave Types',
                data: [3, 2, 5,],  // Example data for leaves taken
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                ],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        new Chart(document.getElementById('myChart'), config);
    </script>
</body>

</html>