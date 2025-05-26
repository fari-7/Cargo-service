<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1e1e2f;
            color: #e4e4e4;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh;
            width: 100%;
        }

        header {
        background-color: #2980b9;
        padding: 1rem 2rem;
        width: 97%;
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
        .container {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        h1 {
            color: #4c4cad;
            margin-bottom: 20px;
            font-size: 2rem;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #2a2a40;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #444;
        }

        th {
            background-color: #4c4cad;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        tr:nth-child(even) {
            background-color: #333348;
        }

        tr:hover {
            background-color: #44445c;
        }

        a i {
            font-size: 1.5em;
            color: #4db8ff;
            transition: transform 0.2s, color 0.2s;
        }

        a i:hover {
            color: #1ea7fd;
            transform: scale(1.2);
        }

        span i {
            font-size: 1.2em;
            color: #888;
        }
    </style>
</head>
<body>
    <header>
    <div>My Profile </div>
    <nav>
        <a href="Homepage.html" aria-label="Home">Home</a>
        <a href="logout.php" aria-label="Logout">Logout</a>
    </nav>
    </header>
    <div class="container">
        <h1>Customer Details</h1>
        <?php
        include 'connection.php';

        
        $sql = "SELECT fn, ln, mail, ph, tph, nid, dob, gender, file_name, file_path FROM customer_details";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
           
            echo "<table>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Telephone</th>
                        <th>NID</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>File</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['fn']) . "</td>
                        <td>" . htmlspecialchars($row['ln']) . "</td>
                        <td>" . htmlspecialchars($row['mail']) . "</td>
                        <td>" . htmlspecialchars($row['ph']) . "</td>
                        <td>" . htmlspecialchars($row['tph']) . "</td>
                        <td>" . htmlspecialchars($row['nid']) . "</td>
                        <td>" . htmlspecialchars($row['dob']) . "</td>
                        <td>" . htmlspecialchars($row['gender']) . "</td>
                        <td>";
                if (!empty($row['file_name']) && !empty($row['file_path'])) {
                    echo '<a href="' . htmlspecialchars($row['file_path']) . '" target="_blank" title="Download ' . htmlspecialchars($row['file_name']) . '">
                            <i class="fas fa-cloud-download-alt"></i>
                          </a>';
                } else {
                    echo '<span title="No file available"><i class="fas fa-cloud"></i></span>';
                }
                echo "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No customer data found.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
