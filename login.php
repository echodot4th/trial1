<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pogi.css">
    <title>Login</title>
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
        if(isset($_POST['submit'])){
            $email = mysqli_real_escape_string($con,$_POST['email']);
            $password = mysqli_real_escape_string($con,$_POST['password']);

            $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$email'") or die("Select Error");
            $row = mysqli_fetch_assoc($result);

            if(is_array($row) && !empty($row) && password_verify($password, $row['Password'])) {
                $_SESSION['valid'] = $row['Email'];
                $_SESSION['username'] = $row['Username'];
                $_SESSION['id'] = $row['Id'];
                header("Location: message.php");
                exit(); // Ensure script stops after redirection
            } else {
                echo "<div class='message'>
                        <p>Wrong Username or Password</p>
                      </div> <br>";
                echo "<a href='login.php'><button class='btn'>Go Back</button>";
            }
        } else {
    ?>
    <header>Login</header>
    <form action="" method="post">
        <div class="field input">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" autocomplete="off" required>
        </div>

        <div class="field input">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" autocomplete="off" required>
        </div>

        <div class="field">
            <input type="submit" class="btn" name="submit" value="Login" required>
        </div>
        <div class="links">
            Don't have an account? <a href="register.php">Sign Up Now</a>
        </div>
    </form>
    <?php } ?>
</div>
</body>
</html>