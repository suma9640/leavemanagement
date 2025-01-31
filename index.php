<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <style>
        .navbar-collapse {
            flex-grow: 0;
        }

        .nav-item .nav-link {
            color: #000 !important;
        }

        /* Image and Overlay Styling */
        .image-container {
            position: relative;
            max-height: 70vh;
            overflow: hidden;
            padding: 0;
        }

        img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .welcome-title-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2rem;
            color: white;
            text-align: center;
            /* background: rgba(0, 0, 0, 0.7); */
            padding: 10px 20px;
            border-radius: 10px;
            animation: float 3s ease-in-out infinite, slideInFade 1.5s ease-in-out forwards;
            opacity: 1;
            /* Change opacity to 1 for visibility */
        }

        /* Keyframe for slide and fade effect */
        @keyframes slideInFade {
            0% {
                transform: translate(-50%, -60%);
                opacity: 0;
            }

            100% {
                transform: translate(-50%, -50%);
                opacity: 1;
            }
        }

        /* Keyframe for floating animation */
        @keyframes float {
            0% {
                transform: translate(-50%, -50%) translateY(0);
            }

            50% {
                transform: translate(-50%, -50%) translateY(-10px);
            }

            100% {
                transform: translate(-50%, -50%) translateY(0);
            }
        }

        /* Remove default padding and margin for the container and row */
        .container-fluid,
        .row {
            padding: 0;
            margin: 0;
        }

        /* Card Styling */
        .benefits-card {
            margin: 20px 0;
        }

        .card-body {
            text-align: center;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .about-section img{
            height: 510px;

        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Leave Management</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Offcanvas -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Leave Management</h5>

                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <!-- Welcome Section with Image and Overlay Title -->
    <section>
        <div class="container-fluid text-center p-0">
            <div class="row">
                <div class="image-container">
                    <img src="images/leaves.jpg" alt="Leave Management System">
                    <div class="welcome-title-overlay">Welcome to Leave Management System</div>
                </div>
            </div>
        </div>
    </section>


    <!-- Benefits Section -->
    <section class="container-fluid my-5">
        <h2 class="text-center mb-4">Benefits of Leave Management System</h2>

        <div class="row">
            <!-- Efficiency Card -->
            <div class="col-md-3" data-aos="fade-up" data-aos-duration="1000">
                <div class="card benefits-card h-100">
                    <img src="images/efficeiency.avif" class="card-img-top" alt="Efficiency">
                    <div class="card-body">
                        <h5 class="card-title">Efficiency</h5>
                        <p class="card-text">Automates and simplifies the leave management process, reducing
                            administrative work.</p>
                    </div>
                </div>
            </div>

            <!-- Transparency Card -->
            <div class="col-md-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <div class="card benefits-card h-100">
                    <img src="images/efficeiency.avif" class="card-img-top" alt="Efficiency">
                    <div class="card-body">
                        <h5 class="card-title">Transparency</h5>
                        <p class="card-text">Employees can easily view their leave balances and history.</p>
                    </div>
                </div>
            </div>

            <!-- Improved Decision-Making Card -->
            <div class="col-md-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                <div class="card benefits-card h-100">
                    <img src="images/efficeiency.avif" class="card-img-top" alt="Efficiency">
                    <div class="card-body">
                        <h5 class="card-title">Improved Decision-Making</h5>
                        <p class="card-text">Managers can make informed decisions about leave requests based on
                            real-time data.</p>
                    </div>
                </div>
            </div>

            <!-- Compliance Card -->
            <div class="col-md-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                <div class="card benefits-card h-100">
                    <img src="images/efficeiency.avif" class="card-img-top" alt="Efficiency">
                    <div class="card-body">
                        <h5 class="card-title">Compliance</h5>
                        <p class="card-text">Helps ensure compliance with company policies and government regulations
                            regarding employee leave.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- About Section -->
    <section class="about-section container-fluid my-5 py-5">
        <h2 class="text-center mb-4">About Leave Management System</h2>
        <div class="row align-items-center">
            <!-- Image Section -->
            <div class="col-md-6">
                <img src="images/about.avif" class="img-fluid" alt="Leave Management System">
            </div>

            <!-- Content Section -->
            <div class="col-md-6">
                <h3>What is Leave Management System?</h3>
                <p>
                    The Leave Management System is an automated solution designed to help organizations manage their
                    employees' leave requests efficiently. It simplifies the process for both employees and managers by
                    providing an intuitive platform for submitting, approving, and tracking leave.
                </p>
                <p>
                    The system allows employees to request vacation, sick leave, or personal time off, while managers
                    can review, approve, or reject these requests. It also provides a transparent view of remaining
                    leave balances, maintains detailed leave history, and generates reports for effective resource
                    planning.
                </p>
                <p>
                    Key features include automated leave requests, real-time notifications, easy-to-use approval
                    workflows, and comprehensive reporting tools, ensuring a smooth and transparent process for all
                    involved.
                </p>
            </div>
        </div>
    </section>


    <!-- Leave Management Features Section -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Key Features of Leave Management System</h2>

        <div class="row d-flex">
            <!-- Employee Leave Requests Card -->
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-duration="1000">
                <div class="card benefits-card h-100">
                    <img src="images/leave-bg.avif" class="card-img-top" alt="Leave Requests">
                    <div class="card-body">
                        <h5 class="card-title">Employee Leave Requests</h5>
                        <p class="card-text">Employees can easily submit leave requests for vacation, sick leave, or
                            other personal time off.</p>
                    </div>
                </div>
            </div>

            <!-- Approval Workflow Card -->
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <div class="card benefits-card h-100">
                    <img src="images/leave-bg.avif" class="card-img-top" alt="Approval Workflow">
                    <div class="card-body">
                        <h5 class="card-title">Approval Workflow</h5>
                        <p class="card-text">Managers can review, approve, or reject leave requests with a simple click.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Leave Balances Card -->
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                <div class="card benefits-card h-100">
                    <img src="images/leave-bg.avif" class="card-img-top" alt="Leave Balances">
                    <div class="card-body">
                        <h5 class="card-title">Leave Balances</h5>
                        <p class="card-text">Track remaining leave balances for employees and ensure that leave policies
                            are followed.</p>
                    </div>
                </div>
            </div>

            <!-- Leave History Card -->
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                <div class="card benefits-card h-100">
                    <img src="images/leave-bg.avif" class="card-img-top" alt="Leave History">
                    <div class="card-body">
                        <h5 class="card-title">Leave History</h5>
                        <p class="card-text">View and maintain a detailed history of all leave requests for auditing and
                            reporting purposes.</p>
                    </div>
                </div>
            </div>

            <!-- Notifications Card -->
            <!-- <div class="col-md-3 mb-4 offset-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800">
                <div class="card benefits-card h-100">
                    <img src="images/notifications.jpg" class="card-img-top" alt="Notifications">
                    <div class="card-body">
                        <h5 class="card-title">Notifications</h5>
                        <p class="card-text">Get instant notifications about new leave requests, approvals, and
                            rejections.</p>
                    </div>
                </div>
            </div> -->

            <!-- Reporting Card -->
            <!-- <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="1000">
                <div class="card benefits-card h-100">
                    <img src="images/reporting.jpg" class="card-img-top" alt="Reporting">
                    <div class="card-body">
                        <h5 class="card-title">Reporting</h5>
                        <p class="card-text">Generate leave reports to analyze trends and plan resources effectively.
                        </p>
                    </div>
                </div>
            </div> -->
        </div>
    </section>

    <footer class="bg-light text-center py-3">
    <p class="mb-0">&copy; 2025 Your Company. All Rights Reserved.</p>
</footer>    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>