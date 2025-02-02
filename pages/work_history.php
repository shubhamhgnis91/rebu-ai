<html>
<head>
    <title>
        Work history
    </title>
    <link rel="stylesheet" type="text/css" href="../css/forms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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

</head>

<body>
    <div class="snav">
        <a href="../index.php">Home</a>
        <a href="../pages/education.php">Education Details</a>
        <a href="../pages/work_history.php" class="active">Work Experience</a>
        <a href="../pages/resume.php">Personal Information</a>
    </div>
    <div class="main">
        <form action="../pages/work_history.php" method="post">

            Enter company name: <input type="text" name="cname"> <br>
            Enter start year: <input type="text" name="syear"> <br>
            Enter end year: <input type="text" name="eyear"> <br>
            Enter description: 
        <div class="icon-wrapper">
            <textarea name="desc" id="inputDesc" maxlength="250"> </textarea>
            <i class="fas fa-magic" onclick="processDescription()"></i>
        </div>
            Enhanced description:

            <div class="icon-wrapper">
                <textarea id="enhancedDesc" readonly></textarea>
                <i class="fas fa-copy" onclick="copyEnhancedDescription()"></i>
            </div>
            
            <input type="submit" name="submit" value="Submit"> <br>
        </form>
    </div>
    <div class="footer">
        <p>ReBu <?php echo date("Y"); ?> &copy;</p>
    </div>
    <script src="../scripts/processDescription.js"></script>
    
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
include("../includes/session_check.php");
include("../includes/dbconn.php");

if(isset($_POST['submit']))
{
    $cname=$_POST['cname'];
    $syear=$_POST['syear'];
    $eyear=$_POST['eyear'];
    $desc=$_POST['desc'];


    $query="insert into work_history(w_company,start_year,end_year,description,u_id) values('".$cname."','".$syear."','".$eyear."','".$desc."','".$_SESSION["u_id"]."')";
    $result=pg_query($dbconn,$query);

    if($result)
    {

        echo '<div class="main"> <p>Details entered. You can add another record or go to <a href="resume.php">next page</a>.</p></div> <br>';
    }
    else
    {
        echo "Some Error Occured";
    }
}



?>
