<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    use Twilio\Rest\Client;
    require_once "pdo.php";
    
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
        $auth_token = "ac67e53227b14518ca294dbd3feabb7f";
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

    
        // Get the current hour
        $current_hour = date('H');

        // Display the current time in the console
        echo "Current time: " . date('H:i:s') . "\n";

        // Check if it's 12 AM
        if ($current_hour === '20') {
            $upcoming_birthdays = get_upcoming_birthdays();

            // Send birthday wishes to each upcoming birthday
            foreach ($upcoming_birthdays as $birthday) {
                send_birthday_wishes($birthday['name'], $birthday['phonenum']);
            }
        }

    
?>
