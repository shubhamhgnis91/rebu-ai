<?php
include("../templates/sidepanel.php");
?>
<div class="main">
    <form action="../pages/education.php" method="post">
        Enter Institute's Name: <input type="text" name="institute" class="text-box" required> <br>
        Choose Type: <select name="type">
            <option value="Graduation">Graduation</option>
            <option value="Highschool">Highschool</option>
            <option value="Post Graduation">Post Graduation</option>
            <option value="Diploma">Diploma</option>

        </select><br>

        Enter Percentage : <input type="text" name="percent" required> <br>
        Enter Pass-out Year : <input type="text" name="year" required> <br>

        <input type="submit" name="submit" value="Submit">
    </form>
</div>

<?php
include("../templates/footer.php");
?>

<?php
session_start();
include "../includes/session_check.php";
include "../includes/dbconn.php";

if (isset($_POST["submit"])) {
    $inst = $_POST["institute"];
    $type = $_POST["type"];
    $percent = $_POST["percent"];
    $pyear = $_POST["year"];

    $query =
        "insert into edu_qual(e_institute,e_type,e_percent,e_year,u_id) values('" .
        $inst .
        "','" .
        $type .
        "','" .
        $percent .
        "','" .
        $pyear .
        "','" .
        $_SESSION["u_id"] .
        "')";
    $result = pg_query($query);
    if ($result) {
        echo '<div class="main"> <p>Details entered. You can add another record or go to <a href="work_history.php">next page</a>.</p></div> <br>';
    } else {
        echo "Some Error Occured";
    }
}


?>