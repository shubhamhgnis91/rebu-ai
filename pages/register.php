<html>
  <head>
    <title>
      Sign Up
    </title>
    <link rel="stylesheet" href="../css/login_signup.css" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
    <script>
      function validateForm()
      {
        
        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var maxLength=15,minLength=7;
        if(!document.getElementsByName("email")[0].value.match(validRegex))
        {
          window.alert("Please enter a valid Email");
          return false;

        }
        else if(document.getElementsByName("pass")[0].value!=document.getElementsByName("pass1")[0].value)
        {
            window.alert("Passwords should match!");
            return false;
        }
        else if(document.getElementsByName("pass")[0].value.length< minLength || document.getElementsByName("pass")[0].value.length>maxLength)
        {
          window.alert("Enter password between 7 and 15 characters");
          return false;
        }
        
        return true;

        
      }
     
    </script>
  </head>
  <body>
    <div class="main">
      <p class="sign">
        SIGN UP
      </p>
      <form class="form1" action="../pages/register.php" method="post">
      <input class="text-box" type="text" name="email" placeholder="Email" required>
      <input class="text-box" type="password" name="pass" placeholder="Password" required>
      <input class="text-box" type="password" name="pass1" placeholder="Confirm Password" required>
      <input class="submit" type="submit" name="submit" value="Sign Up" onclick="return validateForm()">
      <p class="exist">
        Already have an account? <a href="../pages/login.php">Login Here </a>
      </p>
      </form>
    </div>
  </body>
</html>

<?php
include "../includes/dbconn.php";
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $pass = md5($_POST["pass"]);

    $q1 = "select * from users where u_email='" . $email . "'";
    $t = pg_query($q1);
    $c = pg_numrows($t);
    if ($c > 0) {
        echo "User already exist with given Email!";
        die();
    }

    $query =
        "insert into users(u_email,u_password) values('" .
        $email .
        "','" .
        $pass .
        "')";
    pg_query($query);
    echo "Registered Succesfully";
}

?>
