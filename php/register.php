<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "GuviTask"; 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

$sql = "INSERT INTO users (uname, email, pswd)
VALUES ('$name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {

	header("location: ../login.html");
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<?php
  session_start();
  if (!isset($_SESSION['username']) || time() > $_SESSION['expires']) {
  
    header('Location: /login.php');
    exit;
  }
  $redis = new Redis();
  $redis->connect('127.0.0.1', 6379);
  $profile = json_decode($redis->get('profile:' . $_SESSION['username']), true);
?>
