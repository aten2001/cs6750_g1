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
      <a href="add_item_g1.php">Add Item</a>
      <a href="update_inventory_g1.php">Inventory</a>
      <a class="active" href="manage_orders_g1.php">Orders</a>
      <a href="view_tables_g1.php">View Tables</a>
  </div> 
  <div class="content" style="padding-left: 20px; padding-right: 20px;">
      <h1 style="text-align: left; 
        display: block;
        color: #000066;
        font-weight: bold;">Manage Orders</h1>
      <hr> 
      <b style="text-align: left; font-size: 18px;">Make an order for a user.</b>
      <hr>
      <table>
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

        User:*
        <br>
        <select name="user_name" id="id_user_name" required>
          <option value="">Choose a user</option>
          <?php
          $sql = "Select Username, UserID from Users";
          $results = $conn->query($sql);
          while($row = $results->fetch_assoc()) {
            ?>
            <option value="<?php echo $row['UserID'] ?>"><?php echo $row['Username']?></option>
          <?php 
          } 
          ?>
        </select>
        <br>

        Item:*
        <br>
        <select name="item_name" id="id_item_name" required>
          <option value="">Choose an item</option>
          <?php
          $sql = "Select ItemName, ItemID from Items";
          $results = $conn->query($sql);
          while($row = $results->fetch_assoc()) {
            ?>
            <option value="<?php echo $row['ItemID'] ?>"><?php echo $row['ItemName']?></option>
          <?php 
          } 
          ?>
        </select>
        <br>

        Quantity:*
        <br>
        <input type="number" min="0" step="1" name="inputOrderQuantity" value="<?php echo $inputOrderQuantity;?>" required>
        <br>


        Shipper:*
        <br>
        <select name="shipper_name" id="id_shipper_name" required>
          <option value="">Choose a shipper</option>
          <?php
          $sql = "Select ShipperName, ShipperID from Shippers";
          $results = $conn->query($sql);
          while($row = $results->fetch_assoc()) {
            ?>
            <option value="<?php echo $row['ShipperID'] ?>"><?php echo $row['ShipperName']?></option>
          <?php 
          } 
          ?>
        </select>
        <br>
 
        <br>
        <input type="submit" name="submit" value="Submit">  
      


      </form>
    </table>
  </div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $inputOrderQuantity = $_POST['inputOrderQuantity'];
    $item_name = $_POST['item_name'];
    $user_name = $_POST['user_name'];
    $shipper_name = $_POST['shipper_name'];
    // get tracking number (randomly generated 8 digit number)
    $tracking_number = rand(10000000, 99999999);
    // get date
    $OrderDate = date("Y-m-d");

    // Add Order to Orders table
    $sql_add_order = "INSERT INTO Orders (UserID, ShipperID, OrderDate, TrackingNumber) VALUES('$user_name','$shipper_name','$OrderDate', '$tracking_number')";
    $result = $conn -> query($sql_add_order);
    if (!$result) {
        printf("Error adding Order: %s\n", $conn -> error);
    }
    else {
        // now add order details record
        $OrderID = $conn->insert_id;
        $sql_add_orderdetail = "INSERT INTO OrderDetails VALUES('$OrderID','$item_name', '$inputOrderQuantity')";
        $result2 = $conn -> query($sql_add_orderdetail);
        if (!$result2) {
          printf("Error adding OrderDetail: %s\n", $conn -> error);
        }
        else {
          printf("OrderDetail added successfully.\n");
        }
    }
}
?>

<?php
mysqli_close($exit); // HINT: This statement closes the connection with the database

ob_end_flush();
?>