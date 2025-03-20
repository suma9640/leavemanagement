<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../uploads/logo-image.png" type="image/x-icon">
    <title>Admin Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: linear-gradient(to right, #a1c4fd, #c2e9fb);
            width: 100%;
        }
        img{
            width: 60px;
        }
    </style>
</head>

<body>
    <!-- Bootstrap Responsive Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../images/logo.png" alt="image-logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="adminhome.php"><i class="bi bi-house"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="fetch_employee.php"><i class="bi bi-people"></i> Employee List</a></li>
                    <li class="nav-item"><a class="nav-link" href="fetchleave.php"><i class="bi bi-check-circle"></i> Leaves Approve</a></li>
                    <li class="nav-item"><a class="nav-link" href="dept.php"><i class="bi bi-building"></i> Department</a></li>
                    <li class="nav-item"><a class="nav-link" href="holidays_list.php"><i class="bi bi-calendar"></i> Holidays</a></li>
                    <li class="nav-item"><a class="nav-link" href="leavebalance.php"><i class="bi bi-plus-circle"></i> Add Leave Balance</a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php"><i class="bi bi-person"></i> Profile</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="../login.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>