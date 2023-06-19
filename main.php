<?php
    require_once "auto.php";
?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <title>Automated Birthday-Wisher</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      
        <link rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="main.css">
    
    </head>
    
    <body>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" 
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" 
        crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" 
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" 
        crossorigin="anonymous"></script>

        <header class="page-header header container-fluid">
            <div class="overlay"></div>
            <div class="description">
                <h1><strong>Automated Birthday Wisher</strong></h1>
                <h4>Never miss a birthday again! Introducing our automated birthday wisher website, 
                    the perfect solution to effortlessly send heartfelt birthday wishes to your loved ones. 
                    Say goodbye to last-minute scrambling and let our automated system do the work for you. 
                    Spread joy and make every birthday special with personalized messages that are sent automatically, 
                    ensuring that no one's special day goes unnoticed. 
                    Celebrate with ease and let technology make your birthday wishes truly unforgettable.</h4>
                    
                    <a href='insert.php'><button class="btn btn-outline-secondary btn-lg">Insert Data</button></a>
                    <a href='excel.php'><button class="btn btn-outline-secondary btn-lg">Upload Excel File</button></a>
                    <a href='viewData.php'><button class="btn btn-outline-secondary btn-lg">View Data</button></a>

                    <p><a href='index.php'><button class="btn btn-outline-secondary btn-lg">Log Out</button></a></p>
                   

            </div>
            
        </header>
                <script src="script.js"></script>  
    </body> 
    
</html>
