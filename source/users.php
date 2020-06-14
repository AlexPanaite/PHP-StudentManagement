<?php



session_start();
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$id = $username = $password = $confirm_password = "";
$id_err = $username_err = $password_err = $confirm_password_err = "";
$role=$_POST["role_name"];
 
// Processing form data when form is submitted


if($_POST["Delete"]){

$_SESSION["command"] = "delete";

// Check if id is empty
    if(empty(trim($_POST["id"]))){
        $id_err = "Introduceti ID-ul liniei.";
    } else{
        $id = trim($_POST["id"]);
    }


// Check input errors before inserting in database
    if(empty($id_err)){
        
        // Prepare an insert statement
        $sql = "DELETE FROM users where id = (?)";
    

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_id);
        	$param_id= $id;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
            
            }

            // Close statement
            $stmt->close();
        }
  
    }
    

}



if($_POST["Add"]){
 
$_SESSION["command"] = "add";
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Validate password
     if(empty(trim($_POST["id"]))){
        $id_err = "Introduceti ID-ul liniei.";
    } else{
        $id = trim($_POST["id"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 3){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($id_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (id,username, password,role) VALUES (?, ?, ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss",$param_id, $param_username, $param_password,$param_role);
            
            // Set parameters
           	$param_id = $id;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_role = $role;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
            }

            // Close statement
            $stmt->close();
        }
    }
    
   
}


if($_POST["Delete"] || $_POST["Add"] || $_POST["Modify"]){

	 $sqlog = "INSERT INTO  logs (username,table_name,table_row,command) values (?,?,?,?)";

	  if($stmt = $mysqli->prepare($sqlog)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_usr, $param_table_name, $param_table_row, $param_command);
            
            // Set parameters
            $param_usr= $_SESSION["username"];
            $param_table_name = "users";
            $param_table_row = $id;
            $param_command = $_SESSION["command"];
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
            }

            // Close statement
            $stmt->close();
        }

	   // Close connection
    $mysqli->close();
}


?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
 body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav-right {
  float:right;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}


.topnav a.active {
  background-color: #4CAF50;
  color: white;
}


table {
clear: left;
border-collapse: collapse;
width: 50%;
color: #588c7e;
font-family: monospace;
font-size: 25px;
text-align: left;
margin-left: 80px;
border: 1px solid #ddd;
}
th {
cursor: pointer;
background-color: #588c7e;
color: white;
}

tr:nth-child(even) {background-color: #f2f2f2}

.row{
display:flex

}
.column-left {
float: left;

}
.column-right {
float: right;

width: 350px;
margin-right: 200px;
margin-left:100px;
padding: 20px;}

.row:after {
content: "";
display: table;
clear: both;}

#myInput {
  background-image: url('https://img.icons8.com/android/24/000000/search.png'); /* Add a search icon to input */
  background-position: 5px 7px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 300px; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 6px 20px 6px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */ /* Add some space below the input */
  margin-top: 30px;
  margin-bottom: 10px;
  margin-left: 80px;
  margin-right: 20px;
}

#btnXls {
  
  margin-right: 10px;	
  
}


    </style>
</head>
<body>
<div class="topnav">
  <a href="index.php">Home</a>
  <a href="studenti.php">Studenti</a>
  <a href="catalog.php">Catalog</a>
  <a href="inmatriculare.php">Inmatriculare</a>
<a class="active" href="catalog.php">Users</a>
<a href="logs.php">Logs</a>

	<div class="topnav-right">
  		<a href="reset.php" class="btn btn" >Reset Your Password</a>
  		<a href="logout.php" class="btn btn ">Log Out</a>
	</div>
</div>

   

<span class="column-left" >
<input  type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
<button class="btn btn-success" id= "btnXls" onclick="exportTableToExcel('myTable', 'Users')" >Xls file</button>
<button class="btn btn-danger" id="btnExport" value="Export" onclick="Export()" >PDF file</button>
</span>
<table id="myTable" class="column-left" border="1">
<tr>
<th onclick="sortTable(0)">ID</th>
<th onclick="sortTable(1)">Username</th>
<th onclick="sortTable(2)">Created_at</th>
<th onclick="sortTable(3)">Role</th>
</tr>
<?php
$conn = mysqli_connect("localhost", "", "", "");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql    = "SELECT id,username,created_at,role FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["created_at"] . "</td><td>" . $row["role"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
</table>
		<form class="column-right" action="" method="post">
        <h2>Create an account.</h2>
        <p>Please fill this form to create an account.</p>
        <div class="form-group <?php echo (!empty($id_err)) ? 'has-error' : ''; ?>">
                <label>ID</label>
                <input type="text" name="id" class="form-control" value="<?php echo $id; ?>">
                <span class="help-block"><?php echo $id_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
        <div class="form-group">
        <label>Role</label>
        	<br>
           	<select name="role_name" style="height:35px; width:120px" >
  				<option value="Student">Student</option>  
  				<option value="Profesor">Profesor</option>  
  				<option value="Secretar">Secretar</option>  
 				<option value="Admin">Admin</option>
			</select>  
        	</div>
            <div class="form-group">
                <input type="submit" name="Add" class="btn btn-primary" value="Add">
                <input type="submit" name="Delete" class="btn btn-primary" value="Delete">
            </div>
        </form>
    

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

 <script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.62/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script type="text/javascript">
        function Export() {
            html2canvas(document.getElementById('myTable'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                        	quality: 1,
                        	width: 500,
                        	scale: 3
                        
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Users.pdf");
                }
            });
        }
    </script>

</body>
</html>