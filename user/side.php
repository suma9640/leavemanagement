<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../uploads/logo-image.png" type="image/x-icon">
    <title>Responsive Navbar with Icons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        @media (min-width: 769px) {
            .offcanvas {
                display: none !important;
            }
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: linear-gradient(to right, #a1c4fd, #c2e9fb);
            width: 100%;
        }

        .navbar-brand, .nav-link {
            color: #333 !important;
        }

        .nav-link:hover {
            color: #0056b3 !important;
        }
        img{
            width: 60px;
        }
    </style>
</head>

<body>

    <!-- Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="btn btn-primary d-lg-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar">
                <i class="bi bi-list"></i>
            </button>
            <a class="navbar-brand" href="#"><img src="../images/logo.png" alt="image-logo"></a>

            <div class="collapse navbar-collapse d-none d-lg-flex">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="userhome.php"><i class="bi bi-house"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="./display_holidays.php"><i class="bi bi-calendar"></i> Display Holidays</a></li>
                    <li class="nav-item"><a class="nav-link" href="./apply-leave.php"><i class="bi bi-pencil-square"></i> Apply Leave</a></li>
                    <li class="nav-item"><a class="nav-link" href="./application-history.php"><i class="bi bi-clock-history"></i> Leave History</a></li>
                    <li class="nav-item"><a class="nav-link" href="./profile.php"><i class="bi bi-person"></i> Profile</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="../login.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Offcanvas Sidebar for Mobile -->
    <div class="offcanvas offcanvas-start" id="offcanvasNavbar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="userhome.php"><i class="bi bi-house"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="./display_holidays.php"><i class="bi bi-calendar"></i> Display Holidays</a></li>
                <li class="nav-item"><a class="nav-link" href="./apply-leave.php"><i class="bi bi-pencil-square"></i> Apply Leave</a></li>
                <li class="nav-item"><a class="nav-link" href="./application-history.php"><i class="bi bi-clock-history"></i> Leave History</a></li>
                <li class="nav-item"><a class="nav-link" href="./profile.php"><i class="bi bi-person"></i> Profile</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="../login.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>
        </div>
    </div>

</body>

</html>
