<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Responsive Dashboard using HTML CSS and JavaScript</title>
  <!-- MATERIAL CDN -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
  <!-- STYLESHEET -->
  <link rel="stylesheet" href="../css/style.css" />
  <style>
    /* Add this style for hiding inactive sections */
    main section {
      display: none;
    }


    main {
      padding: 20px;
      width: 100%;
      visibility: hidden;


    }


    /* Add this style for displaying active section */
    main section.active-section {
      display: block;
    }

    .other {
      background-color: orange;
      width: 0px;
      size: 0px;
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

      </div>

      <div class="profile-area">
        <div class="theme-toggler">
          <span class="material-icons-sharp active">light_mode</span>
          <span class="material-icons-sharp">dark_mode</span>
        </div>
        <div class="profile">
          <div class="profile-photo">
            <img src="../assets/images/profile-1.jpg">
          </div>
          <h5>Ryan Mbun</h5>
          <span class="material-icons-sharp">expand_more</span>
        </div>
        <button id="menu-btn">
          <span class="material-icons-sharp">menu</span>
        </button>
      </div>
    </div>
  </nav>

  <div class="container">
    <aside>

      <button id="close-btn">
        <span class="material-icons-sharp">close</span>
      </button>
      <div class="sidebar">
        <a class="active" data-target="dashboard">
          <span class="material-icons-sharp">grid_view</span>
          <h3>Dashboard</h3>
        </a>

        <a data-target="transactions">
          <span class="material-icons-sharp">receipt_long</span>
          <h3>Transactions</h3>
        </a>
        
        <a data-target="budget">
          <span class="material-icons-sharp">insights</span>
          <h3>Budget</h3>
        </a>

        <a data-target="profile">
          <span class="material-icons-sharp">person_outline</span>
          <h3>Profile</h3>
        </a>

        <a href="../login/logout_page.php">
          <span class="material-icons-sharp">logout</span>
          <h3>Logout</h3>
        </a>
      </div>
    </aside>
    <!------------------ END OF ASIDE ------------------>


    <main>
      <section id="dashboard" class="active-section">
        <!-- Dashboard content here -->
        <?php include('dashboard.php'); ?>
      </section>

      <section id="transactions">
        <!-- Transaction content here -->
        <?php include('transactions.php'); ?>

      </section>

      <section id="budget">
        <!-- Budget content here -->
        <?php include('budget.php'); ?>
      </section>

      <section id="profile">
        <!-- Profile content here -->
        <?php include('profile.php'); ?>

        <h1>Pro</h1>
      </section>
    </main>

    <div class="other">

    </div>
  </div>
  <script>
 // Function to make the main content visible
function showMainContent() {
  document.querySelector('main').style.visibility = 'visible';
}

// Get all sidebar links excluding logout link
const sidebarLinks = document.querySelectorAll('.sidebar a:not([href="../login/logout_page.php"])');

sidebarLinks.forEach(link => {
  link.addEventListener('click', (e) => {
    e.preventDefault();
    const targetId = link.getAttribute('data-target');
    
    sidebarLinks.forEach(item => {
      item.classList.remove('active');
    });
    link.classList.add('active');
    document.querySelectorAll('main section').forEach(section => {
      section.classList.remove('active-section');
    });
    document.getElementById(targetId).classList.add('active-section');

    // Store the active section ID in Local Storage
    localStorage.setItem('activeSection', targetId);
  });
});

// Function to load the active section from Local Storage on page load
function loadActiveSection() {
  const activeSectionId = localStorage.getItem('activeSection');
  if (activeSectionId) {
    const activeLink = document.querySelector(`.sidebar a[data-target="${activeSectionId}"]`);
    if (activeLink) {
      activeLink.click();
      return; // Exit early to prevent default to dashboard
    }
  }

  // If no active section is found in Local Storage, default to the dashboard section
  const defaultLink = document.querySelector('.sidebar a[data-target="dashboard"]');
  defaultLink.click();
}

// Load the active section on page load
window.addEventListener('load', function() {
  loadActiveSection();
  showMainContent(); // Make the main content visible after loading
});



</script>


</body>

</html>
