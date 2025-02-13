<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        }

        .holiday-list-section {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 900px; /* Max width for large screens */
            width: 90%;
            min-height: 100vh;
        }

        h2 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
            color: #2c3e50;
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

        /* Hover effect on holiday items */
        .holiday-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }

        /* Different color for third Saturdays */
        .third-saturday {
            background-color: #3498db;
            color: white;
        }

        /* Default color for all other holidays */
        .default-holiday {
            background-color: #ecf0f1;
            color: #2c3e50;
        }

        /* Button styling */
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
        }

        @media (max-width: 480px) {
            .holiday-list-section {
                margin: 10px;
                padding: 10px;
            }

            .holiday-item {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="holiday-list-section">
        <h2>Holiday List</h2>
        <button class="refresh-button" onclick="fetchHolidayList()">Refresh Holiday List</button>
        <div id="holidayList"></div>
    </div>

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
                    $('#holidayList').empty();

                    if (holidays.length > 0) {
                        holidays.forEach(function(holiday) {
                            // Get the date of the holiday
                            const holidayDate = new Date(holiday.holiday_date);
                            const isThirdSaturday = checkThirdSaturday(holidayDate);

                            // Add class based on whether it is the third Saturday or not
                            const holidayClass = isThirdSaturday ? 'third-saturday' : 'default-holiday';

                            const holidayItem = `
                                <div class="holiday-item ${holidayClass}">
                                    <div class="holiday-name">${holiday.holiday_name}</div>
                                    <div class="holiday-date">${holiday.holiday_date}</div>
                                </div>
                            `;
                            $('#holidayList').append(holidayItem); // Append holiday item to the list
                        });
                    } else {
                        $('#holidayList').html('<p>No holidays found.</p>'); // Show message if no holidays are found
                    }
                },
                error: function(xhr, status, error) {
                    $('#holidayList').html('<p>Error fetching holiday data.</p>'); // Show error message
                }
            });
        }

        // Check if the given date is the third Saturday of the month
        function checkThirdSaturday(date) {
            const day = date.getDay();
            const dateDay = date.getDate();

            // Check if it's a Saturday (day == 6) and the date is between 15 and 21 (3rd Saturday)
            return day === 6 && dateDay >= 15 && dateDay <= 21;
        }

        // Call the function to fetch the holiday list when the page loads
        $(document).ready(function() {
            fetchHolidayList();
        });
    </script>

</body>
</html>
