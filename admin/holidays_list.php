<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../uploads/logo-image.png" type="image/x-icon">
  <title>Add Holiday</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  <style>
    /* body {
      display: flex;
    } */

    /* Your styles here */
    .add-holiday-section {
      background-color: #ffffff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 40px;
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
    }

    input,
    select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    button {
      background-color: #3498db;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #2980b9;
    }

    /* side bar style */
    .sidebar {
      box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important;
    }

    .nav {
      gap: 20px !important;
    }
  </style>
</head>

<body>

  <?php include('side.php') ?>
  <div class="container py-5">
    <div class="add-holiday-section ">
      <h2>Add a Holiday</h2>
      <form id="holidayForm" onsubmit="submitHoliday(event)">
        <label for="holidayDate">Holiday Date:</label>
        <input type="date" id="holidayDate" name="holidayDate" required><br><br>

        <label for="holidayName">Holiday Name:</label>
        <input type="text" id="holidayName" name="holidayName" required><br><br>

        <button type="submit">Add Holiday</button>
      </form>
      <p id="holidayMessage" style="color: green;"></p>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    // Function to handle form submission via AJAX using jQuery
    function submitHoliday(event) {
      event.preventDefault(); // Prevent the default form submission

      // Get form data
      const holidayDate = $('#holidayDate').val();
      const holidayName = $('#holidayName').val();

      // Validate form data before sending (optional)
      if (!holidayDate || !holidayName) {
        $('#holidayMessage').text('Please fill in all fields!');
        $('#holidayMessage').css('color', 'red');
        return;
      }

      // Make an AJAX request to submit the holiday data
      $.ajax({
        url: '../api/holidays_list.php', // Endpoint to handle the holiday data
        method: 'POST', // POST method for form submission
        data: {
          holidayDate: holidayDate,
          holidayName: holidayName,
        },
        success: function(response) {
          // Check if the response is successful and handle it
          $('#holidayMessage').text(response); // Assuming the server returns a message
          $('#holidayMessage').css('color', 'green'); // Display success message in green
        },
        error: function(xhr, status, error) {
          // In case of an error, display an error message
          $('#holidayMessage').text('Error submitting the holiday: ' + error);
          $('#holidayMessage').css('color', 'red'); // Display error message in red
        }
      });
    }
  </script>

</body>

</html>