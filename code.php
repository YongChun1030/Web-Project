<?php
session_start();
require_once "pdo.php";
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_excel_data'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $validData = true; // Flag variable for data validity

        foreach ($data as $row) {
            if ($count > 0) {
                $name = $row[0] ?? '';
                $birth = $row[1] ?? '';
                $age = $row[2] ?? '';
                $address = $row[3] ?? '';
                $number = $row[4] ?? '';

                if (!empty($name) && !empty($birth) && !empty($age) && !empty($address) && !empty($number)) {
                    // Check for duplicate phone number
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM student_data WHERE phonenum = ?");
                    $stmt->execute([$number]);
                    $count = $stmt->fetchColumn();

                    if ($count == 0) {
                        $studentQuery = "INSERT INTO student_data (name, birth, age, address, phonenum) VALUES (?, ?, ?, ?, ?)";
                        $stmt = $pdo->prepare($studentQuery);
                        $stmt->execute([$name, $birth, $age, $address, $number]);
                    } else {
                        // Duplicate phone number detected
                        $_SESSION['message'] = "Duplicate phone number detected: " . $number;
                        $validData = false; // Invalid data detected
                        break; // Stop processing further rows
                    }
                } else {
                    $_SESSION['message'] = "Invalid data format in the Excel file. Please check the columns.";
                    $validData = false; // Invalid data detected
                    break; // Stop processing further rows
                }
            } else {
                $count = 1;
            }
        }

        if ($validData) {
            $_SESSION['message'] = "Data imported successfully!";
        }
    } else {
        $_SESSION['message'] = "Invalid File";
    }

    header('Location: excel.php');
    exit();
}
?>
