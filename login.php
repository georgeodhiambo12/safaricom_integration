<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TenderSoko</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #0288d1;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .input-group input:focus {
            outline: none;
            border-color: #0288d1;
        }

        .input-group .toggle-password {
            position: absolute;
            right: 10px;
            top: 40px;
            cursor: pointer;
        }

        .submit-button {
            width: 100%;
            padding: 10px;
            background-color: #0288d1;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #0277bd;
        }

        .form-footer {
            text-align: center;
            margin-top: 10px;
        }

        .form-footer a {
            color: #0288d1;
            text-decoration: none;
            transition: color 0.3s;
        }

        .form-footer a:hover {
            color: #0277bd;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Login</h2>
    <form action="dashboard.php" method="post">
        <div class="input-group">
            <label for="phone_number">Phone Number:</label>
            <input type="tel" id="phone_number" name="phone_number" required>
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <span class="toggle-password" onclick="togglePassword('password')">👁️</span>
        </div>
        <button type="submit" class="submit-button">Login</button>
    </form>
    <div class="form-footer">
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const passwordType = passwordField.getAttribute('type');
        if (passwordType === 'password') {
            passwordField.setAttribute('type', 'text');
        } else {
            passwordField.setAttribute('type', 'password');
        }
    }
</script>

</body>
</html>
