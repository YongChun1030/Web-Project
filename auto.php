<?php
$host = 'localhost';
$dbname = 'webassignment';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Kuala_Lumpur');
use Twilio\Rest\Client;

function get_upcoming_birthdays($pdo)
{

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
    $auth_token = "c241abd8f229aad95da4e909c01ef4ed";
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

$upcoming_birthdays = get_upcoming_birthdays($pdo);

// Send birthday wishes to each upcoming birthday
foreach ($upcoming_birthdays as $birthday) {
    send_birthday_wishes($birthday['name'], $birthday['phonenum']);
}
?>
