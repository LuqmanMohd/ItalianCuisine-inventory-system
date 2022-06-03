<?php
session_start();
$servername = "lrgs.ftsm.ukm.my";
$username = "a175128";
$password = "littlegrayturtle";
$dbname = "a175128";

$conn = null;
try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}
?>