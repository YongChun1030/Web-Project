<!DOCTYPE html>

<html lang="en">

    <head>

        <title>Automated Birthday-Wisher</title>
        <link rel="icon" href="assets/bd.jpg" type="image/png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="table.css">
    
    </head>
    
    <body>
    <div class="container">

<?php 
        require_once "pdo.php";
        $stmt = $pdo->query("SELECT * FROM student_data");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo '<table><thead>';
        echo "<tr><th>Name</th><th>Birth Date</th><th>Age</th><th>Address</th><th>Phone Number</th><th>Action</th></tr></thead>";

        foreach ($rows as $row) {
            echo "<tbody><tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['birth'] . "</td>";
            echo "<td>" . $row['age'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['phonenum'] . "</td>";
            echo "<td><a href='edit.php?phonenum=" . urlencode($row['phonenum']) . "'><button>Edit</button></a></td>";
            echo "</tr></tbody>";
        }

        echo "</table>";
?>

    <a href='main.php'><button class="btn btn-outline-secondary btn-lg">Back to Home Page</button></a>
</div>
</body> 
    
</html>
