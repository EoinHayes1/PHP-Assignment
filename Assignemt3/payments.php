<?php
	// had to use localhost:3307 to get it to work on my computer but I have changed it to localhost here
	   $conn = mysqli_connect("localhost", "root", "", "classicmodels");
	   // Check connection and print error if no connection 
	   if (mysqli_connect_errno()) {
	    echo "Could not connect to the database. <br> " . mysqli_connect_error();
	    exit();}
	   $sql = "SELECT customerNumber, checkNumber, paymentDate, amount FROM payments
	   order by paymentDate desc
	   limit 20;";
	   $result = $conn->query($sql);
	   ?>
<!DOCTYPE html>
<html lang="en">
	<html>
		<head>
			<title>PHP MySQL Query Data Demo</title>
			<link rel="stylesheet" type="text/css" href="phpstyle.css">
		</head>
		<body>
			<div id="container">
				<header><?php include 'navbar.php';?></header>
				<h1>Payments</h1>
				<table>
					<thead>
						<tr>
							<th>Customer Number</th>
							<th>Check Number</th>
							<th>Payment Date</th>
							<th>Amount Spent</th>
						</tr>
					</thead>
					<?php
						while($row = $result->fetch_assoc())                    
						{
						echo "<tr><td><a href=\"payments.php?get=" . $row["customerNumber"]."\">" . $row["customerNumber"]. "</a></td><td>" . $row["checkNumber"] . "</td><td>" . $row["paymentDate"] . "</td><td>" ."$" . $row["amount"] . "</td></tr>";           
						}
						echo "</table>";
						?>
					</tbody>
				</table>
				</table>
				<br>
				<button type="button" id="myButt" onclick = "myFunction()">Show/Hide details</button>
				<br>
				<br>
				<script>
					function myFunction() {
					    var x = document.getElementById("Second");
					        if (x.style.display === "none") {
					            x.style.display = "block";} 
					        else {
					            x.style.display = "none";}
					        }
				</script>
				<div id="Second">
					<table>
						<thead>
							<tr>
								<th>Phone Number</th>
								<th>Employee No.</th>
								<th>Credit Limit</th>
								<th>Amount Spent</th>
							</tr>
						</thead>
						<?php
							//error check if get is set
							  if(isset($_GET['get'])) {
							  $get = $_GET['get'];
							// display customer id outside of table just because I though it looked nice and helped understand which custmer was being viewed.  The sales number, phone and creditlimit (depending when when purchased) may change in the database but the customer id wont so rather than repeat it I put it outside the table.  
                            // also added a dollar sign assuming this was an american database 
							  echo "The number customer id is " . $get ."<br><br>";
							  $sqlCC = "SELECT c.phone, c.salesRepEmployeeNumber, c.creditLimit, p.amount FROM payments p,  customers c
							  where p.customerNumber = c.customerNumber and p.customerNumber = ".$get.";";
							  $resultCC = $conn->query($sqlCC);
							  while($row = $resultCC->fetch_assoc()) 
							  {
							  echo "<tr><td>" . $row["phone"]. "</td><td>" . $row["salesRepEmployeeNumber"]. "</td><td>" ."$" .$row["creditLimit"]. "</td><td>" ."$" . $row["amount"]. "</td></tr>";
							  }
							  echo "</table>";
							  // sum is show as a stand alone query as it couldnt be put in the table 
							  $sqlCa = "SELECT sum(amount) FROM payments
							  where customerNumber = ".$get."
							  limit 20;";
							  $resultCa = $conn->query($sqlCa);
							  while($row = $resultCa->fetch_assoc()) 
							  {
							  echo "<br>Sum of amount is $" . $row["sum(amount)"];
							  }
							  
							  }
							//output of error check
							  else {
							  echo 'Please select a customer to display. <br><br>';
							  }
							  ?>
					</table>
				</div>
				<br>
				<footer><?php include 'footer.php';?></footer>
			</div>
		</body>
	</html>