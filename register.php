<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pogi.css">
    <title>Register</title>
</head>
<body>
<a href="index.php"><button class='button'>Back to Resume</button></a>
      <style>
                                          <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .button {
            padding: 10px 20px;
            border-radius: 10px;
            border: 0;
            background-color: rgb(255, 56, 86);
            letter-spacing: 1.5px;
            font-size: 15px;
            transition: all 0.3s ease;
            box-shadow: rgb(201, 46, 70) 0px 10px 0px 0px;
            color: hsl(0, 0%, 100%);
            cursor: pointer;
            margin-top: 40px;
            margin-left: 20px;
            text-decoration: none;
            display: inline-block;
        }

        .button:hover {
            box-shadow: rgb(201, 46, 70) 0px 7px 0px 0px;
        }

        .button:active {
            background-color: rgb(255, 56, 86);
            box-shadow: rgb(201, 46, 70) 0px 0px 0px 0px;
            transform: translateY(5px);
            transition: 200ms;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 20px;
        }

        .box {
            width: 400px; /* Adjust the width as needed */
            /* Your existing styles go here */
        }
    </style>
      <div class="container">
        <div class="box form-box">
        <?php
include("config.php");

if (isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $repeatpassword = isset($_POST['repeatpassword']) ? $_POST['repeatpassword'] : '';

    // Verify unique email
    $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");

    if (mysqli_num_rows($verify_query) != 0) {
        echo "<div class='message'>
                  <p>This email is used, Try another One Please!</p>
              </div> <br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
    } else {
        // Check if passwords match
        if ($password != $repeatpassword) {
            echo "<div class='message'>
                      <p>Passwords do not match, please try again!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
        } else {
            // Hash the password before storing in the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert user data into the database
            $insert_query = mysqli_query($con, "INSERT INTO users (Username, Email, Password) VALUES ('$username', '$email', '$hashedPassword')") or die("Error Occurred");

            echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
            echo "<a href='login.php'><button class='btn'>Login Now</button>";
        }
    }
} else {
?>


            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Repeat Password</label>
                    <input type="password" name="repeatpassword" id="repeatpassword" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Have you already sent me a message? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>