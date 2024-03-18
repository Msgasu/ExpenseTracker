<!DOCTYPE html>
<html lang="en">
<head>

    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css" />
    <style>
      /********************* Profile Page *****************/
      /* Profile Page Styles */
      .profile-container {
      width: 500px;
      margin: 50px auto;
      padding: var(--card-padding);
      background-color: var(--color-white);
      border-radius: var(--card-border-radius);
      box-shadow: var(--box-shadow);
      }

      .profile-image-container {
      text-align: center;
      margin-bottom: 20px;
      
      }

      .profile-image {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid var(--color-primary);
      margin-bottom: 10px;
      position: relative;
      left: 35%;
      }

      .profile-container input[type="file"] {
      display: none;
      border-radius: 10px;
      }

      .profile-container .upload-btn {
      background-color: var(--color-primary);
      color: var(--color-white);
      padding: 10px 20px;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      display: block;
      margin: 0 auto;

      }

      .profile-container .submit{
      position: relative;
      left: 38%;
      } 

      .profile-container .upload-btn:hover {
      background-color: var(--color-primary-variant);
      }

      .profile-container input[type="text"],
      .profile-container input[type="email"],
      .profile-container input[type="tel"],
      .profile-container input[type="password"] {
      width: calc(100% - 22px);
      padding: 10px;
      margin: 5px 0 15px;
      border: 1px solid #ccc;
      border-radius: 15px;
      box-sizing: border-box;
      transition: border-color 0.3s ease;
      }

      .profile-container input[type="text"]:focus,
      .profile-container input[type="email"]:focus,
      .profile-container input[type="tel"]:focus,
      .profile-container input[type="password"]:focus {
      border-color: var(--color-primary);
      outline: none;
      }

      .profile-container input[type="submit"] {
      background-color: var(--color-primary);
      color: var(--color-white);
      padding: 10px 20px;
      border: none;
      border-radius: 32px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      }

      .profile-container input[type="submit"]:hover {
      background-color: var(--color-primary-variant);
      }
  </style>
</head>
<body>
        <h1>Profile</h1>
        <div class="profile-container">
            <div class="profile-image-container">
                <img src="#" alt="Profile Picture" class="profile-image" id="profile-img">
                <input type="file" id="file-input" accept="image/*" onchange="previewImage(event)">
                <label for="file-input" class="upload-btn">Upload Picture</label>
            </div>
            <input type="text" id="fname" name="fname" placeholder="First Name" required>
            <br>
            <input type="text" id="lname" name="lname" placeholder="Last Name" required>
            <br>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <br>
            <input type="tel" id="tel" name="tel" placeholder="Telephone">
            <br>
            <input type="password" id="password" name="password" placeholder="Change Password">
            <br>
            <input class="submit" type="submit" value="Save Profile" onclick="saveProfile()">
        </div>

    <script>
        // Function to preview image before upload
        function previewImage(event) {
            const fileInput = event.target;
            const files = fileInput.files;
            if (files.length > 0) {
                const reader = new FileReader();
                reader.onload = function () {
                    const profileImg = document.getElementById('profile-img');
                    profileImg.src = reader.result;
                };
                reader.readAsDataURL(files[0]);
            }
        }

        // Function to save profile changes
        function saveProfile() {
            const firstName = document.getElementById('fname').value;
            const lastName = document.getElementById('lname').value;
            const email = document.getElementById('email').value;
            const tel = document.getElementById('tel').value;
            const password = document.getElementById('password').value;
            
            // Send data to server to update profile (via AJAX)
        }

        // Function to fetch and display user data from the server
        function fetchUserData() {
            // Fetch user data from the server (via AJAX)
            // Update the input fields with the fetched data
            document.getElementById('fname').value = "John"; // Replace with fetched first name
            document.getElementById('lname').value = "Doe"; // Replace with fetched last name
            document.getElementById('email').value = "john@example.com"; // Replace with fetched email
            document.getElementById('tel').value = "1234567890"; // Replace with fetched telephone
        }

        // Call fetchUserData when the page loads
        window.onload = fetchUserData;
    </script>
</body>
</html>
