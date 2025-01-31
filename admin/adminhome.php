<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sidebar</title>
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
        canvas{
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
                <a class="nav-link" href="#">Approve/Cancel Leave</a>
                <a class="nav-link" href="#">Department</a>
                <a class="nav-link" href="#">Types of Leave</a>
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
                        <h3>Registered Employee</h3>
                    </div>
                    <h4>1</h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-building"></i></span>
                        <h3>Listed Departments</h3>
                    </div>
                    <h4>1</h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-clipboard-list"></i></span>
                        <h3>Listed Leave Types</h3>
                    </div>
                    <h4>1</h4>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-3">
            <div class="col-md-4">
                <div class="content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-user"></i></span>
                        <h3>Accepted Leave</h3>
                    </div>
                    <h4>1</h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-building"></i></span>
                        <h3>Rejected Leave</h3>
                    </div>
                    <h4>1</h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="icon-wrapper me-3"><i class="fas fa-clipboard-list"></i></span>
                        <h3>Listed Leave Types</h3>
                    </div>
                    <h4>1</h4>
                </div>
            </div>
        </div>
        <div class="py-5">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
        const data = {
            labels: labels,
            datasets: [{
                label: 'My First Dataset',
                data: [65, 59, 80, 81, 56, 55, 40],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
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