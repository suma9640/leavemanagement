<?php
include('../api/db.php');
// Start the session to access user data
session_start();
// Assuming user is logged in, user data will be stored in the session
// These values will typically be retrieved from the database after a successful login
$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';  // Example placeholder
$userDesignation = isset($_SESSION['user_designation']) ? $_SESSION['user_designation'] : ''; // Example placeholder
$userAbout = isset($_SESSION['user_about']) ? $_SESSION['user_about'] : ''; 
$userProfileImage = isset($_SESSION['user_profile_image']) ? $_SESSION['user_profile_image'] : '../uploads/1738400126_boy_faculty.jpg'; // Default image if not set
?>

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
  </style>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <!-- Profile Card -->
        <div class="profile-card text-center" id="profileCard">
          <!-- Dynamic Profile Image -->
          <img src="<?php echo $userProfileImage; ?>" alt="Profile Picture" class="profile-image" id="profileImage">
          <h3 id="userName"><?php echo $userName; ?></h3>
          <p class="text-muted" id="userDesignation"><?php echo $userDesignation; ?></p>
          
          <div class="mt-3">
            <h5>About</h5>
            <p id="userAbout"><?php echo $userAbout; ?></p>
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

        <!-- Edit Profile Form (Initially hidden) -->
        <div class="profile-card text-center" id="editProfileCard" style="display: none;">
          <h3>Edit Profile</h3>

          <form id="editForm" enctype="multipart/form-data">
            <!-- Floating Name Input -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="editName" placeholder="Name" value="<?php echo $userName; ?>" required>
              <label for="editName">Name</label>
            </div>

            <!-- Floating Designation Input -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="editDesignation" placeholder="Designation" value="<?php echo $userDesignation; ?>" required>
              <label for="editDesignation">Designation</label>
            </div>

            <!-- Floating About Textarea -->
            <div class="form-floating mb-3">
              <textarea class="form-control" id="editAbout" rows="4" placeholder="About" required><?php echo $userAbout; ?></textarea>
              <label for="editAbout">About</label>
            </div>

            <!-- Profile Image Input -->
            <div class="mb-3">
              <label for="image" class="form-label">Profile Image</label>
              <input type="file" class="form-control" id="image" name="image">
            </div>

            <!-- Buttons -->
            <div class="form-group">
              <button type="submit" class="btn btn-success">Save Changes</button>
              <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Cancel</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and Font Awesome for social icons (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>

  <script>
    // Show Edit Profile Form and hide the Profile Card
    function editProfile() {
      document.getElementById('profileCard').style.display = 'none';
      document.getElementById('editProfileCard').style.display = 'block';
    }

    // Cancel editing and go back to Profile Card
    function cancelEdit() {
      document.getElementById('profileCard').style.display = 'block';
      document.getElementById('editProfileCard').style.display = 'none';
    }

    // Handle form submission (in this case, just display the updated data in console)
    document.getElementById('editForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const name = document.getElementById('editName').value;
      const designation = document.getElementById('editDesignation').value;
      const about = document.getElementById('editAbout').value;
      const profileImage = document.getElementById('image').files[0];

      // Update profile with new values
      document.getElementById('userName').innerText = name;
      document.getElementById('userDesignation').innerText = designation;
      document.getElementById('userAbout').innerText = about;

      // Handle the profile image upload if any
      if (profileImage) {
        // You can send the image to the server here via AJAX (e.g., FormData)
        const formData = new FormData();
        formData.append('image', profileImage);
        // Add other fields as necessary (e.g., name, designation, etc.)
        
        // Example AJAX request to save the changes (you would implement the backend)
        // fetch('your_backend_url', { method: 'POST', body: formData })
        //   .then(response => response.json())
        //   .then(data => {
        //     console.log('Profile image saved', data);
        //   })
        //   .catch(error => {
        //     console.error('Error saving profile image:', error);
        //   });
      }

      // Switch back to profile card
      cancelEdit();

      // You can add logic here to send updated data to a server via AJAX, etc.
      console.log('Updated Profile:', { name, designation, about });
    });
  </script>
</body>
</html>
