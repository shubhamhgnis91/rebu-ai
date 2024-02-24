<?php
    if(!isset($_SESSION["u_id"]))
    {
        echo '<script>
                window.alert("You must login first!");
                window.location="login.php";
              </script>';
    }
