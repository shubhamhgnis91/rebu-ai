<?php
session_start();
include("../includes/session_check.php");
include("../includes/dbconn.php");


$query="select * from work_history where u_id='".$_SESSION["u_id"]."'";
$result=pg_query($query);

if($result)
{
    $c=pg_numrows($result);
    $arr=pg_fetch_all($result);
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
                <a href="../pages/update_work.php" class="active">Work Experience</a>
                <a href="../pages/update_other.php">Personal Information</a>
            </div>
        <div class="main">
            <form action="../pages/update_work.php" method="post">
            <?php
            
                $i=0;
                while($i<$c)
                {
                    echo "<br>Record No. '".($i+1)."' <br><br><br>";

                    echo 'Company Name : <br> <input type="text" name="cname['.$i.']" value="'.$arr[$i]['w_company'].'"> <br>';
                    echo 'Start year: <input type="text" name="syear['.$i.']" value="'.$arr[$i]['start_year'].'"> <br>';
                    echo 'End year: <input type="text" name="eyear['.$i.']" value="'.$arr[$i]['end_year'].'"> <br>';
                    echo 'Description: <textarea name="desc['.$i.']">'.$arr[$i]['description'].' </textarea> <br>';
                    
                    $i++;
                }

            ?>
            <input type="submit" name="submit" value="Update">
        </div>

        </form>
        <div class="footer">
            <p>ReBu 2023 &copy;</p>

        </div>
    </body>
</html>

<?php
if(isset($_POST['submit']))
{   
 
    for($i=0;$i<$c;$i++)
    {
        $query="update work_history set w_company='".$_POST['cname'][$i]."', start_year='".$_POST['syear'][$i]."', end_year='".$_POST['eyear'][$i]."', description='".$_POST['desc'][$i]."' where w_id='".$arr[$i]['w_id']."'";
        $result=pg_query($query);
    }

    header("location: ../pages/update_other.php");
    
}

?>