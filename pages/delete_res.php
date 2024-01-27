<?php

session_start();
include "../includes/dbconn.php";

$query = "delete from edu_qual where u_id='" . $_SESSION["u_id"] . "'";
pg_query($query);

$query = "delete from work_history where u_id='" . $_SESSION["u_id"] . "'";
pg_query($query);

$query = "delete from resume where u_id='" . $_SESSION["u_id"] . "'";
pg_query($query);

$query = "delete from personal_info where u_id='" . $_SESSION["u_id"] . "'";
pg_query($query);

header("location: dashboard.php");
