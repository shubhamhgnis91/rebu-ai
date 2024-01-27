<html>

<head>
    <title><?php echo isset($pageTitle) ? $pageTitle : 'REBU' ?></title>
    <link rel="icon" href="../images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">

</head>

<body>
    <div class="navigation-bar">
        <img class="logo" src="../images/logo.png">
        <ul>
            <li><a class="nav-links" href="../pages/index.php">Home</a></li>
            <li><a class="nav-links" href="../pages/templates.php">Templates</a></li>
            <li><a class="nav-links" href="../pages/about.php">About</a></li>
            <li><a class="nav-links" href="../pages/contact.php">Contact</a></li>

            <?php
            session_start();
            if (!isset($_SESSION["u_id"])) {
                echo '
                            <button class="bt1"><a href="../pages/login.php">SIGN IN</a></button>
                            <button class="bt1"><a href="../pages/register.php">SIGN UP</a></button>';
            } else {
                echo '<button class="bt1"><a href="../pages/dashboard.php">Dashboard</a></button>';
            }
            ?>
        </ul>
    </div>