<?php


// Ze
//-----DB Connection code------
$servername = "localhost";
$serverUsername = "zw6aw";                         //computing id
$serverPassword = "5WrBeQbh";                   //---- your password
$database = "zw6aw";              // computing id
// Leo
//-----DB Connection code------
//$servername = "localhost";
//$serverUsername = "lr3hj";                         //computing id
//$serverPassword = "UVCiZHAG";                   //---- your password
//$database = "lr3hj";              // computing id



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
    /* Referenced from W3Schools - Top Navigation */
    /* Add a black background color to the top navigation */
  .topnav {
      background-color: #333;
      overflow: hidden;
      width: 100%;
  }

  /* Style the links inside the navigation bar */
  .topnav a {
      float: left;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
  }

  /* Change the color of links on hover */
  .topnav a:hover {
      background-color: #ddd;
      color: black;
  }

  /* Add a color to the active/current link */
  .topnav a.active {
      background-color: #4CAF50;
      color: white;
  }
  </style>
</head>
<body style="position: relative; 
  margin: 0 auto;
  background-image: url(bg.jpg);
  background-size: 100% 620px;
  background-repeat: repeat;">  
   <div class="topnav">
      <a href="index_g1.php">Home</a>
      <a class="active" href="add_item_g1.php">Add Item</a>
      <a href="update_inventory_g1.php">Inventory</a>
      <a href="view_tables_g1.php">View Tables</a>
  </div> 
  <div class="content" style="padding-left: 20px; padding-right: 20px;">
      <h1 style="text-align: left; 
        display: block;
      	color: #000066;
      	font-weight: bold;">Add Item</h1>
      <hr> 
      <b style="text-align: left; font-size: 18px;">Fill out the form below to add an item to the database. All fields marked with an '*' are required.</b>
      <hr>

      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

        Name:*
        <br>
        <input type="text" name="inputItemName" value="<?php echo $inputItemName;?>" required>
        <span class="error"> <?php echo $nameErr;?></span>
        <br>

        Price:*
        <br>
        <input type="text" name="inputItemPrice" value="<?php echo $inputItemPrice;?>" required>
        <br>

        Discount Rate:
        <br>
        <input type="text" name="inputItemDiscount" value="<?php echo $inputItemDiscount;?>">
        <br>

        Inventory:*
        <br>
        <input type="text" name="inputItemInventory" value="<?php echo $inputItemInventory;?>" required>
        <br>
        
        Category:*
        <br>
        <select name="item_category" id="id_item_category" required>
          <option value="">Choose a category</option>

          <option value="1">Electronics</option>

          <option value="2">Grocery</option>

          <option value="3">Clothes</option>

          <option value="4">Home</option>
        </select>
        <br>
 
        <br>
        <input type="submit" name="submit" value="Insert">  
      </form>
  </div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $inputItemName = $_POST['inputItemName'];
    $inputItemPrice = $_POST['inputItemPrice'];
    $inputItemDiscount = $_POST['inputItemDiscount'];
    $inputItemInventory = $_POST['inputItemInventory'];
    $item_category = $_POST['item_category'];
    //echo $inputUsername . "<br>";

}

$str = $id_item_category . "\n";
echo $str;


//adding item should be adding record to the item table
//$sql = "INSERT INTO Items VALUES(DEFAULT, $inputItemName, $item_category, $inputItemPrice, $inputItemDiscount, $inputItemInventory)"
$sql = "INSERT INTO Items VALUES('DEFAULT','$inputItemName','$item_category','$inputItemPrice', '$inputItemDiscount','$inputItemInventory')";
$result = $conn -> query($sql);
if (!$result) {
    printf("Errormessage: %s\n", $conn -> error);
}
?>

<?php
mysqli_close($exit); // HINT: This statement closes the connection with the database

ob_end_flush();
?>