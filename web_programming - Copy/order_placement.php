<?php
session_start(); // Start the session to access session variables

// Check if user is logged in as client or owner
$loggedInClient = isset($_SESSION['client_phone']);
$loggedInOwner = isset($_SESSION['user_phone']);

// If neither client nor owner is logged in, set a flag for the modal
$showLoginModal = !$loggedInClient && !$loggedInOwner;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order</title>
  <style>
    /* Dropdown Toggle CSS */
    #menu-toggle {
      display: none;
    }

    .menu-button {
      display: inline-block;
      background-color: #e74c3c;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 20px;
      cursor: pointer;
      margin-left: 50px;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color:rgb(128, 77, 77);
      min-width: 160px;
      border-radius: 6px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      margin-top: 5px;
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #d8411fc8;
    }

    #menu-toggle:checked + label + .dropdown-content {
      display: block;
    }

    /* Modal CSS */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.4);
      padding-top: 60px;
    }

    .modal-content {
    background: radial-gradient(circle, rgba(61, 57, 57, 0.863), rgb(199, 77, 77));
      margin: 5% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 300px;
      text-align: center;
    }
    button{
      background-color:rgb(202, 170, 176);
      padding: 10px;
    }
  </style>
  <link rel="stylesheet" href="order.css" />
</head>
<body>
  <header style="background: radial-gradient(circle, #ffefd5, #f39c12)">
    <div class="header-container">
      <img src="FB_IMG_1729578900278.jpg" alt="FLAIR Express Logo" class="logo-image" />
      <div class="logo">
        <h1>FLAIR Express</h1>
        <p>Your Reliable Door-to-Door Shipping Solution</p>
      </div>
    </div>
    <nav class="nav">
      <ul>
        <li><a href="Homepage.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="member_signup.html">Members</a></li>
        <li><a href="#" onclick="checkLogin()">Order placement</a></li>
        <li><a href="contact_us.html">Contact Us</a></li>
        <!-- <li style="position: relative;">
          <input type="checkbox" id="menu-toggle">
          <label for="menu-toggle" class="menu-button">Menu </label>
          <div class="dropdown-content">
            <a href="#" onclick="checkLogin('profile')">Profile</a>
            <a href="#" onclick="checkLogin('logout')">Logout</a>
          </div>
        </li> -->
      </ul>
    </nav>
  </header>

  <main>
    <div class="icon">
      <a href="file_attachment.html" target="_blank" title="Import">
        <h3>Import</h3>
        <img src="import-export-company-name-ideas.jpg" alt="Import" />
      </a>
      <a href="file_attachment.html" target="_blank" title="Sourcing">
        <h3>Sourcing</h3>
        <img src="sourcing-intelligence.webp" alt="Sourcing" />
      </a>
      <a href="file_attachment.html" target="_blank" title="Sourcing & Import">
        <h3>Sourcing & Import</h3>
        <img src="adastraglobal-import-d.jpeg" alt="Sourcing & Import" />
      </a>
    </div>
  </main>

  <!-- Modal for login options -->
  <div id="loginModal" class="modal" style="<?php echo $showLoginModal ? 'display: block;' : 'display: none;'; ?>">
    <div class="modal-content">
      <h2>Login Required</h2>
      <p>Please log in to continue:</p>
      <button onclick="window.location.href='customer_login.html'">Login as Client</button>
      <button onclick="window.location.href='member_login.html'">Login as Owner</button>
    </div>
  </div>

  <script>
    // Function to check if user is logged in
    function checkLogin(action) {
      // Simulate a login check (replace with actual login check logic)
      const isLoggedIn = <?php echo json_encode($loggedInClient || $loggedInOwner); ?>; // Check login status from PHP

      if (!isLoggedIn) {
        document.getElementById('loginModal').style.display = 'block'; // Show modal if not logged in
      } else {
        if (action === 'profile') {
          // Redirect to profile page
          window.location.href = 'profile.html'; // Change to actual profile page
        } else if (action === 'logout') {
          // Handle logout
          alert('Logged out successfully!');
          // Add logout logic here
        } else {
          // Redirect to order placement page
          window.location.href = 'Homepage.html'; // Change to actual order placement page
        }
      }
    }

    // Function to close the modal
    function closeModal() {
      document.getElementById('loginModal').style.display = 'none';
    }
  </script>
</body>
</html>
