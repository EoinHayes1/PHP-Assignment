<?php
	// had to use localhost:3307 to get it to work on my computer but I have changed it to localhost here
	   $conn = mysqli_connect("localhost", "root", "", "classicmodels");
	   // Check connection, print error if it fails
	   if (mysqli_connect_errno()) {
	    echo "Could not connect to the database. <br> " . mysqli_connect_error();
	    exit();}
	   $sql = "SELECT productLine, textDescription FROM productlines";
	   $result = $conn->query($sql);
	   ?>
<!DOCTYPE html>
<html lang="en">
	<html>
		<head>
			<title>PHP MySQL Query Data Demo</title>
			<link rel="stylesheet" type="text/css" href="phpstyle.css">
			<meta charset="UTF-8">
		</head>
		<body>
			<div id="container">
				<header><?php include 'navbar.php';?></header>
				<h1>Product Lines</h1>
				<table>
					<thead>
						<tr>
							<th>Product Lines</th>
							<th>Description</th>
						</tr>
					</thead>
					<?php    
						// puts the variable in the url so the second table can grap it 
						  while($row = $result->fetch_assoc()) {
						      echo "<tr><td onload = myFunction()><a href=\"index.php?get=" . $row["productLine"]."\">" . $row["productLine"]. "</a></td><td>" . $row["textDescription"] . "</td></tr>";
						  }
						  echo "</table>";
						  ?>
					</tbody>
				</table>
				</table>
				<br>
				<!-- Just inserted to hide the display if the user wanted-->
				<button type="button" id="myButt" onclick = "myFunction()">Show/Hide details</button>
				<br>
				<br>
				<script>
					//hides display if shown, displays if it isnt shown 
					function myFunction() {
					   var x = document.getElementById("Second");
					       if (x.style.display === "none") {
					           x.style.display = "block";} 
					       else {
					           x.style.display = "none";}
					       }
				</script>
				<!-- Just inserted to hide the display if the user wanted-->
				<div id="Second">
					<table>
						<thead>
							<tr>
								<th>Code</th>
								<th>Product Name</th>
								<th>Product Line</th>
								<th>Vendor</th>
								<th>Description</th>
								<th>Stock</th>
								<th>Price</th>
								<th>MSRP</th>
							</tr>
						</thead>
						<?php
							// get takes the variable from the url and uses it in the where part of the query
							// if get isnt set, it will tell the user they have to select the productline before it can display
							  if(isset($_GET['get'])) {
							  $get = $_GET['get'];
							  
							  $sqlCC = "SELECT productCode, productName, productLine, productScale, productVendor, productDescription, quantityInStock, buyPrice, MSRP  FROM classicmodels.products
							  where productline =  '".$get."' ;";
							  $resultCC = $conn->query($sqlCC); 
							  while($row = $resultCC->fetch_assoc()) 
							  {
							  echo "<tr><td>" . $row["productCode"]. "</td><td>" . $row["productName"]. "</td><td>" . $row["productLine"]. "</td><td>" . $row["productVendor"]. "</td><td>" . $row["productDescription"]. "</td><td>" . $row["quantityInStock"]. "</td><td>" . $row["buyPrice"]. "</td><td>" . $row["MSRP"] . "</td></tr>";
							  }
							  echo "</table>";}
							  else {
							  echo 'Please select a product line to display. <br><br>';
							  }
							  ?>
					</table>
				</div>
				<br>
				<footer><?php include 'footer.php';?></footer>
			</div>
		</body>
	</html>