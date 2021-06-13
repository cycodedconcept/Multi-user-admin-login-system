<?php
session_start();

if(!isset($_SESSION['username']) || $_SESSION['role']!= "kingsley") {
    header("location: index.php");
}
?>

<h1>Hello : <?= $_SESSION['username'] ?></h1>
<h2>You are : <?= $_SESSION['role'] ?></h2>
<a href="logout.php">Logout</a>