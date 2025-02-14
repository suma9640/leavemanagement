<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Basic styling (you can customize this) */
        .profile-card {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }
        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
    </style>
</head>
<body>

    <div class="profile-card">
        <img src="" alt="Profile Picture" class="profile-image" id="profileImage">
        <h3 id="userName">Loading...</h3>
        <p id="userDesignation">Loading...</p>
        <p id="userDepartment">Loading...</p>
        <p id="userEmail">Loading...</p>
        <p id="userBio">Loading...</p>

        <button onclick="editProfile()">Edit Profile</button>
    </div>

    <div class="profile-card" id="editProfileCard" style="display:none;">  </div>

    <script>
        $(document).ready(function() {
            fetchProfile();
        });

        function fetchProfile() {
            $.ajax({
                url: '../api/user_profile.php', // Your PHP script URL
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'error') {
                        console.error("Error:", response.message);
                        alert(response.message);
                        return;
                    }

                    $("#profileImage").attr("src", response.data.profile_picture || "default-image.jpg"); // Default image if none provided
                    $("#userName").text(response.data.name || "Not Provided");
                    $("#userDesignation").text(response.data.designation || "Not Provided");
                    $("#userDepartment").text(response.data.department || "Not Provided");
                    $("#userEmail").text(response.data.email || "Not Provided");
                    $("#userBio").text(response.data.bio || "No bio provided");
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    alert("Error fetching profile: " + status);
                }
            });
        }

        function editProfile() {
            $.ajax({
                url: '../api/user_profile.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                  if (response.status === 'error') {
                      console.error("Error:", response.message);
                      alert(response.message);
                      return;
                  }

                  let formHtml = `
                    <h3>Edit Profile</h3>
                    <form id="editForm">
                      <input type="text" name="name" value="${response.data.name}"><br>
                      <input type="text" name="designation" value="${response.data.designation}"><br>
                      <input type="text" name="department" value="${response.data.department}"><br>
                      <input type="email" name="email" value="${response.data.email}"><br>
                      <textarea name="bio">${response.data.bio}</textarea><br>
                      <input type="file" name="profile_image"><br>
                      <button type="submit">Save</button>
                      <button type="button" onclick="$('#editProfileCard').hide(); $('.profile-card:first').show();">Cancel</button>
                    </form>
                  `;

                  $("#editProfileCard").html(formHtml).show();
                  $(".profile-card:first").hide(); // Hide the display card

                  $("#editForm").submit(function(event) {
                      event.preventDefault();
                      let formData = new FormData(this);

                      $.ajax({
                          url: '../api/user_profile.php',
                          type: 'POST',
                          data: formData,
                          contentType: false,
                          processData: false,
                          dataType: 'json',
                          success: function(response) {
                              if (response.status === 'error') {
                                  console.error("Error:", response.message);
                                  alert(response.message);
                                  return;
                              }
                              fetchProfile(); // Refresh the profile display
                              $("#editProfileCard").hide();
                              $(".profile-card:first").show();// Show the display card
                          },
                          error: function(xhr, status, error) {
                              console.error("AJAX Error:", status, error);
                              alert("Error updating profile: " + status);
                          }
                      });
                  });
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    alert("Error fetching profile for edit: " + status);
                }
            });
        }
    </script>

</body>
</html>