<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blog";

$conn=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$artiid = $_GET['id'];

$sql = $conn->query("DELETE FROM article where article_id=$artiid");
$conn->exec($sql);
header('Location:app.php');
?>