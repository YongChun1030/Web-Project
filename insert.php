<?php
    $pdo = new PDO('mysql:host=localhost;dbname=webassignment','root', '');
    $stmt = $pdo->query("SELECT * FROM student_data");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<table border="1">'."\n";
    echo '<tr><th>Name</th> <th>Date of birth</th> <th>Age</th> <th>Address</th></tr>';
    foreach ($rows as $row) {
        echo "<tr><td>";
        echo $row['name'];
        echo "</td><td>";
        echo $row['birth'];
        echo "</td><td>";
        echo $row['age'];
        echo "</td><td>";
        echo $row['address'];
        echo "</td></tr>\n";
    }
    echo "</table>\n";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $studentname = $_POST['studentname'];
        $studentbirth = $_POST['studentbirth'];
        $studentage = $_POST['studentage'];
        $studentaddress = $_POST['studentaddress'];

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

        // If there are no errors, insert the data and redirect
        if (empty($errors)) {
            $sql = "INSERT INTO student_data (name, birth, age, address) VALUES (:studentname, :studentbirth, :studentage, :studentaddress)";
            $stmt = $pdo->prepare($sql);
            $success = $stmt->execute(array(
                ':studentname' => $studentname,
                ':studentbirth' => $studentbirth,
                ':studentage' => $studentage,
                ':studentaddress' => $studentaddress
            ));

            if ($success) {
                echo "Successful insert";
                echo '<script>alert("The data had been successful insert!");</script>';
                 // Redirect to avoid form resubmission
                echo '<script>window.location.href = "insert.php";</script>';
                exit();
            } else {
                echo "Unsuccessful insert";
            }
        } else {
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
        }
    }
?>

<html>
<head></head>
<body>
    <p>Add New Data</p>
    <form method="post">
        <p>Name:<input type="text" name="studentname"></p>
        <p>Date of birth:<input type="text" name="studentbirth"></p>
        <p>Age:<input type="text" name="studentage"></p>
        <p>Address:<input type="text" name="studentaddress"></p>
        <p><input type="submit" value="Add New"></p>
    </form>

    <!-- Home button -->
    <form action="main.php">
        <p><input type="submit" value="Home"></p>
    </form>
</body>
</html>
