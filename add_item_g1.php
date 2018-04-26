<?php


// Ze
//-----DB Connection code------
$servername = "localhost";
$serverUsername = "zw6aw";                         //computing id
$serverPassword = "5WrBeQbh";                   //---- your password
$database = "zw6aw";              // computing id
// Leo
//-----DB Connection code------
$servername = "localhost";
$serverUsername = "lr3hj";                         //computing id
$serverPassword = "UVCiZHAG";                   //---- your password
$database = "lr3hj";              // computing id



// Create connection
$conn = new mysqli($servername, $serverUsername, $serverPassword, $database);
// Check connection
if ($conn->connect_error)
{
	die ("Connection failed: ". $conn->connect_error);
}
mysql_select_db($serverUsername);

// ---- VARIABLE DECLARATIONS ----
$nameErr = "";

?>

<!DOCTYPE HTML>  
<html>
<head>
  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  <style>
  i {
    padding-left: 20px;
    padding-right: 20px;
  }
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
      <a href="manage_orders_g1.php">Orders</a>
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
        <input type="number" min="0.00" step="0.01" name="inputItemPrice" value="<?php echo $inputItemPrice;?>" required>
        <br>

        Discount Rate:
        <br>
        <input type="number" min="0.00" max="1.00" step="0.01" name="inputItemDiscount" value="<?php echo $inputItemDiscount;?>">
        <br>

        Inventory:*
        <br>
        <input type="number" min="0" step="1" name="inputItemInventory" value="<?php echo $inputItemInventory;?>" required>
        <br>
        
        Category:*
        <br>
        <select name="item_category" id="id_item_category" required>
          <option value="">Choose a category</option>
          <?php
          $sql = "Select CategoryName, CategoryID from Categories";
          $results = $conn->query($sql);
          while($row = $results->fetch_assoc()) {
            ?>
            <option value="<?php echo $row['CategoryID'] ?>"><?php echo $row['CategoryName']?></option>
          <?php 
          } 
          ?>
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
    $str = $id_item_category . "\n";
    echo $str;


    //adding item should be adding record to the item table
    //$sql = "INSERT INTO Items VALUES(DEFAULT, $inputItemName, $item_category, $inputItemPrice, $inputItemDiscount, $inputItemInventory)"
    $sql = "INSERT INTO Items (ItemName, CategoryID, Price, DiscountRate, Inventory) VALUES('$inputItemName','$item_category','$inputItemPrice', '$inputItemDiscount','$inputItemInventory')";
    $result = $conn -> query($sql);
    if (!$result) {
        printf("<p><i>Error: %s</i></p>\n", $conn -> error);
    }
    else {
        printf("<p><i>Item added successfully.</i></p>\n");
    }
}
?>

<?php
mysqli_close($exit); // HINT: This statement closes the connection with the database

ob_end_flush();
?>