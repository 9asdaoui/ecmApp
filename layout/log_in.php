<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Advanced Login Page</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>
        body {
        margin: 0;
        font-family: 'Arial', sans-serif;
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #fff;
        }

        .login-container {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        text-align: center;
        }

        .login-form h1 {
        font-size: 2em;
        color: #333;
        margin-bottom: 0.5em;
        }

        .login-form p {
        font-size: 1em;
        color: #666;
        margin-bottom: 2em;
        }

        .input-group {
        position: relative;
        margin-bottom: 1.5em;
        }

        .input-group input {
        width: 94%;
        padding: 10px;
        font-size: 1em;
        border: 1px solid #ccc;
        border-radius: 6px;
        background: #f9f9f9;
        color: #333;
        transition: border-color 0.3s ease;
        }

        .input-group input:focus {
        border-color: #2575fc;
        outline: none;
        }

        .input-group label {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 0.9em;
        pointer-events: none;
        transition: top 0.3s ease, font-size 0.3s ease;
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
        top: -10px;
        font-size: 0.8em;
        color: #2575fc;
        }

        .login-btn {
        width: 100%;
        padding: 10px;
        font-size: 1em;
        background: linear-gradient(135deg, #2575fc, #6a11cb);
        border: none;
        border-radius: 6px;
        color: #fff;
        cursor: pointer;
        transition: background 0.3s ease;
        }

        .login-btn:hover {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        }

        .form-footer {
        margin-top: 1em;
        }

        .form-footer a {
        color: #2575fc;
        text-decoration: none;
        font-size: 0.9em;
        margin: 0 10px;
        transition: color 0.3s ease;
        }

        .form-footer a:hover {
        color: #6a11cb;
        }

    </style>
  <div class="login-container">
    <div class="login-form">
      <h1>Welcome Back</h1>
      <p>Login to access your account</p>

      <form action="../core/router.php" method="POST">
        <div class="input-group">
          <input type="text" name="email" id="email" required>
          <label for="username">Username</label>
        </div>
        <div class="input-group">
          <input type="password" name="password" id="password" required>
          <input type="hidden" name="url" value="login">
          <label for="password">Password</label>
          <h2 style="color:red;">
            <?php 
              if (isset($_SESSION["error_message"])) {  
                echo $_SESSION["error_message"];
                unset($_SESSION["error_message"]);
                }            
            ?>
          </h2>
        </div>
        <button type="submit" class="login-btn" name="login-btn">Login</button>
      </form>

      <div class="form-footer">
        <a href="./sing_in.php">Sign up for an account</a>
      </div>
    </div>
  </div>
</body>
</html>

