<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Validate.js CDN -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>

    <title>Fill Form</title>

    <style>
        .myForm input[type="reset"] {
            background-color: #F44336;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .myForm button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .myForm input[type="reset"]:hover {
            background-color: #7E1F1F;
        }

        .myForm button[type="submit"]:hover {
            background-color: #3e8e41;
        }
    </style>

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

    <?php

    //CONNECTION ESTABLISHMENT************************************************************************************

    try {
        $server = "localhost";
        $user = "root";
        $password = "";
        $dbName = "survey";
        // Create connection
        $dbcon = new PDO("mysql:host=$server; dbname=$dbName", $user, $password);
        // set the PDO error mode to exception
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    //IF UPDATE i.e. ID PASSED************************************************************************************
    //THEN STORE EXISTING RECORD IN $alldata

    if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
        $id = $_REQUEST["id"];

        $stmt1 = $dbcon->prepare("SELECT * FROM form WHERE id = :id");
        $stmt1->bindParam(':id', $id);
        $stmt1->execute();
        $alldata = $stmt1->fetch();
    }

    //AFTER SUBMIT BUTTON CLICKED, STORE ENTERED DATA IN FIVE VARIABLES*******************************************

    if (isset($_REQUEST['action2']) && $_REQUEST['action2'] == 'submit_form') {
        $name = $_REQUEST["name"];
        $age = $_REQUEST["age"];
        $gender = $_REQUEST["gender"];
        $favFood = $_REQUEST["favFood"];
        $color = $_REQUEST["color"];


        if (empty($name) || empty($age) || empty($gender) || empty($favFood) || empty($color)) {
            echo 'Error: Invalid form data.';
        } else {

            // IF ACTION == EDIT i.e., UPDATE WAS CLICKED THEN EXECUTE IF BLOCK
            // OTHERWISE EXECUTE ELSE BLOCK

            if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
                $id2 = $_REQUEST["id"];
                $updatequery = " UPDATE form SET name= :name,age= :age,gender= :gender,food= :food,color= :color WHERE id = :id ";
                $stmt = $dbcon->prepare($updatequery);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':age', $age);
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':food', $favFood);
                $stmt->bindParam(':color', $color);
                $stmt->bindParam(':id', $id2);
                $stmt->execute();
                //$stmt->debugDumpParams();
                echo "<br><h2>The record has been updated!</h2>";

                //echo "<meta http-equiv="refresh" content="3; url=view.php">";
                header('Location: view.php');
                exit();
            } else {
                $insertquery = "insert into form (name, age, gender, food, color) values(:name, :age, :gender, :food, :color)";
                $stmt = $dbcon->prepare($insertquery);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':age', $age);
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':food', $favFood);
                $stmt->bindParam(':color', $color);
                $stmt->execute();
                //$stmt->debugDumpParams();
                echo "<br><h2>Your response has been recorded!</h2>";
                header('Location: fillup.php');
            }
        }
    }

    ?>

    <!-- HTML FORM  -->

    <form id="myForm" class="myForm" name="myForm" method="post" onsubmit="return validateForm()">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" placeholder="Enter NAME" value="<?php echo !empty($alldata['name']) ? $alldata['name'] : ''; ?>">
        <br><span class="formerror"></span><br>

        <label for="age">Age:</label><br>
        <input type="number" id="age" name="age" placeholder="Enter AGE" value="<?php echo !empty($alldata['age']) ? $alldata['age'] : ''; ?>">
        <br><span class="formerror"></span><br>

        <label for="gender">Gender:</label><br>
        <input type="radio" id="male" name="gender" value="Male" <?php echo (!empty($alldata['gender']) && $alldata['gender'] == 'Male') ? 'checked="checked"' : ''; ?>> Male<br>
        <input type="radio" id="female" name="gender" value="Female" <?php echo (!empty($alldata['gender']) && $alldata['gender'] == 'Female') ? 'checked="checked"' : ''; ?>> Female<br>
        <input type="radio" id="other" name="gender" value="Other" <?php echo (!empty($alldata['gender']) && $alldata['gender'] == 'Other') ? 'checked="checked"' : ''; ?>> Other<br><br>
        <br><span class="formerror"></span><br>

        <label for="favFood">What is your favourite food?</label><br>
        <input type="radio" id="biriyani" name="favFood" value="Biriyani" <?php echo (!empty($alldata['food']) && $alldata['food'] == 'Biriyani') ? 'checked="checked"' : ''; ?>> Biriyani<br>
        <input type="radio" id="pulao" name="favFood" value="Pulao" <?php echo (!empty($alldata['food']) && $alldata['food'] == 'Pulao') ? 'checked="checked"' : ''; ?>> Pulao<br>
        <input type="radio" id="fried rice" name="favFood" value="Fried Rice" <?php echo (!empty($alldata['food']) && $alldata['food'] == 'Fried Rice') ? 'checked="checked"' : ''; ?>> Fried Rice<br><br>
        <br><span class="formerror"></span><br>

        <label for="color">What is your favourite colour?</label><br>
        <input type="text" id="color" name="color" placeholder="Enter FAVOURITE COLOUR" value="<?php echo !empty($alldata['color']) ? $alldata['color'] : ''; ?>">
        <br><span class="formerror"></span><br>

        <input type="reset" value="Reset">

        <input type="hidden" id="submitbtn" name="action2" value="submit_form">
        <button type="submit">Submit</button>
        <!-- <input type="submit" value="Submit"> -->
        <!-- <a href = '?action=reg_form'>Submit</a> -->

    </form>

<script>
    // Define the constraints
    var constraints = {
        name: {
            presence: true,
            length: {
                minimum: 1,
                message: "Please enter your name"
            }
        },
        age: {
            presence: true,
            numericality: {
                onlyInteger: true,
                greaterThan: 0,
                lessThanOrEqualTo: 100,
                message: "Please enter a valid age"
            }
        },
        gender: {
            presence: true,
            inclusion: {
                within: ["Male", "Female", "Other"],
                message: "Please select a gender"
            }
        },
        favFood: {
            presence: true,
            inclusion: {
                within: ["Biriyani", "Pulao", "Fried Rice"],
                message: "Please select a favourite food"
            }
        },
        color: {
            presence: true,
            length: {
                minimum: 1,
                message: "Please enter your favourite colour"
            }
        }
    };

    // Validate the form
    function validateForm() {
        var form = document.getElementById('myForm');
        var errors = validate(form, constraints);

        // If there are errors, show them
        if (errors) {
            console.log(errors);
            return false;
        }

        // If the form is valid, you can submit it
        return true;
    }
</script>





    <!-- <script src="validate.js"></script> -->

</body>
<footer>
    <div class="footer-content">
        <p>&copy; 2024 Soumyadeep Saha. All rights reserved.</p>
        <p>Made with <span>&hearts;</span> by Soumyadeep Saha</p>
    </div>
</footer>

</html>