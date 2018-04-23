<?php


// Ze
//-----DB Connection code------
// $servername = "localhost";
// $serverUsername = "zw6aw";                         //computing id
// $serverPassword = "5WrBeQbh";                   //---- your password
// $database = "zw6aw";              // computing id
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
      <a href="add_item_g1.php">Add Item</a>
      <a href="update_inventory_g1.php">Inventory</a>
      <a class="active" href="view_tables_g1.php">View Tables</a>
  </div> 
  <div class="content" style="padding-left: 20px; padding-right: 20px;">
    <h1 style="text-align: left; 
        display: block;
        color: #000066;
        font-weight: bold;">View Records</h1>
      <hr> 
      <b style="text-align: left; font-size: 18px;">The table below consists of all items currently in the database.</b>
      <hr>
    <table>
      <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Category</td>
          <td>Price</td>
          <td>Inventory</td>
          <td>Discount Rate</td>
        </tr>
      </thead>
      <tbody>
        <?php
                mysql_select_db("lr3hj");
                $sql = "Select * from Items";
                $results = $conn->query($sql);
                while($row = $results->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row['ItemID']?></td>
                        <td><?php echo $row['ItemName']?></td>
                        <td><?php echo $row['CategoryID']?></td>
                        <td><?php echo $row['Price']?></td>
                        <td><?php echo $row['Inventory']?></td>
                        <?php if ($row['DiscountRate'] == NULL) { ?>
                        <td><?php echo "None"?></td>
                        <?php } else { ?>
                        <td><?php echo $row['DiscountRate']?></td>
                        <?php } ?>
                    </tr>

                <?php
                }
        ?>
      </tbody>
    </table>
</div>



<?php
mysqli_close($exit); // HINT: This statement closes the connection with the database

ob_end_flush();
?>