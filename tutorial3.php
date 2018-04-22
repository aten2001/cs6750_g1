<?php


//-----DB Connection code------
$servername = "localhost";
$serverUsername = "zw6aw";                         //computing id
$serverPassword = "5WrBeQbh";                   //---- your password
$database = "zw6aw";              // computing id



// Create connection
$conn = new mysqli($servername, $serverUsername, $serverPassword, $database);
// Check connection
if ($conn->connect_error)
{
	die ("Connection failed: ". $conn->connect_error);
}
//echo "Connection success! <br>";

// ---- VARIABLE DECLARATIONS ----
$nameErr = $passErr = "";
$inputUsername = $inputPassword = $pwd= "";

?>

<!DOCTYPE HTML>  
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
  <style>
  .error {color: #FF0000;}
  </style>
</head>
<body style="position: relative; 
	width: 50%;
	margin: 0 auto;
	padding: 10px;
	background-image: url(bg.jpg);
	background-size: 100% 620px;
	background-repeat: repeat;">  
<h2 style="text-align: center; 
  font-family: 'Josefin Sans', cursive;
  display: block;
	color: #000066;
	font-size: 58px;
	font-weight: bold;"> Database Project Group_1 </h2>
<hr> 
<h2 style="text-align: center; font-family: 'Josefin Sans', cursive; color: #FF6600;font-size: 30px;"> Operations Here</h2>
<hr>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

  Name:
  <br>
  <input type="text" name="inputUsername" value="<?php echo $inputUsername;?>">
  <span class="error"> <?php echo $nameErr;?></span>
  <br>

  Password:
  <br>
  <input type="text" name="inputPassword" value="<?php echo $inputPassword;?>">
  <span class="error"> <?php echo $passErr;?></span>
  <br>

  <br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$inputUsername = $_POST["inputUsername"];
	$inputPassword = $_POST["inputPassword"];
	//echo $inputUsername . "<br>";

}


//$sql = "Select * from Login WHERE username = \"" . $inputUsername . "\"";  
// HINT: your SQL Query to get the row with given username
// Is it Select or Insert or Delete or Alter? 

$sql = "Select OrderID from Orders WHERE TrackingNumber > 500";


$result = $conn->query($sql);


if ($result->num_rows > 0) 
{
	
    // output data of each row -- here we have one or 0 rows because username is primary key
    while($row = $result->fetch_assoc()) 
    {
        $str = $row["OrderID"] . "\n";
        echo $str;
    }
} 


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  if($pwd == $inputPassword)
    //HINT: Which variable did you use to store your password obtained from the SQL query 
  {
  echo "Connection success!";
  // you can add code to jump to welcome page
  }
  else
  {
  echo "Password or username is incorrect";
  }
}


?>



<?php
mysqli_close($exit); // HINT: This statement closes the connection with the database

ob_end_flush();
?>