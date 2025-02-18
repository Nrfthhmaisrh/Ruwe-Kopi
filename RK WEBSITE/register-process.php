<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Ruwe Kopi</title>

    <form action="register-process.php" method="POST">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #faf3e0;
            color: #4a3f35;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signup-container {
            background-color: #fff;
            width: 350px;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        .signup-container h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: #4a3f35;
            margin-bottom: 20px;
        }

        .signup-container p {
            font-size: 0.95rem;
            color: #6e5d52;
            margin-bottom: 30px;
        }

        .signup-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .input-group i {
            margin-left: 5px;
            color: #bca99b;
        }

        .input-group input {
            flex-grow: 1;
            padding: 12px 15px;
            padding-left: 45px;
            border: 1px solid #d3b8a3;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #fef5e7;
            color: #4a3f35;
        }

        .input-group input:focus {
            outline: none;
            border-color: #6e5d52;
        }

        .btn {
            background-color: #4a3f35;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn:hover {
            background-color: #6e5d52;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .login-link {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #6e5d52;
        }

        .login-link a {
            text-decoration: none;
            color: #4a3f35;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .logo {
            width: 150px;
            height: auto;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

<div class="signup-container">
    <img src="Picture/logo.jpg" class="logo" alt="Ruwe Kopi Logo">
    <h1>Create Account</h1>
    <p>Sign up to explore Ruwe Kopi.</p>
    <form action="signup-process.php" method="POST">
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-group">
            <i class="fas fa-phone"></i>
            <input type="tel" name="phone_number" placeholder="Phone Number" required pattern="^[0-9]{10,15}$" title="Phone number should be 10 to 15 digits">
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        </div>
        <button type="submit" class="btn">Sign Up</button>
    </form>
    <p class="login-link">Already Have An Account? <a href="login.html">Login Here</a></p>
</div>

</body>
</html>
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = htmlspecialchars($_POST['username']);
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    // Validate passwords
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Save the data (example: using a database)
    // Assuming you're using MySQL with mysqli
    $servername = "localhost";
    $username_db = "root"; // Default username for XAMPP/WAMP
    $password_db = ""; // Default password for XAMPP/WAMP
    $dbname = "ruwe_kopi";

    // Create a connection
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO users (username, phone_number, password) VALUES ('$username', '$phone_number', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
