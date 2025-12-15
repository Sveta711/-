<?php
session_start();
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "catalog_DB";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST['username']);
    $password1 = md5($_POST['password']);
    
$required = [ "username","password"];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "All fields are required.";
            break; 
        }
    }
    $stmt = $conn->prepare("SELECT * FROM UserAccount WHERE username = ? AND passwords = ?");
    $stmt->bind_param("ss", $user, $password1);
    $stmt->execute();
    $result = $stmt->get_result();
      //  echo "Input hash: " . $password1; 
      //  die();

    if ($result->num_rows === 1) {
        $userData = $result->fetch_assoc();
        $_SESSION['user'] = $userData['username'];
       $_SESSION['firstname'] = $userData['firstname'];
       header("Location: welcome.php");
    } else {
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: signin.php");
    }

    $stmt->close();
    $conn->close();
}
?>