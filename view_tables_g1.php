<?php
//// Ze
////-----DB Connection code------
//// $servername = "localhost";
//// $serverUsername = "zw6aw";                         //computing id
//// $serverPassword = "5WrBeQbh";                   //---- your password
//// $database = "zw6aw";              // computing id
//// Leo
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
// $conn = mysqli_connect($servername, $serverUsername, $serverPassword, $database);
$conn = new mysqli($servername, $serverUsername, $serverPassword, $database);
// Check connection
if (!$conn) {
	die("connection failed: " . mysqli_connect_error());
		}

mysql_select_db($serverUsername);

?>
<!DOCTYPE html> 
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
      <a href="manage_orders_g1.php">Orders</a>
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
		<?php			
			$sql = "SELECT * FROM users";
			$result = mysqli_query($conn, $sql);
			
			$sql1 = "SHOW TABLES;";
			$result1 = mysqli_query($conn, $sql1);
			if (mysqli_num_rows($result1) > 0) {
				$i = 1;
				$tables = array();
				while($row = mysqli_fetch_assoc($result1)) {
					$tables[$i] = $row["Tables_in_lr3hj"];
					$i++;
				}
			} else {
				echo "0 result";
			}
			?>
 <!--     <thead>
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
-->
		<?php
			$q = isset($_GET['q'])? htmlspecialchars($_GET['q']) : '';
			//$q = '';
			?>
		
		<form action = "" method = "get">
			<select name = "q">
			<option value="">Please select a table</option>
			<?php
			foreach($tables as $key => $value):
			echo '<option value="'.$key.'">'.$value.'</option>';
			endforeach;
			?>
			</select>
		<input type = "submit" value = "Submit">
		<form>
		<?php
			if($q) {
				$sql2 = "SHOW COLUMNS FROM ". $tables[$q];
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
				$sql3 = "SELECT * FROM ". $tables[$q];
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
			} 
			?>
		
		
		<?php
			mysqli_close($conn);
			?>
    </table>
</div>
</body>
</html>