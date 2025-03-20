<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../uploads/logo-image.png" type="image/x-icon">
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
            flex-direction: column;
        }

        .container-fluid {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            padding: 0;
        }

        .holiday-list-section {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin: 10px auto;
            max-width: 1000px;
            width: 90%;
            text-align: center;
        }

        .holiday-sections {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .holiday-column {
            flex: 1;
            min-width: 300px;
            margin: 10px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .holiday-item {
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .holiday-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }

        .refresh-button {
            margin: 20px auto;
            padding: 12px;
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

        @media (max-width: 768px) {
            .holiday-sections {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <?php include('side.php') ?>
    <div class="container-fluid d-flex flex-column align-items-center">
        <div class="holiday-list-section">
            <h2>Holiday List</h2>
            <button class="refresh-button" onclick="fetchHolidayList()">Refresh Holiday List</button>
            <div class="holiday-sections">
                <div class="holiday-column">
                    <div class="card">
                        <div class="card-body">
                            <h3>Third Saturdays</h3>
                            <div id="thirdSaturdayList"></div>
                        </div>
                    </div>
                </div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchHolidayList() {
            $.ajax({
                url: '../api/fetch_holidays_list.php',
                method: 'GET',
                success: function (response) {
                    const holidays = JSON.parse(response);
                    $('#thirdSaturdayList, #holidayList').empty();
                    let thirdSaturdays = [], remainingHolidays = [];
                    
                    holidays.forEach(holiday => {
                        const holidayDate = new Date(holiday.holiday_date);
                        if (checkThirdSaturday(holidayDate)) {
                            thirdSaturdays.push(holiday);
                        } else {
                            remainingHolidays.push(holiday);
                        }
                    });
                    
                    appendHolidays(thirdSaturdays, '#thirdSaturdayList', 'third-saturday');
                    appendHolidays(remainingHolidays, '#holidayList', 'default-holiday');
                },
                error: function () {
                    $('#holidayList').html('<p>Error fetching holiday data.</p>');
                }
            });
        }

        function checkThirdSaturday(date) {
            return date.getDay() === 6 && date.getDate() >= 15 && date.getDate() <= 21;
        }

        function appendHolidays(holidays, container, className) {
            holidays.forEach(holiday => {
                $(container).append(`
                    <div class="holiday-item ${className}">
                        <div class="holiday-name">${holiday.holiday_name}</div>
                        <div class="holiday-date">${formatDate(holiday.holiday_date)}</div>
                    </div>
                `);
            });
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return `${date.getDate()}-${date.getMonth() + 1}-${date.getFullYear()}`;
        }

        $(document).ready(fetchHolidayList);
    </script>
</body>

</html>