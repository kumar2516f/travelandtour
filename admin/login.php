<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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


    if (isset($_POST["login"])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hass_pass= md5($password);

        include 'a_layout/DB.php';

        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM admin WHERE aemail ='$email' AND apassword='$hass_pass'";
                $result = $conn->query($sql);
        if($result)
        {
            $row = $result->fetch_assoc();
        session_start();
        $_SESSION["admin"] = $row;
        header("location:dashboard.php");
     
        }
        else
        {
            echo "<script>
            alert('login failed');
            window.location.href='login.php';
            </script>";
        }

    }
    ?>

    <form action="login.php" method="post">
        <h2>Admin Login</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="login" value="Login">Login</button>
    </form>

</body>
</html>
