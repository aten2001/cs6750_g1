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
  table {
    width: 100%;
    border-collapse: collapse;
  }
  th {
    height: 80px;
  }
  table, th, td {
   border: 1px solid black;
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
      <a class="active" href="update_inventory_g1.php">Inventory</a>
      <a href="manage_orders_g1.php">Orders</a>
      <a href="view_tables_g1.php">View Tables</a>
      <a href="user_orders_g1.php">User Order History</a>
  </div> 
  <div class="content" style="padding-left: 20px; padding-right: 20px;">
      <h1 style="text-align: left; 
        display: block;
        color: #000066;
        font-weight: bold;">Update Inventory</h1>
      <hr> 
      <b style="text-align: left; font-size: 18px;">Fill out the form below to update an item's inventory.</b>
      <hr>

      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

        Item:*
        <br>
        <select name="inputItemName" id="inputItemName" required>
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

        Inventory:*
        <br>
        <input type="number" min="0" step="1" name="inputItemInventory" value="<?php echo $inputItemInventory;?>" required>
        <br>
        
 
        <br>
        <input type="submit" name="submit" value="Update">  
      </form>
      <br>
<!-- process form input/SQL operation -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $inputItemName = $_POST['inputItemName'];
    $inputItemInventory = $_POST['inputItemInventory'];
    // update item
    $sql_update = "UPDATE Items SET Inventory = '". $inputItemInventory. "' WHERE ItemID = '". $inputItemName. "'";
    $result = $conn -> query($sql_update);
    if (!$result) {
        printf("Error: %s\n", $conn -> error);
    }
    else {
        printf("Item updated successfully.\n");
    }
}
?>
<table>
<!-- show items table -->
<?php
        $sql2 = "SHOW COLUMNS FROM Items";
        //$sql2 = "SHOW COLUMNS FROM users;";
        $result2 = mysqli_query($conn, $sql2);
        $num_of_cols = 1;
        if (mysqli_num_rows($result2) > 0) {
          $columns = array();
          echo "<thead>";
          echo "<tr>";
          while ($row = mysqli_fetch_assoc($result2)) {
            $columns[$num_of_cols] = $row["Field"];
            echo "<td>". $row["Field"]. "</td>";
            $num_of_cols++;
          }
          echo "</tr>";
          echo "</thead>";
        echo "<tbody>";
        $sql3 = "SELECT * FROM Items";
        //$sql3 = "SELECT * FROM users;";
        $result3 = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result3)) {
          while($row = mysqli_fetch_assoc($result3)) {
            $j = 1;
            echo "<tr>";
            while ($j <= $num_of_cols - 1) {
              //echo $columns[$j]. ": ". $row[$columns[$j]]. " ";
              if($row[$columns[$j]] == NULL) {
                echo "<td>N/A</td>";
              } else {
                echo "<td>". $row[$columns[$j]]. "</td>";
              }
              $j++;
            }
            echo "</tr>";
          }
        }
        } else {
          echo "0 result";
        }
        echo "</tbody>";
?>
<!-- close database connection -->
<?php
mysqli_close($exit); // HINT: This statement closes the connection with the database
ob_end_flush();
?>
</table>
</div>
</body>
</html>