<?php 
   session_start();

   include("config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: login.php");
   }
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style/style.css" rel="stylesheet" />
  <title>Your Page Title</title>
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




  <div id="container">
  
  <?php
ob_start();


if (isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $state = isset($_POST['state']) ? $_POST['state'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $street = isset($_POST['street']) ? $_POST['street'] : '';
    $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Insert into the correct database table (user_messages)
    $stmt = mysqli_prepare($con, "INSERT INTO user_messages(username, email, telephone, country, state, city, street, subject, message) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "sssssssss", $username, $email, $telephone, $country, $state, $city, $street, $subject, $message);

    if (mysqli_stmt_execute($stmt)) {
        echo "<div class='message'>
                <p>Your message has been sent!</p>
              </div> <br>";

        // Redirect to index.html after successful submission
        header("Location: index.html");
        exit();
    } else {
        echo "<div class='message'>
                <p>Error sending the message. Please try again.</p>
              </div> <br>";
    }

    mysqli_stmt_close($stmt);
}
ob_end_flush();
?>
    
    <h1>&bull; Keep in Touch &bull;</h1>
    <div class="underline"></div>
    <div class="icon_wrapper">
      <svg class="icon" viewBox="0 0 145.192 145.192">
        
      </svg>
    </div>
    <form action="" method="post" id="contact_form">
      <div class="name">
        <label for="username"></label>
        <input type="text" placeholder="My name is" name="username" id="username" required>
      </div>

      <div class="email">
        <label for="email"></label>
        <input type="email" placeholder="Actual email Please :>" name="email" id="email" required>
      </div>
      <div class="telephone">
        <label for="telephone"></label>
        <input type="text" placeholder="My number is" name="telephone" id="telephone_input" required>
      </div>
      <div class="select_option">
    <div class="select_pair">
        <label for="country">Country</label>
        <select class="form-select country" name="country" aria-label="Default select example" onchange="loadStates()">
            <option selected>Select Country</option>
        </select>
    </div>
    <div class="select_pair">
        <label for="state">Region</label>
        <select class="form-select state" name="state" aria-label="Default select example" onchange="loadCities()">
            <option selected>Region</option>
        </select>
    </div>
    <div class="select_pair">
        <label for="city">City</label>
        <select class="form-select city" name="city" aria-label="Default select example" >
            <option selected>Select City</option>
        </select>
    </div>
</div>

    
      <div class="select_pair">
        <label for="street"></label>
        <input type="text" name="street" id="street" placeholder="Street" required>
      </div>

      <div class="subject">
        <label for="subject"></label>
        <select placeholder="Subject line" name="subject" id="subject" required>
          <option disabled hidden selected>Subject line</option>
          <option>I'd like to start a project</option>
          <option>I'd like to ask a question</option>
          <option>I'd like to make a proposal</option>
        </select>
      </div>
      <div class="message">
        <label for="message"></label>
        <textarea name="message" placeholder="I'd like to chat about" id="message" cols="30" rows="5" required></textarea>
      </div>

      <div class="submit">
        <input type="submit" value="Send Message" id="form_button" name="submit" />
      </div>
    </form><!-- // End form -->
  </div><!-- // End #container -->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script> 
<script src="option.js"></script>
</body>
</html>
