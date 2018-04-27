<?php
//-----DB Connection code------
$servername = "localhost";
$serverUsername = "lr3hj";                         //computing id
$serverPassword = "UVCiZHAG";                   //---- your password
$database = "lr3hj";              // computing id
////-----LOCAL DB Connection code------
//$servername = "localhost";
//$serverUsername = "root";
//$serverPassword = "+Hdz793241923";
//$database = "group1_database";

// create connection
$conn = new mysqli($servername, $serverUsername, $serverPassword, $database);
// Check connection
if (!$conn) {
    die("connection failed: " . mysqli_connect_error());
        }

mysql_select_db($serverUsername);
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
      <a class="active" href="index_g1.php">Home</a>
      <a href="add_item_g1.php">Add Item</a>
      <a href="update_inventory_g1.php">Inventory</a>
      <a href="manage_orders_g1.php">Orders</a>
      <a href="view_tables_g1.php">View Tables</a>
  </div> 
  <h2 style="text-align: center;
    display: block;
    color: #000066;
    font-weight: bold;"> Group 1 CS6750 Project </h2>
    <p><h5 style="text-align: center;">Danzhe Huang, Leonard Ramsey, Sicong Cai, Ze Wang</h5></p>

  <div class="content" style="padding-left: 20px; padding-right: 20px;">
    <h1 style="text-align: left; 
        display: block;
        color: #000066;
        font-weight: bold;">View Records</h1>
      <hr> 
      <b style="text-align: left; font-size: 18px;">The ranking among categories</b>
      <hr>
      <p></p>
      <table>
            <thead>
            <tr>
            <td>
            Category
            </td>
            <td>Number Sold
            </td>
            </tr>
            </thead>
            <tbody>
        <?php           
            $sql = "select c.CategoryName, SUM(b.Quantity) from Items a
                    left join  OrderDetails b 
                     on a.ItemId = b.ItemID
                    left join Categories c
                     on a.CategoryID = c.CategoryID
                    Group by c.CategoryName
                    Order by SUM(b.Quantity) DESC;";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result)) {
                    $tables = array();
                    $i = 1;
                    while($row = mysqli_fetch_assoc($result)) {
                        $tables[$i] = $row["CategoryName"];
                        echo "<tr>";
                            echo "<td>". $row["CategoryName"]. "</td>";
                            if($row["SUM(b.Quantity)"] == NULL) {
                                echo "<td>N/A</td>";
                            } else {
                                echo "<td>". $row["SUM(b.Quantity)"]. "</td>";
                            }
                        echo "</tr>";
                        $i++;

                    }
             } else {
                 echo "0 result";
             }
       echo "</tbody>";
       ?>
    </table>
    <br>
</div>

  <div class="content" style="padding-left: 20px; padding-right: 20px;">
    <h1 style="text-align: left; 
        display: block;
        color: #000066;
        font-weight: bold;">View Records</h1>
      <hr> 
      <b style="text-align: left; font-size: 18px;">See a certain category</b>
      <hr>
       <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
        
        <br>
        <select name="item_category" id="id_item_category" required>
          <option value="">Choose a category</option>
          <?php
          $sql = "Select CategoryName, CategoryID from Categories";
          $results = $conn->query($sql);
          while($row = $results->fetch_assoc()) {
            ?>
            <option value="<?php echo $row['CategoryName'] ?>"><?php echo $row['CategoryName']?></option>
          <?php 
          } 
          ?>
        </select>
        <br>

        <input type = "submit" name="submit" value="Submit">
       </form>
    <br>
    <table>
            <thead>
            <tr>
            <td>
            ItemName
            </td>
            <td>Quantity
            </td>
            </tr>
            </thead>
       <tbody>
        <?php
        if ($_POST['item_category']) {
                $item_category = $_POST['item_category'];
                $sql2 = "Select b.CategoryName, a.ItemName, SUM(c.Quantity) from Items a inner join Categories b 
                        on a.CategoryID = b.CategoryID
                        inner join OrderDetails c 
                        on a.ItemID = c.ItemID
                        where b.CategoryName = '". $item_category. "'
                        GROUP BY a.ItemName
                        Order by SUM(c.Quantity) DESC";
                        
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2)) {
                    $tables2 = array();
                    $i = 1;
                    while($row2 = mysqli_fetch_assoc($result2)) {
                        $tables2[$i] = $row2["ItemName"];
                        echo "<tr>";
                            echo "<td>". $row2["ItemName"]. "</td>";
                            if($row2["SUM(c.Quantity)"] == NULL) {
                                echo "<td>N/A</td>";
                            } else {
                                echo "<td>". $row2["SUM(c.Quantity)"]. "</td>";
                            }
                        echo "</tr>";
                        $i++;

                    }
                } else {
                 echo "0 result";
                }
        }
        echo "</tbody>";
        ?>
        <?php
            mysqli_close($conn);
        ?>
    </table>
    <br>
 </div>
</body>
</html>