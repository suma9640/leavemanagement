<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      padding: 20px;
    }
    .profile-card {
      background: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .profile-image {
      border-radius: 50%;
      width: 120px;
      height: 120px;
      object-fit: cover;
      margin-bottom: 20px;
    }
    .social-icons a {
      color: #007bff;
      margin-right: 15px;
      font-size: 20px;
    }
    .social-icons a:hover {
      color: #0056b3;
    }
    .form-group {
      margin-bottom: 1.5rem;
    }
    #editProfileCard {
      display: none;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <!-- Profile Card -->
        <div class="profile-card text-center" id="profileCard">
          <!-- Profile Picture from PHP Session -->
          <img src="" alt="Profile Picture" class="profile-image" id="profileImage">
          
          <!-- Profile Name from PHP Session -->
          <h3 id="userName">Loading...</h3>

          <!-- Profile department from PHP Session -->
          <h3 id="userdepartment">Loading...</h3>
          
          <!-- Profile Designation from PHP Session -->
          <p class="text-muted" id="userDesignation">Loading...</p>
          
          <!-- Profile Email from PHP Session -->
          <p id="userEmail" class="text-muted">Loading...</p>

          <div class="mt-3">
            <!-- Profile Bio from PHP Session -->
            <p id="userAbout">Loading...</p>
          </div>
          
          <div class="social-icons mt-3">
            <a href="#" target="_blank" title="Facebook"><i class="fab fa-facebook"></i></a>
            <a href="#" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
            <a href="#" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
          </div>

          <div class="mt-3">
            <button class="btn btn-primary" onclick="editProfile()">Edit Profile</button>
          </div>
        </div>

        <!-- Edit Profile Form -->
        <div class="profile-card text-center" id="editProfileCard">
          <h3>Edit Profile</h3>
          <form id="editForm">
            <div class="form-group">
              <label for="editName">Name</label>
              <input type="text" class="form-control" id="editName" name="name" value="">
            </div>
            <div class="form-group">
              <label for="editDesignation">Designation</label>
              <input type="text" class="form-control" id="editDesignation" name="designation" value="">
            </div>
            <div class="form-group">
              <label for="editDepartment">Department</label>
              <input type="text" class="form-control" id="editDepartment" name="department" value="">
            </div>
            <div class="form-group">
              <label for="editEmail">Email</label>
              <input type="text" class="form-control" id="editEmail" name="email" value="">
            </div>
            <div class="form-group">
              <label for="editBio">Bio</label>
              <textarea class="form-control" id="editBio" name="bio"></textarea>
            </div>
            <div class="form-group">
              <label for="editProfileImage">Profile Image</label>
              <input type="file" class="form-control" id="editProfileImage" name="profile_image">
            </div>
            <button type="submit" class="btn btn-success mt-3">Save Changes</button>
            <button type="button" class="btn btn-secondary mt-3" onclick="cancelEdit()">Cancel</button>
          </form>
        </div>
        
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and Font Awesome for social icons (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- jQuery and AJAX Code -->
  <script>
    // Function to fetch user profile and update UI
    function fetchProfile() {
      console.log("Fetching profile...");

      $.ajax({
        url: '../api/user_profile.php', // Path to your PHP backend script
        type: 'GET',
        success: function(response) {
          console.log("Profile response:", response); // Log the response

          const userProfile = JSON.parse(response);
          if (userProfile.error) {
            alert(userProfile.error);
            return;
          }

          // Update the profile card with fetched data
          $('#userName').text(userProfile.name);
          $('#userdepartment').text(userProfile.department);
          $('#userDesignation').text(userProfile.designation);
          $('#userEmail').text(userProfile.email);
          $('#userAbout').text(userProfile.bio);
          $('#profileImage').attr('src', userProfile.profile_picture || 'default-image.jpg');
        },
        error: function(xhr, status, error) {
          alert('Error fetching profile: ' + error);
        }
      });
    }

    // Show Edit Profile Form and hide the Profile Card
    function editProfile() {
      // Get the current values from the profile card
      const name = $('#userName').text();
      const designation = $('#userDesignation').text();
      const department = $('#userdepartment').text();
      const bio = $('#userAbout').text();
      const email = $('#userEmail').text();

      // Set the values in the form inputs
      $('#editName').val(name);
      $('#editDesignation').val(designation);
      $('#editDepartment').val(department);
      $('#editBio').val(bio);
      $('#editEmail').val(email);

      // Show the edit form and hide the profile card
      document.getElementById('profileCard').style.display = 'none';
      document.getElementById('editProfileCard').style.display = 'block';
    }

    // Cancel editing and go back to Profile Card
    function cancelEdit() {
      document.getElementById('profileCard').style.display = 'block';
      document.getElementById('editProfileCard').style.display = 'none';
    }

    // AJAX form submission to save updated profile
    $('#editForm').submit(function(e) {
      e.preventDefault();

      var formData = new FormData(this); // Create a FormData object to handle file uploads

      $.ajax({
        url: '../api/user_profile.php', // Path to PHP script handling the profile update
        type: 'POST',
        data: formData,
        contentType: false, // Important for file uploads
        processData: false, // Important for file uploads
        success: function(response) {
          console.log("Update response:", response); // Log the response
          const updatedProfile = JSON.parse(response);

          // Update the profile card with the new data
          $('#userName').text(updatedProfile.name);
          $('#userdepartment').text(updatedProfile.department);
          $('#userDesignation').text(updatedProfile.designation);
          $('#userEmail').text(updatedProfile.email);
          $('#userAbout').text(updatedProfile.bio);
          $('#profileImage').attr('src', updatedProfile.profile_picture);

          cancelEdit();
        },
        error: function(xhr, status, error) {
          alert('Error updating profile: ' + error);
        }
      });
    });

    // Fetch profile on page load
    $(document).ready(function() {
      fetchProfile();
    });
  </script>
</body>
</html>
