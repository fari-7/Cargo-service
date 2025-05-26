<?php
session_start();

// Check if user is logged in as client or owner
$loggedInClient = isset($_SESSION['client_phone']);
$loggedInOwner = isset($_SESSION['user_phone']);

if (!$loggedInClient && !$loggedInOwner) {
    // Not logged in, show notification with options to login as Owner or Client
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Access Denied - Please Login</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f7f9fc;
                margin: 0; padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                color: #333;
            }
            .notification-box {
                background: white;
                padding: 2rem;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                max-width: 400px;
                text-align: center;
            }
            h1 {
                margin-bottom: 1rem;
                color: #e74c3c;
            }
            p {
                margin-bottom: 2rem;
                font-size: 1.1rem;
            }
            .button-group {
                display: flex;
                justify-content: center;
                gap: 1rem;
            }
            .button-group button {
                padding: 0.6rem 1.2rem;
                font-size: 1rem;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            .btn-client {
                background-color: #2980b9;
                color: white;
            }
            .btn-client:hover {
                background-color: #1f6391;
            }
            .btn-owner {
                background-color: #27ae60;
                color: white;
            }
            .btn-owner:hover {
                background-color: #1e8449;
            }
        </style>
        <script>
            function redirectToLogin(userType) {
                if (userType === 'client') {
                    window.location.href = 'customer_login.html?message=Please log in first as a client';
                } else if (userType === 'owner') {
                    window.location.href = 'member_login.html?message=Please log in first as an owner';
                }
            }
        </script>
    </head>
    <body>
        <div class="notification-box">
            <h1>Access Denied</h1>
            <p>Please login first to access your profile.</p>
            <div class="button-group">
                <button class="btn-client" onclick="redirectToLogin('client')">Login as Client</button>
                <button class="btn-owner" onclick="redirectToLogin('owner')">Login as Owner</button>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// If logged in, determine user type and fetch info accordingly
if ($loggedInOwner) {
    // Redirect to display_data.php if logged in as owner
    header("Location: display_data.php");
    exit(); // Ensure no further code is executed after redirection
}
elseif ($loggedInClient) {
    include 'connection.php';
    $user_phone = $_SESSION['client_phone'];
    $stmt = $conn->prepare("SELECT fn, ln, mail, ph, tph, nid, dob, gender FROM customer_details WHERE ph = ?");
    $stmt->bind_param("s", $user_phone);
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name, $email, $phone, $tphone, $nid, $dob, $gender);
    $stmt->fetch();
    $stmt->close();

    // Placeholder activities
    $activities = [
        "Order #1001: Delivered on 2024-01-10",
        "Order #1002: Shipped on 2024-02-05",
        "Order #1003: Processing",
    ];
    $userType = 'client';

} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>My Profile - Flair Express</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f7f9fc;
        margin: 0;
        padding: 0;
        color: #333;
    }
    header {
        background-color: #2980b9;
        padding: 1rem 2rem;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    header a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        margin-left: 1rem;
        padding: 0.4rem 0.8rem;
        border-radius: 4px;
        transition: background-color 0.3s;
    }
    header a:hover {
        background-color: #1f6391;
    }
    main {
        max-width: 900px;
        margin: 2rem auto;
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 8px;
        padding: 2rem 3rem;
    }
    h1 {
        margin-top: 0;
        color: #2c3e50;
    }
    section {
        margin-bottom: 2rem;
    }
    section h2 {
        border-bottom: 2px solid #2980b9;
        padding-bottom: 0.3rem;
        margin-bottom: 1rem;
        color: #2980b9;
    }
    .info p {
        margin: 0.4rem 0;
        font-size: 1rem;
    }
    .activity-list {
        list-style-type: none;
        padding-left: 0;
    }
    .activity-list li {
        background: #ecf0f1;
        margin-bottom: 0.6rem;
        padding: 0.8rem 1rem;
        border-radius: 4px;
        font-size: 0.95rem;
        color: #34495e;
    }
    @media (max-width: 600px) {
        main {
            margin: 1rem;
            padding: 1.5rem;
        }
        header {
            flex-direction: column;
            align-items: flex-start;
        }
        header a {
            margin: 0.5rem 0 0 0;
        }
    }
</style>
</head>
<body>
<header>
    <div>My Profile (<?php echo ucfirst(htmlspecialchars($userType)); ?>)</div>
    <nav>
        <a href="Homepage.html" aria-label="Home">Home</a>
        <a href="logout.php" aria-label="Logout">Logout</a>
    </nav>
</header>
<main>
    <section class="info">
        <h1>Welcome, 
            <?php 
                if ($userType === 'client') {
                    echo htmlspecialchars($first_name . ' ' . $last_name);
                }
            ?>
        </h1>
        <h2>Your Information</h2>
        <?php if ($userType === 'client'): ?>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
            <p><strong>Alternate Phone:</strong> <?php echo htmlspecialchars($tphone); ?></p>
            <p><strong>NID:</strong> <?php echo htmlspecialchars($nid); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($dob); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>
        <?php endif; ?>
    </section>
    <section class="activity">
        <h2>Your Recent Activity</h2>
        <?php if (!empty($activities)): ?>
        <ul class="activity-list">
            <?php foreach ($activities as $activity): ?>
            <li><?php echo htmlspecialchars($activity); ?></li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>No recent activity found.</p>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
