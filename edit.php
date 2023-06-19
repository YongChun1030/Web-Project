<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "pdo.php";

if (isset($_GET['phonenum'])) {
    $inputPhoneNum = $_GET['phonenum'];
    $inputPhoneNum = trim($inputPhoneNum); // Remove leading/trailing whitespaces
    $phonenum = $inputPhoneNum;
    
    $stmt = $pdo->prepare("SELECT * FROM student_data WHERE phonenum = :phonenum");
    $stmt->execute([':phonenum' => $phonenum]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die('Record not found.'); // Stop execution and display an error message
    }
} else {
    die('No record specified.'); // Stop execution and display an error message
}

// Check if the form is submitted for updating the record
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the updated data from the form
    $phonenum = $_POST['phonenum'];
    $name = $_POST['name'];
    $birth = $_POST['birth'];
    $age = $_POST['age'];
    $address = $_POST['address'];

    // Validate input
    $errors = [];
    if (empty($name)) {
        $errors[] = 'Name is required.';
    }
    if (empty($birth)) {
        $errors[] = 'Birth date is required.';
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $birth)) {
        $errors[] = 'Invalid birth date format. Use yyyy-mm-dd.';
    }
    if (empty($age)) {
        $errors[] = 'Age is required.';
    } elseif (!is_numeric($age)) {
        $errors[] = 'Age must be a numeric value.';
    }
    if (empty($address)) {
        $errors[] = 'Address is required.';
    }
    if (empty($phonenum)) {
        $errors[] = 'Phone number is required.';
    } elseif (!preg_match('/^\+\d+$/', $phonenum)) {
        $errors[] = 'Invalid phone number format. Use "+xxxxxxxxxxx" format.';
    }

    if (empty($errors)) {
        // Update the record in the database
        $stmt = $pdo->prepare("UPDATE student_data SET name = :name, birth = :birth, age = :age, address = :address WHERE phonenum = :phonenum");
        $stmt->execute([
            ':name' => $name,
            ':birth' => $birth,
            ':age' => $age,
            ':address' => $address,
            ':phonenum' => $phonenum
        ]);

        // Redirect to the view page after the update is completed
        header("Location: viewData.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="edit.css">
</head>

<body>
    <div class="container">
        <h1>Edit Data</h1>
        <form method="post">
            <?php if (!empty($errors)) : ?>
                <div class="error">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="phonenum">Phone Number:</label>
                <input type="text" name="phonenum" id="phonenum" value="<?php echo $row['phonenum']; ?>" required pattern="\+\d+" title="Use '+xxxxxxxxxxx' format">
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="birth">Birth Date:</label>
                <input type="text" name="birth" id="birth" value="<?php echo $row['birth']; ?>" required pattern="\d{4}-\d{2}-\d{2}">
                <small>Format: yyyy-mm-dd</small>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" name="age" id="age" value="<?php echo $row['age']; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" value="<?php echo $row['address']; ?>" required>
            </div>
            <button type="submit">Update</button>
        </form>
        
        <br>
        <button class="cancel-button" onclick="location.href='main.php'">Cancel</button>
    </div>
</body>

</html>
