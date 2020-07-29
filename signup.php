<!DOCTYPE html>
<html>
<head>
	<title>mporio - login</title>
	
</head>
<body>

<?php
$servername = "localhost";
$username = "swarnya";
$password = "FeyT0L@Tef3";
$dbname = "mporio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

// prepare and bind
$stmt = $conn->prepare("INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $username, $email, $password);

// set parameters and execute
$name = $_POST["name"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$stmt->execute();

echo "New records created successfully";

$stmt->close();

$sql = "SELECT id, name, username, email, password FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<br>" . "id: " . $row["id"] . "<br>" . "Name: " . $row["name"] . "<br>" . "Username: " . $row["username"]. "<br>" . "Email: " . $row["email"] . "<br>" . "Password: " . $row["password"]; 
  }
} else {
  echo "0 results";
}

$conn->close();
?>

</body>
</html>
