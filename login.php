<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the entered username and password
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Perform login validation (replace this with your actual implementation)
  // Example: Check against a database of registered users
  $registeredUsers = array(
    array('name' => 'John Doe', 'position' => 'Counselor', 'username' => 'admin', 'password' => 'password'),
    array('name' => 'Jane Smith', 'position' => 'Counselor', 'username' => 'jane', 'password' => '123456')
  );

  $loginSuccessful = false;

  foreach ($registeredUsers as $user) {
    if ($username === $user['username'] && $password === $user['password']) {
      // Set user information in session
      $_SESSION['user'] = array(
        'name' => $user['name'],
        'position' => $user['position'],
        'username' => $user['username']
      );

      // Reset login attempts
      $_SESSION['login_attempts'] = 0;

      $loginSuccessful = true;
      break;
    }
  }

  if ($loginSuccessful) {
    // Redirect to the dashboard page after successful login
    header('Location: excel.php');
    exit;
  } else {
    // Increment login attempts and check if maximum attempts reached
    if (!isset($_SESSION['login_attempts'])) {
      $_SESSION['login_attempts'] = 1;
    } else {
      $_SESSION['login_attempts']++;

      $maxLoginAttempts = 3;
      $loginAttemptsLeft = $maxLoginAttempts - $_SESSION['login_attempts'];

      if ($_SESSION['login_attempts'] >= $maxLoginAttempts) {
        // Block the user after maximum attempts reached
        header('Location: blockpage.html');
        exit;
      }
    }

    // Redirect back to the login page with an error message
    $errorMessage = 'Invalid username or password. Please try again.';
    if ($loginAttemptsLeft > 0) {
      $errorMessage .= ' You have ' . $loginAttemptsLeft . ' attempt(s) left before being blocked.';
    }
    header('Location: index.php?error=' . urlencode($errorMessage));
    exit;
  }
}
