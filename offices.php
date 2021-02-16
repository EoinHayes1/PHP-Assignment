<?php
	// had to use localhost:3307 to get it to work on my computer but I have changed it to localhost here
	$conn = mysqli_connect("localhost", "root", "", "classicmodels");
	// Check connection, print error if it fails
	if (mysqli_connect_errno()) {
	  echo "Could not connect to the database. <br> " . mysqli_connect_error();
	  exit();}
	$sql = "SELECT officeCode, city, phone, addressLine1, addressLine2, state, country, postalCode, territory FROM offices;";
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
				<h1>Offices</h1>
				<table>
					<thead>
						<tr>
							<th>City</th>
							<th>Phone Number</th>
							<th>Address</th>
							<th> </th>
						</tr>
					</thead>
					<?php
						// Here I combined the FULL addresses of the offices instead of just the first line as I assumed just having the first line wouldnt be much use.  
						//also made the button a link when clicked to show the office id for the where query in the below sql statement
						while($row = $result->fetch_assoc()) 
						{
						echo "<tr><td>" . $row["city"]. "</td><td>" . $row["phone"] . "</td><td>" . $row["addressLine1"] . "<br>" . $row["addressLine2"] . "<br>" . $row["city"] ."<br>". $row["state"] . "<br>" . $row["country"] . "<br>" . $row["postalCode"] . "<br>" . $row["territory"] . "</td><td>"."<a href=\"offices.php?get=" . $row["officeCode"]."\"><button>List of Employees</button></a>" ."</td></tr>";
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
					//same thing, hides display if shown, displays if it isnt shown 
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
                            <th>Name</th>
                            <th>Posoition</th>
                            <th>Employee No.</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <?php
                        // tells user to select a list of employees to display table, if it is, print table
                        if(isset($_GET['get'])) {
                        $get = $_GET['get'];
                        $sqlOffice1 = "SELECT firstname, lastName, jobTitle, employeeNumber, email from employees
                        where officeCode = '".$get."'
                        order by jobTitle;";
                        $resultOffice1 = $conn->query($sqlOffice1);    

                        while($row = $resultOffice1->fetch_assoc()) 
                        {
                        echo "<tr><td>" . $row["firstname"]. " " . $row["lastName"]. "</td><td>" . $row["jobTitle"]. "</td><td>" . $row["employeeNumber"]. "</td><td>" . $row["email"].  "</td></tr>";
                        }
                        echo "</table>";}
                        else {
                        echo 'Please select a list of employees to display. <br><br>';
                        }
                        ?>
                </table>
            </div>
            <br>
            <footer><?php include 'footer.php';?></footer>
        </div>
    </body>
</html>