<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Database</title>

    <link rel="stylesheet" type="text/css" href="styling.css">

    <header>
        <h1>Welcome to Our CRUD PHP Website</h1>
        <nav>
            <a href="index.php" target="_blank">Home Page</a>
            <a href="fillup.php" target="_blank">Fill Form</a>
            <a href="view.php" target="_blank">View Data</a>
        </nav>
    </header>
</head>

<body>
    <main>
        <h2>Here is the list of all the records in our database:</h2><br><br>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #446688; color: white;">
                    <th style="padding: 10px; border: 1px solid white;">ID</th>
                    <th style="padding: 10px; border: 1px solid white;">Name</th>
                    <th style="padding: 10px; border: 1px solid white;">Age</th>
                    <th style="padding: 10px; border: 1px solid white;">Gender</th>
                    <th style="padding: 10px; border: 1px solid white;">Favourite Food</th>
                    <th style="padding: 10px; border: 1px solid white;">Favourite Colour</th>
                    <th style="padding: 10px; border: 1px solid white;">Edit</th>
                    <th style="padding: 10px; border: 1px solid white;">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "survey";

                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }

                //For Delete
                if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'del') {
                    $id = $_REQUEST["id"];

                    // Process the form data here
                    $insertquery = "DELETE FROM form WHERE id = :id";
                    $stmt = $conn->prepare($insertquery);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    //$stmt->debugDumpParams();
                    //echo "<br><h2>Your response has been recorded!</h2>";
                    header('Location: view.php');
                }

                //For List All Data
                $stmt1 = $conn->prepare("SELECT * FROM form");
                $stmt1->execute();
                $alldata = $stmt1->fetchAll();
                // fetch and display the records
                foreach ($alldata as $row) {
                    echo "<tr>" .
                        "<td>" . $row['id'] . "</td>" .
                        "<td>" . $row['name'] . "</td>" .
                        "<td>" . $row['age'] . "</td>" .
                        "<td>" . $row['gender'] . "</td>" .
                        "<td>" . $row['food'] . "</td>" .
                        "<td>" . $row['color'] . "</td>" .
                        "<td>
                            <a href='fillup.php?action=edit&id=" . $row['id'] . "'>Edit</a>
                        </td>" .
                        "<td>
                            <a href='?action=del&id=" . $row['id'] . "'>Delete</a>
                        </td>" .
                        "</tr>";
                }

                ?>
            </tbody>
        </table>
    </main>
    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Soumyadeep Saha. All rights reserved.</p>
            <p>Made with <span>&hearts;</span> by Soumyadeep Saha</p>
        </div>
    </footer>
</body>

</html>