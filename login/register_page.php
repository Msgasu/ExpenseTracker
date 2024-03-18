<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneySights Registration</title>
        <!-- STYLESHEET -->
        <link rel="stylesheet" href="../css/style.css" />
           <!-- MATERIAL CDN -->

        <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
        rel="stylesheet"
        />
   <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .flex {
            display: flex;
            align-items: center;
        }

        .container2 {
            padding: 0 15px;
            min-height: 100vh;
            justify-content: center;
            background: var(--color-background); /* Changed to use variable */
        }

        .register-page {
            justify-content: space-between;
            max-width: 1000px;
            width: 100%;
        }

        .register-page .text {
            margin-bottom: 90px;
        }

        .register-page h1 {
            color: var(--color-primary); /* Changed to use variable */
            font-size: 4rem;
            margin-bottom: 10px;
        }

        .register-page p {
            font-size: 1.75rem;
            white-space: nowrap;
            color: var(--color-dark); /* Changed to use variable */
        }


        /* Add this CSS to your existing styles.css */

        form {
            display: flex;
            flex-direction: column;
            background: var(--color-white); /* Changed to use variable */
            border-radius: var(--border-radius-2); /* Changed to use variable */
            padding: var(--card-padding); /* Changed to use variable */
            box-shadow: var(--box-shadow); /* Changed to use variable */
            max-width: 400px;
            width: 100%;
            height: 620px; /* Set a fixed height */
            overflow: auto; /* Enable scrolling */
        }


        form input {
            height: 55px;
            width: 100%;
            border: 1px solid var(--color-info-dark); /* Changed to use variable */
            border-radius: var(--border-radius-1); /* Changed to use variable */
            margin-bottom: 15px;
            font-size: 1rem;
            padding: 0 var(--padding-1); /* Changed to use variable */
        }

        form input:focus {
            outline: none;
            border-color: var(--color-primary); /* Changed to use variable */
        }

        ::placeholder {
            color: var(--color-info-dark); /* Changed to use variable */
            font-size: 1.063rem;
        }

        .link {
            display: flex;
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }

        .link .login {
            border: none;
            outline: none;
            cursor: pointer;
            background: var(--color-primary); /* Changed to use variable */
            padding: 15px 0;
            border-radius: var(--border-radius-1); /* Changed to use variable */
            color: var(--color-white); /* Changed to use variable */
            font-size: 1.25rem;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .link .login:hover {
            background: var(--color-primary-variant); /* Changed to use variable */
        }

        form a {
            text-decoration: none;
        }



        hr {
            border: none;
            height: 1px;
            background-color: var(--color-info-dark); /* Changed to use variable */
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .button {
            margin-top: 25px;
            text-align: center;
            margin-bottom: 20px;
        }

        .button a {
            padding: 15px 20px;
            background: var(--color-dark); /* Changed to use variable */
            border-radius: var(--border-radius-1); /* Changed to use variable */
            color: var(--color-white); /* Changed to use variable */
            font-size: 1.063rem;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .button a:hover {
            background: var(--color-info-dark); /* Changed to use variable */
        }

        @media (max-width: 900px) {
            .register-page {
                flex-direction: column;
                text-align: center;
            }

            .register-page .text {
                margin-bottom: 30px;
            }
        }

        @media (max-width: 460px) {
            .register-page h1 {
                font-size: 3.5rem;
            }

            form {
                padding: 15px;
            }
        }

        .dob-section .label{
            font-size: 0.7rem;
        }

   </style>
</head>
<body>
    <nav>
        <div class="container">
         
          <div class="name">
            <div class="logo">
                <img src="../assets/images/logo.png" alt="logo">
                <!-- <h2>MONEY<span class="danger">SIGHTS</span></h2> -->
                <h2><span class="green">MONEY</span>SIGHTS</h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>
          </div>
          
            <div class="profile-area">
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
             
            </div>
        </div>
      </nav>
      <div class="container2 flex">
        <div class="register-page flex">
            <div class="text">
                <h1>MoneySights</h1>
                <p>Manage your expenses </p>
                <p>with ease and convenience</p>
            </div>
            <form action="../action/register_user_action.php" method="post" id="registrationForm">
                <input type="text" name="firstname" placeholder="First Name" required>
                <input type="text" name="lastname" placeholder="Last Name" required>
                <input type="email" name="email" placeholder="Email" required>

                <div class="dob-section">
                    <label class="label">Date of Birth</label>
                    <input type="date" name="dob" id="dob" required>
                </div>

                <input type="tel" name="phonenumber" placeholder="Telephone Number" required>
                <input type="password" name="password" id="password" placeholder="Password" pattern="^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[@$!%?&])[A-Za-z\d@$!%?&]{8,}$" title="Password must contain at least one uppercase letter, one lowercase letter, one number, one special character, and be at least 8 characters long." required>
                <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required>

                <!-- Title element for displaying error message -->
                <h2 id="errorMessage" style="color: red; display: none;">Passwords do not match!</h2>

                <div class="link">
                    <button type="submit" name="submitBtn" class="login">Register</button>
                </div>
                <hr>
                <div class="button">
                    <h4>Already have an account?</h4>
                    <br>
                    <a href="../login/login_page.php">Login</a>
                </div>
            </form>
        </div>
    </div>

    <script src="../js/index.js"></script>
    <script>
        document.getElementById("registrationForm").addEventListener("submit", function(event) {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmpassword").value;

            if (password !== confirmPassword) {
                document.getElementById("errorMessage").style.display = "block";
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>
</body>
</html>