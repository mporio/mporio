<?php
session_start();
?>
<html>
<head>
	<title>mporio-Giftcard Insert</title>

</head>
<body>

<?php
$value = $_POST["Value"];
$startvalue = $_POST["Starting_Price"];
$company = $_POST["Company"];
//$bid = $_SESSION['uid'];
$bemail=$_SESSION['email'];
$bname=$_SESSION['name'];
$sdate=$_POST["Start_Date"];
$edate=$_POST["End_Date"];
$st="Open";
$servername = "localhost";
$username = "root";
$password = "mysqladmin";
$dbname = "mporio";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("INSERT INTO giftcards (value, startvalue, company, bideename, bemail, startdate, enddate, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iissssss", $value, $startvalue, $company, $bname, $bemail, $sdate, $edate, $st);
$stmt->execute();
echo "<br>";
echo "New records created successfully";
echo "<br>";
$stmt->close();
$sql = "SELECT * FROM giftcards";
$result = $conn->query($sql);
echo "<table><th>Bidee Name</th><th>Bidee Email</th><th>Giftcard</th><th>Giftcard Value</th><th>Starting Bid</th><th>Bid Start Date</th><th>Bid End Date</th><th>Status</th>";
if ($result->num_rows >= 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    echo "<br><tr><td>". $row["bideename"] . "</td><td>" . $row["bemail"] . "</td><td>". $row["company"]. "</td><td>". $row["value"] . "</td><td>" . $row["startvalue"]. "</td><td>".$row["startdate"]."</td><td>".$row["enddate"]."</td><td>".$row["status"]."</td></tr>";
  }
} else {
  echo "0 results";
}
echo "</table>";
$conn->close();
?>
<a href="http://localhost/Har/gcregister.php">Click Here to Register a New Card</a>
</body>
</html>
