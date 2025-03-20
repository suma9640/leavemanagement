<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../uploads/logo-image.png" type="image/x-icon">
    <title>Profile</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            /* display: flex; */
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            /* padding: 20px; */
        }

        .profile-card {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 350px;
            margin: 0 auto;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid #ddd;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .profile-card button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .profile-card button:hover {
            background-color: #0056b3;
        }

        #editProfileCard {
            display: none;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 350px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        #editProfileCard input,
        #editProfileCard textarea {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        #editProfileCard button {
            width: 48%;
        }

        @media (max-width: 400px) {
            .profile-card, #editProfileCard {
                padding: 15px;
            }

            .profile-image {
                width: 80px;
                height: 80px;
            }
        }
    </style>
</head>
<body>
<?php include('side.php') ?>

    <div class="container py-5">
    <div class="profile-card" id="viewProfile">
        <img src="default-image.jpg" alt="Profile Picture" class="profile-image" id="profileImage">
        <h3 id="userName">Loading...</h3>
        <p id="userDesignation">Loading...</p>
        <p id="userDepartment">Loading...</p>
        <p id="userEmail">Loading...</p>
        <p id="userBio">Loading...</p>
        <button onclick="editProfile()">Edit Profile</button>
    </div>

    <div id="editProfileCard"></div>
    </div>

    <script>
        $(document).ready(function() {
            fetchProfile();
        });

        function fetchProfile() {
            $.ajax({
                url: '../api/user_profile.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'error') {
                        alert(response.message);
                        return;
                    }
                    $("#profileImage").attr("src", response.data.profile_picture || "../images/profile.png");
                    $("#userName").text(response.data.name || "Not Provided");
                    $("#userDesignation").text(response.data.designation || "Not Provided");
                    $("#userDepartment").text(response.data.department || "Not Provided");
                    $("#userEmail").text(response.data.email || "Not Provided");
                    $("#userBio").text(response.data.bio || "No bio provided");
                },
                error: function() {
                    alert("Error fetching profile.");
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
                        alert(response.message);
                        return;
                    }
                    let formHtml = `
                        <h3>Edit Profile</h3>
                        <form id="editForm">
                            <input type="text" name="name" value="${response.data.name}" required><br>
                            <input type="text" name="designation" value="${response.data.designation}" required><br>
                            <input type="text" name="department" value="${response.data.department}" required><br>
                            <input type="email" name="email" value="${response.data.email}" required><br>
                            <textarea name="bio">${response.data.bio}</textarea><br>
                            <input type="file" name="profile_image"><br>
                            <button type="submit">Save</button>
                            <button type="button" onclick="cancelEdit()">Cancel</button>
                        </form>`;
                    
                    $("#editProfileCard").html(formHtml).show();
                    $("#viewProfile").hide();
                    
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
                                    alert(response.message);
                                    return;
                                }
                                fetchProfile();
                                cancelEdit();
                            },
                            error: function() {
                                alert("Error updating profile.");
                            }
                        });
                    });
                }
            });
        }

        function cancelEdit() {
            $("#editProfileCard").hide();
            $("#viewProfile").show();
        }
    </script>
</body>
</html>