<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <title>Holiday List</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #f5f7fa, #c3cfe2);
            display: flex;
            min-height: 100vh;
        }

        .container-fluid {
            display: flex;
            flex-direction: row; /* Layout the sidebar and content side by side */
            width: 100%;
        }

        .holiday-list-section {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin: 1px;
            flex-grow: 1;
            max-width: 900px;
            display: flex;
            flex-direction: column;
        }

        h2 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .holiday-sections {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .holiday-column {
            width: 48%;
            overflow-y: auto;
            max-height: 400px; /* Limit height to make it scrollable */
            padding-right: 10px;
        }

        .sidebar {
            width: 250px; /* Width of the sidebar */
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important;
            background-color: #fff;
            padding: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-body {
            padding: 20px;
        }

        .holiday-item {
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .holiday-name {
            font-weight: bold;
            font-size: 1.2em;
            color: #34495e;
        }

        .holiday-date {
            color: #7f8c8d;
            font-size: 1em;
        }

        .holiday-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }

        .third-saturday {
            background-color: #3498db;
            color: white;
        }

        .default-holiday {
            background-color: #ecf0f1;
            color: #2c3e50;
        }

        .refresh-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 12px;
            text-align: center;
            background-color: #27ae60;
            color: white;
            font-size: 1.1em;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .refresh-button:hover {
            background-color: #2ecc71;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .holiday-list-section {
                margin: 20px;
                padding: 15px;
            }

            h2 {
                font-size: 1.6em;
            }

            .holiday-item {
                padding: 12px;
            }

            .container-fluid {
                flex-direction: column; /* Stack the sidebar and content on small screens */
            }

            .sidebar {
                width: 100%; /* Sidebar takes full width on smaller screens */
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid d-flex">
        <!-- Sidebar Section -->
        <?php include('side.php')?> <!-- Include sidebar -->

        <!-- Main Content Section -->
        <div class="holiday-list-section">
            <h2>Holiday List</h2>
            <button class="refresh-button" onclick="fetchHolidayList()">Refresh Holiday List</button>
            <div class="holiday-sections">
                <!-- Third Saturday Section -->
                <div class="holiday-column">
                    <div class="card">
                        <div class="card-body">
                            <h3>Third Saturdays</h3>
                            <div id="thirdSaturdayList"></div>
                        </div>
                    </div>
                </div>

                <!-- Remaining Holidays Section -->
                <div class="holiday-column">
                    <div class="card">
                        <div class="card-body">
                            <h3>Remaining Holidays</h3>
                            <div id="holidayList"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to fetch and display the holiday list
        function fetchHolidayList() {
            $.ajax({
                url: '../api/fetch_holidays_list.php', // PHP script to fetch the holiday list
                method: 'GET', // GET method to retrieve data
                success: function(response) {
                    const holidays = JSON.parse(response);

                    // Clear previous holiday list
                    $('#thirdSaturdayList').empty();
                    $('#holidayList').empty();

                    if (holidays.length > 0) {
                        // Arrays to hold third Saturdays and remaining holidays
                        let thirdSaturdays = [];
                        let remainingHolidays = [];

                        holidays.forEach(function(holiday) {
                            const holidayDate = new Date(holiday.holiday_date);
                            const isThirdSaturday = checkThirdSaturday(holidayDate);

                            // Check if it's a third Saturday and separate the holidays
                            if (isThirdSaturday) {
                                thirdSaturdays.push(holiday);
                            } else {
                                remainingHolidays.push(holiday);
                            }
                        });

                        // Display Third Saturdays
                        thirdSaturdays.forEach(function(holiday) {
                            const holidayItem = `
                                <div class="holiday-item third-saturday">
                                    <div class="holiday-name">${holiday.holiday_name}</div>
                                    <div class="holiday-date">${formatDate(holiday.holiday_date)}</div>
                                </div>
                            `;
                            $('#thirdSaturdayList').append(holidayItem);
                        });

                        // Display Remaining Holidays
                        remainingHolidays.forEach(function(holiday) {
                            const holidayItem = `
                                <div class="holiday-item default-holiday">
                                    <div class="holiday-name">${holiday.holiday_name}</div>
                                    <div class="holiday-date">${formatDate(holiday.holiday_date)}</div>
                                </div>
                            `;
                            $('#holidayList').append(holidayItem);
                        });
                    } else {
                        $('#holidayList').html('<p>No holidays found.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#holidayList').html('<p>Error fetching holiday data.</p>');
                }
            });
        }

        // Check if the given date is the third Saturday of the month
        function checkThirdSaturday(date) {
            const day = date.getDay();
            const dateDay = date.getDate();
            return day === 6 && dateDay >= 15 && dateDay <= 21;
        }

        // Format date to display day-month-year
        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = date.getDate();
            const month = date.getMonth() + 1; // months are zero-indexed
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        // Call the function to fetch the holiday list when the page loads
        $(document).ready(function() {
            fetchHolidayList();
        });
    </script>
</body>
</html>
