<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Welcome to the main page</p>

    <button onclick="insertData()">Insert data</button>
    <button onclick="uploadExcel()">Upload excel</button>

    <script>
        function insertData() {
            window.location.href = "insert.php";
        }

        function uploadExcel() {
            window.location.href = "excel.php";
        }
    </script>
</body>
</html>