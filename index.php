<?php
require_once("login.php");
require_once("style.css");

try {

//set up dsn
$dsn = 'mysql:host=' . $config["hostname"] . ';dbname=' . $config["database"];
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

// set up pdo connection with database and set error attributes
$pdo = new PDO($dsn, $config["username"], $config["password"], $options);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//setup query and execute
$query = 'SELECT userId, userName, userEmail, dateCreated FROM user';
$statement  = $pdo->prepare($query);
$statement ->execute();
$statement ->setFetchMode(PDO::FETCH_ASSOC);

// setup table and table headers
echo "<table>";
echo "<tr>";
echo "<th>User ID</th>";
echo "<th>User Name</th>";
echo "<th>User Email</th>";
echo "<th>Date Created</th>";
echo "</tr>";


while(($row = $statement->fetch()) !== false) {
 echo "<tr>";
 echo ("<td>" . $row["userId"] . "</td>");
 echo ("<td>" . $row["userName"] . "</td>");
 echo ("<td>" . $row["userEmail"] . "</td>");
 echo ("<td>" . $row["dateCreated"] . "</td>");
 echo "</tr>";
}
echo "</table>";  // end table

$pdo = null;



} catch(Exception $e) {
  echo $e->getMessage();
}
