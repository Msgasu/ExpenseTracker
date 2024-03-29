<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneySights Login</title>
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

.login-page {
  justify-content: space-between;
  max-width: 1000px;
  width: 100%;
}

.login-page .text {
  margin-bottom: 90px;
}

.login-page h1 {
  color: var(--color-primary); /* Changed to use variable */
  font-size: 4rem;
  margin-bottom: 10px;
}

.login-page p {
  font-size: 1.75rem;
  white-space: nowrap;
  color: var(--color-dark); /* Changed to use variable */
}

form {
  display: flex;
  flex-direction: column;
  background: var(--color-white); /* Changed to use variable */
  border-radius: var(--border-radius-2); /* Changed to use variable */
  padding: var(--card-padding); /* Changed to use variable */
  box-shadow: var(--box-shadow); /* Changed to use variable */
  max-width: 400px;
  width: 100%;
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

.link .forgot {
  color: var(--color-primary); /* Changed to use variable */
  font-size: 0.875rem;
}

.link .forgot:hover {
  text-decoration: underline;
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
  background:  var(--color-dark); /* Changed to use variable */
  border-radius: var(--border-radius-1); /* Changed to use variable */
  color: var(--color-white); /* Changed to use variable */
  font-size: 1.063rem;
  font-weight: 600;
  transition: 0.2s ease;
}

.button a:hover {
  background:  var(--color-info-dark); /* Changed to use variable */
}

@media (max-width: 900px) {
  .login-page {
    flex-direction: column;
    text-align: center;
  }

  .login-page .text {
    margin-bottom: 30px;
  }
}

@media (max-width: 460px) {
  .login-page h1 {
    font-size: 3.5rem;
  }

  form {
    padding: 15px;
  }
}

.form .login-signup{
    margin-top: 30px;
    text-align: center;
    position: absolute;
    right: 10%;
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
      <div class="login-page flex">
        <div class="text">
            <h1>MoneySights</h1>
          <p>Manage your expenses </p>
          <p>with ease and convenience</p>
        </div>
        <form action="../action/login_user_action.php"  method ="post">
          <input type="email" name= "username" placeholder="Email" required>
          <input type="password" name = "password" placeholder="Password" required>
          <div class="link">
            <button type="submit" name= "submit" class="login">Login</button>
          </div>
          <hr>
          <div class="button" >
            <h4>Don't have an account?</h4>
            <br>
            <a href="../login/register_page.php">Register</a>
          </div>
          
        </form>
      </div>
      
    </div>
<script src="../js/index.js"></script>
<script>
    themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');              
    })
</script>
  </body>
</html>
