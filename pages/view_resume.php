<?php
session_start();
include("../includes/session_check.php");
include("../includes/dbconn.php");

$edu_query="select * from edu_qual where u_id='".$_SESSION["u_id"]."'";
$res=pg_query($dbconn, $edu_query);

if($res)
{
    $edu_arr=pg_fetch_all($res);
    $c_edu=count($edu_arr);
}

$work_query="select * from work_history where u_id='".$_SESSION["u_id"]."'";
$res1=pg_query($dbconn, $work_query);

if($res1)
{
    $work_arr=pg_fetch_all($res1);
    $c_work=count($work_arr);
}

$resume_query="select * from resume where u_id='".$_SESSION["u_id"]."'";
$res2=pg_query($dbconn, $resume_query);

if($res2)
{
    $res_arr=pg_fetch_all($res2);
    $c_res=count($res_arr);
}

$bio_q="select bio from personal_info where u_id='".$_SESSION["u_id"]."'";
$res3=pg_query($dbconn, $bio_q);
if($res3)
{
    $bio=pg_fetch_all($res3);
}

$h_q="select hobbies from personal_info where u_id='".$_SESSION["u_id"]."'";
$res4=pg_query($dbconn, $h_q);
if($res4)
{
    $hobbies=pg_fetch_all($res4);
}

$s_q="select skills from personal_info where u_id='".$_SESSION["u_id"]."'";
$res5=pg_query($dbconn, $s_q);
if($res5)
{
    $skills=pg_fetch_all($res5);
}

$l_q="select languages from personal_info where u_id='".$_SESSION["u_id"]."'";
$res6=pg_query($dbconn, $l_q);
if($res6)
{
    $languages=pg_fetch_all($res6);
}



?>

<html>
    <head>
        <title>
            Resume
        </title>
      
        <link rel="stylesheet" type="text/css" href="../css/<?php echo $_SESSION['template']; ?>">
        <style type="text/css" media="print">

            body {
            zoom:50%; 
            }
            .bt2{
                visibility: hidden;
            }

        </style>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
        <script src="http://html2canvas.hertzen.com/dist/html2canvas.js" type="text/javascript"></script>




        <script>
            function ss(){
                window.scrollTo(0, 0);
                html2canvas(document.querySelector("#capture")).then(canvas => {
                var link = document.createElement("a");
                    document.body.appendChild(link);
                    link.download = "resume.png";
                    link.href = canvas.toDataURL("image/png");
                    link.target = '_blank';
                    link.click();
            });
            }
     
        </script>

        

    </head>

    <body>
        
        <div id="capture">

        <div class="container">
                <p class="name">

                    <?php print_r(ucfirst($res_arr[0]["fname"]));
                            echo "  ";  
                            print_r(ucfirst($res_arr[0]["lname"])); 
                    ?>

                </p>
                
               
            <div class="top">

                    <p><strong>Address: </strong><?php print_r($res_arr[0]["address"]); ?> &nbsp;
                    <strong>City: </strong><?php print_r($res_arr[0]["city"]); ?> &nbsp; <br>
                    <strong>DOB: </strong><?php print_r($res_arr[0]["dob"]); ?> &nbsp;<br>
                    <strong>Phone: </strong><?php print_r($res_arr[0]["phone"]); ?> &nbsp; <br>
                    <strong>Email: </strong><?php echo $_SESSION["email"]; ?>

                    </p>

            </div>      
              
        </div>

        <div class="container">
        

            <p class="heading-1">Profile</p> <br>
            <div class="container2">

            <?php print_r($bio[0]['bio']); ?>


        </div>
        </div>


        <div class="container">
            <p class="heading-1">Education Details</p>
            <?php
                    echo '  <table>
                                <th>Institute</th>
                                <th>Type</th>
                                <th>Year</th>
                                <th>Percent</th>';
                    $i=0;
                    while($i<$c_edu)
                    {
                        echo'   <tr>
                                    <td>'.$edu_arr[$i]["e_institute"].'</td>
                                    <td>'.$edu_arr[$i]["e_type"].'</td>
                                    <td>'.$edu_arr[$i]["e_year"].'</td>
                                    <td>'.$edu_arr[$i]["e_percent"].'</td>
                                </tr> 
                                
                            ';
                        $i++;
                    }
                    echo '</table>';
                ?>           
        </div>

        <div class="container">
            <p class="heading-1">Work History</p>
            <?php
                    echo '<table>
                            <th>Company</th>
                            <th>Start Year</th>
                            <th>End Year</th>
                            <th>Description</th>';
                    $i=0;

                    while($i<$c_work)
                    {
                        echo'   <tr>
                                    <td>'.$work_arr[$i]["w_company"].'</td>
                                    <td>'.$work_arr[$i]["start_year"].'</td>
                                    <td>'.$work_arr[$i]["end_year"].'</td>
                                    <td>'.$work_arr[$i]["description"].'</td>
                                </tr>
                        ';
                        $i++;
                    }
                    echo '</table>'
            ?>
        </div>
        
        <div class="container">
            <p class="heading-1">Other Information</p> 
        </div>

        <div class="container2">
            
            
            
                <dl>  
                    <dt>Skills: </dt>     
                    <?php 
                        echo strtoupper($skills[0]['skills']);
                    ?>
                </dl>
            
                <dl>
                    <dt>Hobbies: </dt>
                   <?php 

                        echo ucwords($hobbies[0]['hobbies'],',');
                    ?>
                </dl>
           
            
       

        

            
            
                <dl>
                    <dt>Languages Known:</dt>
                <?php 
                        echo ucwords($languages[0]['languages'],',')
                    
                ?>
                </dl>
            </p>

            

        
            
            
        </div>
        </div>
        <div class="container">
        <button class="bt2" onClick="ss()"> 
            Download Resume
        </button>
        <br>
        <button class="bt2" onClick="window.print()"> 
            Print Resume
        </button> <br>
               
        <form action="../pages/view_resume.php" method="post">
                <input class="bt2" type="submit" name="submit" value="Try another template">
        </form>
        </div>
        
       
    </body>
</html>

<?php
    if(@$_POST['submit'])
    {
        if(strcmp($_SESSION['template'],'template_1.css')==0)
            {
                $_SESSION['template']='template_2.css';
            }
        else if(strcmp($_SESSION['template'],'template_2.css')==0)
            {
                $_SESSION['template']='template_3.css';
            }    
        else
        {
            $_SESSION['template']='template_1.css';
        }
    }

?>