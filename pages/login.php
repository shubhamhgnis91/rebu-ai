<html>
<head>
  <title>
    Sign in
  </title>
  <link rel="stylesheet" type="text/css" href="../css/login_signup.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
  <script>
    function validateEmail()
      {
        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if(!document.getElementsByName("email")[0].value.match(validRegex))
        {
          window.alert("Please enter a valid Email");
          return false;

        }
        return true;
      }
  </script>

</head>
<body>
  <div class="main">
    <p class="sign">SIGN IN</p>
    <form class="form1" action="../pages/login.php" method="post">
      <input class="text-box" type="text" placeholder="Email" name="email" required>
      <input class="text-box" type="password" placeholder="Password" name="pass" required> 
      <input type="submit" name="submit" class="submit" value="Sign in" onclick="return validateEmail()">
      <p class="new">Not a member yet? <a href="../pages/register.php">Signup now</a></p>
    </form>

  </div>

</body>
</html>



<?php
session_start();
include "../includes/dbconn.php";

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $pass = md5($_POST["pass"]);

    $query = "select u_email,u_password from users where u_email='$email' and u_password='$pass'";
    $result = pg_query($query);
    $login_check = pg_numrows($result);
    if ($login_check > 0) {
        $_SESSION["email"] = $email;
        $query_1 =
            "select * from users where u_email='" . $_SESSION["email"] . "'";
        $r = pg_query($query_1);
        $arr = pg_fetch_row($r);
        $_SESSION["u_id"] = $arr[0];
        $_SESSION["template"] = "template_1.css";

        header("location: dashboard.php");
    } else {
        echo "Invalid Details";
    }
}


?>