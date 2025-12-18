<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "catalog_DB";


$conn = new mysqli($servername, $username, $password,);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

$sql1 = "CREATE TABLE IF NOT EXISTS UserAccount(
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    username VARCHAR(40) NOT NULL,
    email VARCHAR(50),
    age INT(3),
    passwords VARCHAR(30) NOT NULL,
    cardnumber VARCHAR(20),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$conn->query($sql1);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    
    $firstname = trim($_POST["firstname"] ?? "");
    $lastname = trim($_POST["lastname"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $valid = $_POST["valid"] ?? "";
    $username_val = trim($_POST["username"] ?? "");
    $age = trim($_POST["age"] ?? "");
    $cardnumber = trim($_POST["cardnumber"] ?? "");
   $hashed_password=md5($_POST["password"] );
    $required = ["firstname", "lastname", "email", "password", "username", "age"];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "All fields are required.";
            break; 
        }
    }

 
    if (!empty($firstname) && !preg_match("/^[a-zA-ZԱ-Ֆա-ֆ'-]+$/u", $firstname)) {
        $errors[] = "Firstname can only contain letters.";
    }

    
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (!empty($age) && $age < 18) {
        $errors[] = "You must be 18 or older.";
    }

    if ($password !== $valid) {
        $errors[] = "Passwords do not match.";
    }

    
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: account.php");
        exit();
    }


    if(empty($_SESSION['errors'])||!isset($_SESSION['errors'])){
$sql2 = "INSERT INTO UserAccount (firstname, lastname,username, email,age,passwords,cardnumber)
 VALUES ('".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['username']."','".$_POST['email']."','".$_POST['age']."','".$hashed_password."','".$_POST['cardnumber']."')";
}
if ($conn->query($sql2) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql2 . "<br>" . $conn->error;
}
    $conn->close();
    header("Location: welcome.php");
    exit();
}

/*$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "CREATE DATABASE IF NOT EXISTS  catalog_DB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}
$conn= new mysqli($servername,$username,$password,"catalog_DB");
if($conn->connect_error){
    die("Conected failed: " . $conn->connect_error);
}
$sql1 = "CREATE TABLE IF NOT EXISTS UserAccount(
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
username VARCHAR(30) NOT NULL,
email VARCHAR(50),
age int(2),
passwords VARCHAR(30) NOT NULL,
cardnumber int(16) ,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql1) === TRUE) {
  echo "Table UserAccount created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $firstname= trim($_POST["firstname"]);
  $lastname=trim($_POST["lastname"]);
  $email=trim($_POST["email"]);
  $password=trim($_POST["password"]);
  $valid=trim($_POST["valid"]);
  $username=trim($_POST["username"]);
  $age=trim($_POST["age"]);
  $gender=trim($_POST["gender"]);
 $cardnumber=trim($_POST["cardnumber"]);
  $errors=[];
  $required=["firstname","lastname","email","password","valid","username","age","gender"];
  foreach($required as $fields){
    if (empty($_POST[$fields])){
      $errors[]= "$fields is requireed"; }
  }
  if(!preg_match("/^[a-zA-zԱ-Ֆա-ֆ'-]+$/u",$firstname)){
    $errors[]="$firstname can only contain letters";
  }
  if(!preg_match("/^[a-zA-zԱ-Ֆա-ֆ'-]+$/u",$lastname)){
    $errors[]="$lastname can only contain letters";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid $email format";
    }
 if($age<18){
        $errors[]="Age must be 18 or older";
      }
      if($password!==$valid){
      $errors[]="<h4 style='color:red;'>Passwords do not match</h4>";
    }}
    


    echo "<h2>Your Input:</h2>";
echo"name: $firstname";
echo "<br>";
echo "lastname:$lastname";
echo "<br>";
echo "emaill: $email";
echo "<br>";
echo "username:$username";
echo "<br>";
echo "password:$password";
echo "<br>";
echo"validation of password: $valid";
echo "<br>";
echo "age:$age";
echo "<br>";
echo "gender: $gender";
echo "<br>";
echo "card number: $cardnumber";



 
 if(!empty($errors)){
  echo "<h3 style='color:red'>THERE IS A FALSES IN FORM</h3>";
  
  foreach($errors as $err){
    echo $err; }
 }




 $data=[
  "NAME"=>$firstname,
  "LASTNAME"=>$lastname,
  "EMAIL"=>$email,
  "USERNAME"=>$username,
  "PASSWORDS"=>$password,
  "AGE"=>$age,
  "GENDER"=>$gender,
  "card number"=>$cardnumber
  
 ];
 foreach($data as $key=>$value){
  echo "$key=>[$value]<br>";
 }echo"<h3 style='color:green;'>SUCCESS</h3>";



if(empty($_SESSION['errors'])||!isset($_SESSION['errors'])){
$sql2 = "INSERT INTO UserAccount (firstname, lastname,username, email,age,passwords,cardnumber)
 VALUES ('".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['username']."','".$_POST['email']."','".$_POST['age']."','".$_POST['password']."','".$_POST['cardnumber']."')";
}
if ($conn2->query($sql2) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql2 . "<br>" . $conn2->error;
}
*/

?>