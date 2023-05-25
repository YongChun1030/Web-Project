<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Login</h1>
    <form action="login.php" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <button type="submit">Login</button>
    </form>
    <?php
    if (isset($_GET['error'])) {
      $errorMessage = $_GET['error'];
      echo '<p class="error">' . $errorMessage . '</p>';
    }
    ?>
  </div>
</body>
</html>
