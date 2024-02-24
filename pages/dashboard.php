<?php
session_start();
include "../includes/session_check.php";
include "../includes/dbconn.php";

$query = "select * from resume where u_id='" . $_SESSION["u_id"] . "'";
$result = pg_query($dbconn, $query);
$_SESSION["rflag"] = 0;

if ($result) {
    $num = pg_numrows($result);

    if ($num >= 1) {
        $_SESSION["rflag"] = 1;
    }
}
?>

<html>
    <head>
        <title>
            Dashboard
        </title>
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
        <script>
            function myFunction() {
                if(confirm("Are you sure you want to delete ?"))
                    window.location = "../pages/delete_res.php";
                
            }
        </script>
    </head>
    <body>

        <div class="navigation-bar">
        <img class="logo" src="../images/logo.png" style="padding-right: 20px;">
            <ul>
                <li><a class="nav-links" href="../index.php">Home</a></li>
                
                <?php if ($_SESSION["rflag"] == 1) {
                    echo '<li><a class="nav-links" href="../pages/view_resume.php">My Resume</a></li>';
                } ?>

                <button class="bt1"><a href="../pages/logout.php">Sign Out</a></button>
            </ul>
        </div>
        
        <h1>
            Welcome <?php echo $_SESSION["email"]; ?>!
        </h1>

        <span>
            It's good to have you here.
        </span>
       <div class="mid-container">
            <?php if ($_SESSION["rflag"] == 0) {
                echo "<h4>You have not made a resume yet </h4>";
                echo "<h4>Build your Resume Now! </h4>";
                echo '<button class="bt2"><a href="../pages/education.php">Try it Now</a></button>';
            } else {
                echo "<h4> You have already made a Resume here. </h4>";
                echo "<h4> You can make changes to it </h4>";
                echo '<button class="bt2"><a href="../pages/update_edu.php">Update Details</a></button>';
                echo "<h4> Or if you want to delete it, here </h4>";
                echo '<button class="bt2" onclick="myFunction()"><a>Delete</a></button>';
            } ?>
        </div>

<?php
include "../templates/footer.php";
?>