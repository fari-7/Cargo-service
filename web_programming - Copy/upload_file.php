<?php
session_start(); 
include 'connection.php'; 


if (!isset($_SESSION['client_phone'])) {
    die("User    is not logged in.");
}

$userPhone = $_SESSION['client_phone']; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_FILES['files'])) {
        $files = $_FILES['files'];
        $uploadDirectory = 'uploads/'; 

        
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

       
        $allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'application/pdf',
            'application/zip',
            'application/msword', 
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' 
        ];

        
        for ($i = 0; $i < count($files['name']); $i++) {
            $fileName = $files['name'][$i];
            $fileTmpName = $files['tmp_name'][$i];
            $fileError = $files['error'][$i];
            $fileSize = $files['size'][$i];

           
            if ($fileError === 0) {
                
                if ($fileSize <= 5000000) {
                   
                    $fileType = mime_content_type($fileTmpName);

                   
                    if (in_array($fileType, $allowedTypes)) {
                       
                        $uniqueFileName = uniqid() . '_' . basename($fileName);
                        $fileDestination = $uploadDirectory . $uniqueFileName;

                       
                        if (move_uploaded_file($fileTmpName, $fileDestination)) {
                           
                            $stmt = $conn->prepare("UPDATE customer_details SET file_name = ?, file_path = ? WHERE ph = ?");
                            $stmt->bind_param("sss", $uniqueFileName, $fileDestination, $userPhone);
                            if ($stmt->execute()) {
                                $message = "File uploaded successfully!";
                            } else {
                                $message = "Error updating user record: " . $stmt->error;
                            }
                        } else {
                            $message = "Error uploading file: " . htmlspecialchars($fileName);
                        }
                    } else {
                        $message = "Invalid file type: " . htmlspecialchars($fileName);
                    }
                } else {
                    $message = "File size exceeds the limit: " . htmlspecialchars($fileName);
                }
            } else {
                $message = "Error with file: " . htmlspecialchars($fileName);
            }
        }
    } else {
        $message = "No files were uploaded.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        
        .container {
            width: 80%;
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .message {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .back-button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .back-button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="message"><?php echo $message; ?></h2>
        <button class="back-button" onclick="window.location.href='homepage.html'">Back</button>
    </div>
</body>
</html>
