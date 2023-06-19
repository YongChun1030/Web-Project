<?php

    require_once "pdo.php";
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    date_default_timezone_set('Asia/Kuala_Lumpur');
    use Twilio\Rest\Client;
    
    function get_upcoming_birthdays()
    {
        global $pdo;
    
        // Get the current date
        $current_date = date('Y-m-d');
    
        try {
            // Prepare the SQL query
            $query = "SELECT name, phonenum FROM student_data WHERE DAY(birth) = DAY(:current_date) AND MONTH(birth) = MONTH(:current_date)";
            $statement = $pdo->prepare($query);
    
            // Bind the parameter
            $statement->bindParam(':current_date', $current_date);
    
            // Execute the query
            $statement->execute();
    
            // Fetch all the matching records
            $upcoming_birthdays = $statement->fetchAll(PDO::FETCH_ASSOC);
    
            return $upcoming_birthdays;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    
    function send_birthday_wishes($name, $phone_number)
    {
        require_once 'vendor\twilio-php-7.4.2\src\Twilio\autoload.php';
    
        $account_sid = "ACc3a0c089708b05f1a0880c43d95e1413";
        $auth_token = "d473ad4d8959a6579080be5fa14bb670";
        $twilio_phone_number = '+14155238886';
    
        $twilio = new Client($account_sid, $auth_token);
    
        $message = "Happy birthday, $name! 🎉🎂";
    
        $twilio->messages->create(
            "whatsapp:$phone_number",
            array(
                'from' => "whatsapp:$twilio_phone_number",
                'body' => $message
            )
        );
    }

    // Get the current time without seconds
    $current_time = date('H:i');

    // Display the current time in the console
    echo "Current time: " . $current_time . "\n";


        $upcoming_birthdays = get_upcoming_birthdays();

        // Send birthday wishes to each upcoming birthday
        foreach ($upcoming_birthdays as $birthday) {
            send_birthday_wishes($birthday['name'], $birthday['phonenum']);
     }
?>
