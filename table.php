<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamedatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $idToDelete = $_POST["delete"];
    
    // Menghapus data berdasarkan ID
    $sqlDelete = "DELETE FROM games WHERE ID = $idToDelete";
    if ($conn->query($sqlDelete) === TRUE) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $sqlDelete . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM games";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Games</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 70%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        td button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        td button:hover {
            background-color: #c82333;
        }

        td button:focus {
            outline: none;
        }

        .no-data {
            text-align: center;
            color: #555;
        }
    </style>
</head>

<body>
    <h1>Data Games</h1>
    <?php
    if ($result->num_rows > 0) {
    ?>
        <table border='1'>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Developer</th>
                <th>Action</th>
            </tr>

            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["ID"] . "</td>
                        <td>" . $row["title"] . "</td>
                        <td>" . $row["developer"] . "</td>
                        <td>
                            <form method='post' action='table.php'>
                                <input type='hidden' name='delete' value='" . $row["ID"] . "'>
                                <button type='submit'>Hapus</button>
                            </form>
                        </td>
                    </tr>";
            }
            ?>

        </table>
    <?php
    } else {
        echo "<p class='no-data'>Tidak ada data</p>";
    }
    ?>

    <a href="GameStore.html">Home</a>

    <?php
    $conn->close();
    ?>
</body>

</html>