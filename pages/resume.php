
<html>
    <head>
        <title>
            Personal Details
        </title>
        <link rel="stylesheet" type="text/css" href="../css/forms.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    </head>

    <style>
        .icon-wrapper {
            position: relative;
        }
        i{
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
        }
    </style>

    <body>
        <div class="snav">
                <a href="../index.php">Home</a>
                <a href="../pages/education.php">Education Details</a>
                <a href="../pages/work_history.php">Work Experience</a>
                <a href="../pages/resume.php" class="active">Personal Information</a>

        </div>
        <div class="main">
            <form action="../pages/resume.php" method="post">

            First name: <input type="text" name="fname"> <br>
            Last name: <input type="text" name="lname"> <br>
            Address: <input type="text" name="address"> <br>
            City: <input type="text" name="city"> <br>
            DOB : <input type="date" name="dob"> <br>
            Phone: <input type="text" name="phone"> <br>
            Skills (Enter skills seperated by comma "," ) : <input type="text" name="skills"> <br>
            Languages Known (Enter languages seperated by comma "," ) : <input type="text" name="lang"> <br>
            Enter your Hobbies (Enter hobbies seperated by comma "," ): <input type="text" name="hobbies"> <br>
            Applying for which role: <input type="text" name="job"> <br>
            Tell us about yourself : 
            <div class="icon-wrapper">
            <textarea name="inputDesc" id="inputDesc" rows="100" cols="100"> </textarea>
            <i class="fas fa-magic" onclick="processDescription()"></i>
            </textarea>
            </div>

            Enhanced Bio:
            <div class="icon-wrapper">
                <textarea id="enhancedDesc" readonly></textarea>
                <i class="fas fa-copy" onclick="copyEnhancedDescription()"></i>
            </div>
           


            <input type="submit" name="submit" value="Submit">
            </form>
        </div>
        <div class="footer">
            <p>ReBu 2023 &copy;</p>

        </div>


        <script src="../scripts/processBio.js"></script>
    
        <script>
            function copyEnhancedDescription() {
                var enhancedDesc = document.getElementById("enhancedDesc");
                var inputDesc = document.getElementById("inputDesc");
                inputDesc.value = enhancedDesc.value;
            }
        </script>

    </body>
        
</html>


<?php
session_start();
include "../includes/session_check.php";
include "../includes/dbconn.php";

if (isset($_POST["submit"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $dob = $_POST["dob"];
    $phone = $_POST["phone"];
    $job_role = $_POST["job"];
    $skill_arr = $_POST["skills"];
    $lang_arr = $_POST["lang"];
    $hobbies = $_POST["hobbies"];
    $bio = $_POST["bio"];

    $query =
        "insert into resume(fname,lname,address,city,dob,phone,u_id,job_role) values('" .
        $fname .
        "','" .
        $lname .
        "','" .
        $address .
        "','" .
        $city .
        "','" .
        $dob .
        "','" .
        $phone .
        "','" .
        $_SESSION["u_id"] .
        "','" .
        $job_role .
        "')";
    $result = pg_query($query);

    if ($result) {
        $query2 = "select * from resume where u_id='" . $_SESSION["u_id"] . "'";
        $result1 = pg_query($query2);
        $arr = pg_fetch_row($result1);
        $_SESSION["r_id"] = $arr[0];
    } else {
        echo "Some Error Occured";
    }

    $query1 =
        "insert into personal_info(bio,hobbies,u_id,skills,languages) values('" .
        $bio .
        "','" .
        $hobbies .
        "','" .
        $_SESSION["u_id"] .
        "','" .
        $skill_arr .
        "','" .
        $lang_arr .
        "')";
    $res = pg_query($query1);

    if ($res) {
        header("location: ../pages/view_resume.php");
    } else {
        echo "Some Error Occured";
    }
}


?>
