<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>

        <?php
        $servername = "localhost";
        $dbname = "testphpdb";
        $username = "root";
        $password = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'reg_form') {

            $data = [
                'email' => $_REQUEST['email'],
                'pass' => $_REQUEST['pswd'],
            ];
            try {
                $sql = "INSERT INTO registration (reg_email, reg_pass) VALUES (:email, :pass)";
                $stmt = $conn->prepare($sql);
                $stmt->execute($data);
                echo 'Insert Successfully.';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        ?>

        <div class="container mt-3">
            <h2>Stacked form</h2>
            <form method="POST">
                <div class="mb-3 mt-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="mb-3">
                    <label for="pwd">Password:</label>
                    <input type="text" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
                </div>
                <input type="hidden" name="action" value="reg_form">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </body>
</html>
