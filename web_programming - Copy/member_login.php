<?php
session_start(); 

include 'connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = trim($_POST['ph']);
    $password = $_POST['pass'];

   
    if (empty($phone) || empty($password)) {
        die("Phone number and password are required.");
    }

    
    if (strlen($phone) != 11 || !ctype_digit($phone)) {
        die("Invalid phone number. It must be exactly 11 digits.");
    }

   
    $stmt = $conn->prepare("SELECT pass FROM member_details WHERE ph = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt->store_result();

    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

       
        if (password_verify($password, $hashed_password)) {
          
            $_SESSION['user_phone'] = $phone; 
            header("Location: display_data.php"); 
            exit();
        } else {
            echo "Invalid phone number or password.";
        }
    } else {
        echo "Invalid phone number or password.";
    }

    $stmt->close();
}

$conn->close();
?>