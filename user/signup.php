<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
    include('layout/DB.php'); // Include your database connection file

    if(isset($_POST["signup"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        
        // Validate name
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            echo "<script>
            alert('Name should be only alphabets');
            window.location.href='signup.php';
            </script>";
        }

        // Validate phone number
        if (!preg_match('/^[0-9]{10}$/', $phone)) {
            echo "<script>
            alert('Enter a valid phone number');
            window.location.href='signup.php';
            </script>";
        }

        // Validate and sanitize email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            echo "<script>
            alert('Enter a valid email address');
            window.location.href='signup.php';
            </script>";
        }

        // Check for duplicate email in the database
        $check_duplicate = "SELECT email FROM user WHERE email = '$email'";
        $result_check = $conn->query($check_duplicate);
        if ($result_check->num_rows > 0) {
            echo "<script>
            alert('Email already registered');
            window.location.href='signup.php';
            </script>";
        }

        // Hash the password
        $hashed_password = md5($password);

        // Insert user into the database
        $sql = "INSERT INTO user (uname, uphone, email, upassword) VALUES ('$name', '$phone', '$email', '$hashed_password')";
        $result = $conn->query($sql);

        if ($result) {
            echo "<script>
            alert('Signup successful');
            window.location.href='login.php';
            </script>";
        } else {
            echo "<script>
            alert('Signup failed');
            window.location.href='signup.php';
            </script>";
        }
    }
?>

<form action="signup.php" method="post" autocomplete="off">
    <h2>Sign Up</h2>
    <label for="name">Full Name:</label>
    <input type="text" id="name" maxlength="30" name="name" required>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" minlength="10" maxlength="10" name="phone" required>

    <label for="email">Email:</label>
    <input type="email" id="email" maxlength="50" name="email" required>

    <label for="password">Password:</label>
    <input type="password" id="password" minlength="10" maxlength="10" name="password" required>

    <button type="submit" name="signup" value="Signup">Sign Up</button>
</form>

</body>
</html>
