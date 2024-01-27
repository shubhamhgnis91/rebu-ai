<?php
session_start();
include("../includes/session_check.php");
include("../includes/dbconn.php");


$query="select * from resume where u_id='".$_SESSION["u_id"]."'";
$result=pg_query($query);

if($result)
{
    $arr=pg_fetch_all($result);
}

$query="select * from personal_info where u_id='".$_SESSION["u_id"]."'";
$result=pg_query($query);

if($result)
{
    $arr1=pg_fetch_all($result);
}

?>


<html>
    <head>
        <title>
            Update Details

        </title>
        <link rel="stylesheet" type="text/css" href="../css/forms.css">

    </head>

    <body>
            <div class="snav">
                <p>Update Details</p>
                <a href="../pages/dashboard.php">Dashboard</a>
                <a href="../pages/update_edu.php">Education Details</a>
                <a href="../pages/update_work.php">Work Experience</a>
                <a href="../pages/update_other.php" class="active">Personal Information</a>
            </div>
        <div class="main">
            <form action="../pages/update_other.php" method="post">
            <?php

                echo 'First name: <input type="text" name="fname" value="'.$arr[0]['fname'].'"> <br>';
                echo 'Last name: <input type="text" name="lname" value="'.$arr[0]['lname'].'"><br>';
                echo 'Address: <input type="text" name="address" value="'.$arr[0]['address'].'"><br>';
                echo 'City: <input type="text" name="city"value="'.$arr[0]['city'].'"> <br>';
                echo 'DOB : <input type="date" name="dob" value="'.$arr[0]['dob'].'"> <br>' ;
                echo 'Phone: <input type="text" name="phone" value="'.$arr[0]['phone'].'"><br>';
                echo 'Skills (Enter skills seperated by comma "," ) : <input type="text" name="skills" value="'.$arr1[0]['skills'].'"> <br>';
                echo 'Languages Known (Enter languages seperated by comma "," ) : <input type="text" name="lang" value="'.$arr1[0]['languages'].'"> <br>';
                echo 'Hobbies (Enter hobbies seperated by comma "," ): <input type="text" name="hobbies" value="'.$arr1[0]['hobbies'].'"> <br>';
                echo 'Applying for which role: <input type="text" name="job" value="'.$arr[0]['job_role'].'"> <br>';
                echo 'Tell us about yourself : <textarea name="bio" rows="100" cols="100">'.$arr1[0]['bio'].'</textarea>';

            ?>
            <input type="submit" name="submit" value="Submit">
            </form>
        </div>
        <div class="footer">
            <p>ReBu 2023 &copy;</p>

        </div>
    </body>
        
</html>


<?php


if(isset($_POST['submit']))
{
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $dob=$_POST['dob'];
    $phone=$_POST['phone'];
    $job_role=$_POST['job'];
    $skills=$_POST['skills'];
    $lang=$_POST['lang'];
    $hobbies=$_POST['hobbies'];
    $bio=$_POST['bio'];


    $query="update resume set fname='".$fname."', lname='".$lname."', address='".$address."', city='".$city."', dob='".$dob."', phone='".$phone."', job_role='".$job_role."' where u_id='".$_SESSION["u_id"]."'";
    $result=pg_query($query);

    $query1="update personal_info set bio='".$bio."', hobbies='".$hobbies."', skills='".$skills."', languages='".$lang."' where u_id='".$_SESSION["u_id"]."'";
    $res=pg_query($query1);

    header("location: ../pages/view_resume.php");
    
}



?>