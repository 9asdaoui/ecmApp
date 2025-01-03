<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Advanced Sign-Up Page</title>
  <link rel="stylesheet" href="signup.css">
</head>
<body>
    <style>

            body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
            }

            .signup-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            }

            .signup-form h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 0.5em;
            }

            .signup-form p {
            font-size: 1em;
            color: #666;
            margin-bottom: 2em;
            }

            .input-group {
            position: relative;
            margin-bottom: 1.5em;
            }

            .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: #f9f9f9;
            color: #333;
            transition: border-color 0.3s ease;
            }

            .input-group input:focus {
            border-color: #ff7e5f;
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
            color: #ff7e5f;
            }

            .signup-btn {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            border: none;
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
            }

            .signup-btn:hover {
            background: linear-gradient(135deg, #feb47b, #ff7e5f);
            }

            .form-footer {
            margin-top: 1em;
            }

            .form-footer p {
            font-size: 0.9em;
            color: #666;
            }

            .form-footer a {
            color: #ff7e5f;
            text-decoration: none;
            transition: color 0.3s ease;
            }

            .form-footer a:hover {
            color: #feb47b;
            }

    </style>
  <div class="signup-container">
    <div class="signup-form">
      <h1>Create Account</h1>
      <p>Join us and start your journey!</p>

      <form action="../src/router.php" method="POST">

        <div class="input-group">
          <input type="text" name="fullname" id="fullname" required>
          <label for="fullname">Full Name</label>
        </div>
        <div class="input-group">
          <input type="email" name="email" id="email" required>
          <label for="email">Email</label>
        </div>
        <div class="input-group">
          <input type="password" name="password" id="password" required>
          <label for="password">Password</label>
        </div>
        <div class="input-group">
          <input type="password" name="confirm_password" id="confirm_password" required>
          <label for="confirm_password">Confirm Password</label>
          <input type="hidden" name="url" value="sign">

        </div>
        <button type="submit" class="signup-btn" name="signup-btn">Sign Up</button>
      </form>
      <div class="form-footer">
        <p>Already have an account? <a href="./log_in.php">Login here</a></p>
      </div>
    </div>
  </div>
</body>
</html>
