<!DOCTYPE html>
<html>
<head>
    <title>Add New Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="background-image"></div>

    <div class="form-box">
        <div class="container">
            <h1><b>Add New Data</b></h1>

            <?php
            $pdo = new PDO('mysql:host=localhost;dbname=webassignment', 'root', '');
            $stmt = $pdo->query("SELECT * FROM student_data");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $studentname = $_POST['studentname'];
                $studentbirth = $_POST['studentbirth'];
                $studentage = $_POST['studentage'];
                $studentaddress = $_POST['studentaddress'];
                $studentphone = $_POST['studentphone'];

                $errors = array();

                // Validate text fields are not empty
                if (empty($studentname)) {
                    $errors[] = "Name is required.";
                }
                if (empty($studentbirth)) {
                    $errors[] = "Date of birth is required.";
                }
                if (empty($studentage)) {
                    $errors[] = "Age is required.";
                }
                if (empty($studentaddress)) {
                    $errors[] = "Address is required.";
                }
                if (empty($studentphone)) {
                    $errors[] = "Phone number is required.";
                }

                if (empty($errors)) {
                    $sqlCheck = "SELECT COUNT(*) FROM student_data WHERE phonenum = :studentphone";
                    $stmtCheck = $pdo->prepare($sqlCheck);
                    $stmtCheck->execute(array(':studentphone' => $studentphone));
                    $count = $stmtCheck->fetchColumn();

                    if ($count > 0) {
                        $phonemessage = "Phone number already exists.";
                    } else {
                        $sqlInsert = "INSERT INTO student_data (name, birth, age, address, phonenum) VALUES (:studentname, :studentbirth, :studentage, :studentaddress, :studentphone)";
                        $stmtInsert = $pdo->prepare($sqlInsert);
                        $success = $stmtInsert->execute(array(
                            ':studentname' => $studentname,
                            ':studentbirth' => $studentbirth,
                            ':studentage' => $studentage,
                            ':studentaddress' => $studentaddress,
                            ':studentphone' => $studentphone
                        ));

                        if ($success) {
                            $successmessage = "Successful insert";
                        } else {
                            $successmessage = "Insert failed";
                        }
                    }
                } else {
                    // Display the error messages
                    foreach ($errors as $error) {
                        echo '<p class="error-message">' . $error . '</p>';
                    }
                }
            }

            if (isset($phonemessage)) {
                echo '<p class="phone-error-message">' . $phonemessage . '</p>';
            }

            if (isset($successmessage)) {
                echo '<p class="success-message">' . $successmessage . '</p>';
            }
            ?>

            <form method="post">
                <div class="form-group">
                    <label for="studentname" class="form-label">Name:</label>
                    <input type="text" name="studentname" id="studentname" class="form-control" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="studentbirth" class="form-label">Date of birth:</label>
                    <input type="text" name="studentbirth" id="studentbirth" class="form-control" placeholder="Year-Month-Date">
                </div>
                <div class="form-group">
                    <label for="studentage" class="form-label">Age:</label>
                    <input type="text" name="studentage" id="studentage" class="form-control" placeholder="Enter Age">
                </div>
                <div class="form-group">
                    <label for="studentaddress" class="form-label">Address:</label>
                    <input type="text" name="studentaddress" id="studentaddress" class="form-control" placeholder="Enter address">
                </div>
                <div class="form-group">
                    <label for="studentphone" class="form-label">Phone Number:</label>
                    <input type="text" name="studentphone" id="studentphone" class="form-control" placeholder="Enter phone number">
                </div>

                <div class="button-container">
                    <button type="submit" class="btn btn-primary btn-add-new">Add New</button>
                    <a href="main.php" class="btn btn-secondary btn-home">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
