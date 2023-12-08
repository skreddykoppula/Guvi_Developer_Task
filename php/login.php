<?php
session_start();

if (isset($_SESSION['username'])) {
	header("Location: ../profile.html");
	exit;
}

if (isset($_POST['username']) && isset($_POST['password'])) {

	$conn = mysqli_connect('localhost', 'root', '', 'GuviTask');

	if (!$conn) {
		die('Error: Could not connect to database');
	}

	$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE uname = ? AND pswd = ?");

	mysqli_stmt_bind_param($stmt, "ss", $_POST['username'], $_POST['password']);

	mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);
	if (mysqli_num_rows($result) > 0) {
		$_SESSION['username'] = $_POST['username'];
		header("Location: ../profile.html");
		exit;

	} else {

	
		echo "Invalid username or password";

	}
	mysqli_close($conn);
}
?>

<?php
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($authenticated) {
      $_SESSION['username'] = $username;

      $_SESSION['expires'] = time() + 1800; 
      header('Location: /profile.php');
      exit;
    } else {
      echo "Error";
    }
  }
?>
