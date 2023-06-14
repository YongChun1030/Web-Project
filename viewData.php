<!DOCTYPE html>

<html lang="en">

    <head>

        <title>Automated Birthday-Wisher</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="table.css">
    
    </head>
    
    <body>
    <div class="container">

<?php 
        include('config.php');
        $stmt = $conn->query("SELECT * FROM student_data");
        $rows = $stmt->fetch_all(MYSQLI_ASSOC);
            
        echo '<table><thead>';

        echo ("<tr><th>Name</th><th>Birth Date</th><th>Age</th><th>Address</th><th>Phone Number</th></tr></thead>");
        
        foreach ( $rows as $row ) {
            echo "<tbody><tr><td>";
            echo($row['name']);
            echo("</td><td>");
            echo($row['birth']);
            echo("</td><td>");
            echo($row['age']);
            echo("</td><td>");
            echo($row['address']);
            echo("</td><td>");
            echo($row['number']);
            echo("</td></tr></tbody>");
        }

        echo "</table>";
?>

    <a href='main.php'><button class="btn btn-outline-secondary btn-lg">Back to Home Page</button></a>
    <a href='#'><button class="btn btn-outline-secondary btn-lg">Other</button></a>
</div>
</body> 
    
    </html>

