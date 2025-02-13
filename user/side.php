<style>
    @media (max-width:768px) {
            
            .sidebar{
                display: none !important;
            }
            body{
                display: block !important;
            }
        }

        @media (min-width:769px) {
            .offcanvas{
                display: none !important;
            }
            .navbar{
                display: none !important;
            }
            .sidebar{
                display:block ;
            }
        }
        
        .sidebar {
            min-width: 290px;
            max-width: 280px;
            background-color: #f8f9fa;
            height: 100vh;
        }

        .sidebar .nav-link {
            color: #333;
            padding: 10px;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            border-radius: 4px;
        }
 </style>   
    
<div class="sidebar d-flex flex-column p-3">
        <h4>Menu</h4>
        <nav class="nav flex-column">
            <a class="nav-link" href="#">Home</a>
            <a class="nav-link" href="./display_holidays.php">Display Holidays</a>
            <a class="nav-link" href="./apply-leave.php">Apply Leave</a>
            <a class="nav-link" href="./application-history.php">Leave History</a>
            <a class="nav-link" href="./profile.php">Profile</a>
            <a class="nav-link" href="../login.php">Logout</a>

        </nav>
    </div>