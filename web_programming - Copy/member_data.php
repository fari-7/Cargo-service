<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = trim($_POST['fn']);
    $last_name = trim($_POST['ln']);
    $email = trim($_POST['mail']);
    $phone = trim($_POST['ph']);
    $tphone = trim($_POST['tph']);
    $nid = trim($_POST['nid']);
    $dob = $_POST['dob'];
    $gen = isset($_POST['Gender']) ? $_POST['Gender'] : null;
    $password = $_POST['pass'];

   
    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($nid) || empty($dob) || empty($password)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    if (strlen($phone) != 11 || !ctype_digit($phone)) {
        die("Invalid phone number. It must be exactly 11 digits.");
    }

    if (empty($gen)) {
        die("Please select a gender.");
    }

  
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $conn->prepare("INSERT INTO member_details (fn, ln, mail, ph, tph, nid, dob, gender, pass) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $first_name, $last_name, $email, $phone, $tphone, $nid, $dob, $gen, $password_hashed);

  
    if ($stmt->execute()) {
        header("Location: display_data.php"); 
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

   
    $stmt->close();
}


$conn->close();
?>
