<html>
<head>
    <title>Education Background</title>
    <link rel="stylesheet" type="text/css" href="../css/forms.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
</head>
<body>
    <div class="snav">
        <a href="../index.php">Home</a>
        <a href="../pages/education.php" <?php echo isPageActive('education.php') ? 'class="active"' : ''; ?>>Education Details</a>
        <a href="../pages/work_history.php" <?php echo isPageActive('work_history.php') ? 'class="active"' : ''; ?>>Work Experience</a>
        <a href="../pages/resume.php" <?php echo isPageActive('resume.php') ? 'class="active"' : ''; ?>>Personal Information</a>
    </div>

<?php
function isPageActive($pageName) {
    $currentPage = basename($_SERVER['PHP_SELF']);
    return ($currentPage == $pageName);
}
?>