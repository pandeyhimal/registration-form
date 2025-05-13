<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login Page</title>
  <link rel="stylesheet" href="login.css" />
</head>
<body>
  <form action="login.php" method="POST">
    <h2>Login Form</h2>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required />

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required />

    <input type="submit" value="Login" />

    <div class="form-links">
      <a href="forgot-password.html">Forgot Password?</a>
      <span> | </span>
      <a href="register.html">Sign Up</a>
    </div>
  </form>
</body>
</html>
