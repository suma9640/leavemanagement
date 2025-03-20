<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../uploads/logo-image.png" type="image/x-icon">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* Responsive Sidebar */
        @media (max-width: 768px) {    
            .sidebar {
                display: none !important;
            }
            body {
                display: block !important;
            }
        }

        @media (min-width: 769px) {
            .offcanvas {
                display: none !important;
            }
            .navbar {
                display: none !important;
            }
            .sidebar {
                display: block;
            }
        }

        /* Sidebar Styling */
        .sidebar {
            min-width: 290px;
            max-width: 280px;
            background-color: #f8f9fa;
            height: 100vh;
            padding: 20px;
        }

        .sidebar .nav-link {
            color: #333;
            padding: 10px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px; /* Space between icon and text */
            transition: 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            border-radius: 4px;
        }

        /* Main content area */
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        h3{
            font-size: 10px;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="d-flex">
        <div class="sidebar d-flex flex-column">
            <h4>Menu</h4>
            <nav class="nav flex-column">
                <a class="nav-link" href="adminhome.php">
                    <i class="fa-solid fa-house"></i> Home
                </a>
                <a class="nav-link" href="fetch_employee.php">
                    <i class="fa-solid fa-users"></i> Employee List
                </a>
                <a class="nav-link" href="fetchleave.php">
                    <i class="fa-solid fa-check"></i> Leaves Approve
                </a>
                <a class="nav-link" href="dept.php">
                    <i class="fa-solid fa-building"></i> Department
                </a>
                <a class="nav-link" href="holidays_list.php">
                    <i class="fa-solid fa-calendar-days"></i> Holidays
                </a>
                <a class="nav-link" href="leavebalance.php">
                    <i class="fa-solid fa-plus"></i> Add Leave Balance
                </a>
                <a class="nav-link" href="profile.php">
                    <i class="fa-solid fa-user"></i> Profile
                </a>
                <a class="nav-link" href="../login.php">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </nav>
        </div>

        <!-- Main Content Area
        <div class="content">
            <h2>Welcome to the Admin Dashboard</h2>
            <p>Manage employees, leaves, and departments from here.</p>
        </div> -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
