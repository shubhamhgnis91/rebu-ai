<?php
session_start();
include("../includes/session_check.php");
include("../includes/dbconn.php");


$query="select * from edu_qual where u_id='".$_SESSION["u_id"]."'";
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
                <a href="../pages/update_edu.php" class="active">Education Details</a>
                <a href="../pages/update_work.php">Work Experience</a>
                <a href="../pages/update_other.php">Personal Information</a>
            </div>
            <div class="main">
                <form action="../pages/update_edu.php" method="post">
                <?php
                
                    $i=0;
                    while($i<$c)
                    {
                        echo "<br>Record No. '".($i+1)."' <br><br><br>";

                        echo 'Institute Name : <br> <input type="text" name="institute['.$i.']" value="'.$arr[$i]['e_institute'].'"> <br>';
                        echo 'Choose Type: <br> <select name="type['.$i.']"> 
                                    <option value="Graduation">Graduation</option>
                                    <option value="Highschool">Highschool</option>
                                    <option value="Post Graduation">Post Graduation</option>
                                    <option value="Diploma">Diploma</option>

                            </select> <br>';

                        echo 'Percentage: <br> <input type="text" name="percent['.$i.']" value="'.$arr[$i]['e_percent'].'"> <br>';
                        echo 'Passout Year: <br> <input type="text" name="year['.$i.']" value="'.$arr[$i]['e_year'].'"> <br><br>';
                        
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
        $query="update edu_qual set e_institute='".$_POST['institute'][$i]."', e_type='".$_POST['type'][$i]."', e_year='".$_POST['year'][$i]."', e_percent='".$_POST['percent'][$i]."' where e_id='".$arr[$i]["e_id"]."'";
        $result=pg_query($query);
    }

    header("location: ../pages/update_work.php");
    
}

?>