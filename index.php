<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <title>Automated Birthday-Wisher</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="login.php" method="post">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" name="username" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="">Password</label>
                    </div>
                    <div class="remember">
                        <label for=""><input type="checkbox" name="remember">Remember Me</label>
                    </div>
                    <button type="submit">Log in</button>                  
                    
                </form>
                <?php
                if (isset($_GET['error'])) {
                  $errorMessage = $_GET['error'];
                  echo '<p class="error">' . $errorMessage . '</p>';

                  if ($errorMessage === 'You have been blocked.') {
                    echo '<p class="error">Please contact the administrator for assistance.</p>';
                  }
                }
                ?>
            </div>
            
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
