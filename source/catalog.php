<?php
// Initialize the session


session_start();
require_once "config.php";
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;}


// Define variables and initialize with empty values
$id = $codst = $sesiune = $ip = $bd = $paw = $plf = $poo = $am = $lft = "";
$nul= 'NULL';
$id_err = $sesiune_err = $codst_err  = "";
 



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
        $sql = "DELETE FROM catalog where id = (?)";
    

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



if($_POST["Modify"]){
    $_SESSION["command"] = "modify";
   // Check if matricol is empty
    if(empty(trim($_POST["id"]))){
        $id_err = "Introduceti ID-ul liniei.";
    } else{
        $id = trim($_POST["id"]);
    }

    // Check if cetatenie is empty
    if(empty(trim($_POST["sesiune"]))){
        $sesiune_err = "Introduceti sesiunea examenelor.";
    } else{
        $sesiune = trim($_POST["sesiune"]);
    }
    
    // Check if codst is empty
    if(empty(trim($_POST["codst"]))){
        $codst_err = "Introduceti codul de inregistrare al studentului.";
    } else{
        $codst = trim($_POST["codst"]);
    }

	if(empty(trim($_POST["ip"]))){
        $ip = NULL;
    } else{
        $ip = trim($_POST["ip"]);
    }
	if(empty(trim($_POST["bd"]))){
        $bd = NULL;
    } else{
        $bd = trim($_POST["bd"]);
    }
	if(empty(trim($_POST["paw"]))){
        $paw = NULL;
    } else{
        $paw = trim($_POST["paw"]);
    }
	if(empty(trim($_POST["plf"]))){
        $plf = NULL;
    } else{
        $plf = trim($_POST["plf"]);
    }
	if(empty(trim($_POST["poo"]))){
        $poo= NULL;
    } else{
        $poo = trim($_POST["poo"]);
    }
	if(empty(trim($_POST["am"]))){
        $am= NULL;
    } else{
        $am = trim($_POST["am"]);
    }
	if(empty(trim($_POST["lft"]))){
        $lft = NULL;
    } else{
        $lft = trim($_POST["lft"]);
    }

	


  // Check input errors before inserting in database
    if(empty($id_err)  && empty($sesiune_err)&& empty($codst_err)){
        
        // Prepare an insert statement
        $sql = "UPDATE  catalog SET  sesiune=?, ip=?, bd=?,paw=?,plf=?,poo=?,am=?,lft=? where id=?";
        
    

       if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssssssss",$param_sesiune, $param_ip, $param_bd, $param_paw,$param_plf, $param_poo, 
                              $param_am, $param_lft, $param_id);
        	$param_sesiune = $sesiune; 
        	$param_ip= $ip;
        	$param_bd = $bd;
       		$param_paw = $paw;
       		$param_plf = $plf;
       		$param_poo = $poo;
       		$param_am = $am;
       		$param_lft = $lft;
       		$param_id=	$id; 
       		
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
    // Check if matricol is empty
    if(empty(trim($_POST["id"]))){
        $id_err = "Introduceti ID-ul liniei.";
    } else{
        $id = trim($_POST["id"]);
    }
    
    // Check if nume is empty
    if(empty(trim($_POST["sesiune"]))){
        $sesiune_err = "Introduceti sesiunea examenelor.";
    } else{
        $sesiune = trim($_POST["sesiune"]);
    }
   
    // Check if codst is empty
    if(empty(trim($_POST["codst"]))){
        $codst_err = "Introduceti codul de inregistrare al studentului.";
    } else{
        $codst = trim($_POST["codst"]);
    }

	if(empty(trim($_POST["ip"]))){
        $ip = NULL;
    } else{
        $ip = trim($_POST["ip"]);
    }
	if(empty(trim($_POST["bd"]))){
        $bd = NULL;
    } else{
        $bd = trim($_POST["bd"]);
    }
	if(empty(trim($_POST["paw"]))){
        $paw = NULL;
    } else{
        $paw = trim($_POST["paw"]);
    }
	if(empty(trim($_POST["plf"]))){
        $plf = NULL;
    } else{
        $plf = trim($_POST["plf"]);
    }
	if(empty(trim($_POST["poo"]))){
        $poo= NULL;
    } else{
        $poo = trim($_POST["poo"]);
    }
	if(empty(trim($_POST["am"]))){
        $am= NULL;
    } else{
        $am = trim($_POST["am"]);
    }
	if(empty(trim($_POST["lft"]))){
        $lft = NULL;
    } else{
        $lft = trim($_POST["lft"]);
    }

	
		

  // Check input errors before inserting in database
    if(empty($id_err) && empty($sesiune_err) && empty($codst_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO catalog (id, codst, sesiune, ip, bd, paw, plf, poo, am , lft) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
    

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssssss", $param_id, $param_codst,$param_sesiune, $param_ip, $param_bd, $param_paw, $param_plf, $param_poo,$param_am, $param_lft);
        	$param_id=	$id; 
        	$param_codst = $codst;
        	$param_sesiune = $sesiune; 
        	$param_ip= $ip;
        	$param_bd = $bd;
       		$param_paw = $paw;
       		$param_plf = $plf;
       		$param_poo = $poo;
       		$param_am = $am;
       		$param_lft = $lft;
       		
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
            
            }

            // Close statement
            $stmt->close();
        }
    }

    
}



if($_SESSION["role"]=="Student"){
?>
<style type="text/css">
#mat{
display:none;
}
#comenzi{
display:none;
}
#usr{
display:none;
}
#log{
display:none;
}
</style>
<?php
}

if($_SESSION["role"]=="Secretar"){
?>
<style type="text/css">
#comenzi{
display:none;
}
#usr{
display:none;
}
#log{
display:none;
}
</style>
<?php
}

if($_SESSION["role"]=="Profesor"){
?>
<style type="text/css">
#usr{
display:none;
}
#log{
display:none;
}
</style>
<?php
}


if($_POST["Delete"] || $_POST["Add"] || $_POST["Modify"]){

	 $sqlog = "INSERT INTO  logs (username,table_name,table_row,command) values (?,?,?,?)";

	  if($stmt = $mysqli->prepare($sqlog)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_usr, $param_table_name, $param_table_row, $param_command);
            
            // Set parameters
            $param_usr= $_SESSION["username"];
            $param_table_name = "catalog";
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
    <title>Catalog</title>
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
  <a class="active" href="catalog.php">Catalog</a>
	<div id="mat">
  <a href="inmatriculare.php">Inmatriculare</a>
	</div>
<div id="usr">
  <a href="users.php">Users</a>
	</div>
<div id="log">
  <a href="logs.php">Logs</a>
	</div>
	<div class="topnav-right">
  		<a href="reset.php" class="btn btn" >Reset Your Password</a>
  		<a href="logout.php" class="btn btn ">Log Out</a>
	</div>
</div>

<span class="column-left" >
<input  type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
<button class="btn btn-success" id= "btnXls" onclick="exportTableToExcel('myTable', 'catalog')" >Xls file</button>
<button class="btn btn-danger" id="btnExport" value="Export" onclick="Export()" >PDF file</button>
</span>
<table id="myTable" class="column-left" border="1">
<tr>
<th onclick="sortTable(0)">ID</th>
<th onclick="sortTable(1)">CodSt</th>
<th onclick="sortTable(2)">Nume</th>
<th onclick="sortTable(3)">Prenume</th>
<th onclick="sortTable(4)">Sesiune</th>
<th onclick="sortTable(5)">IP</th>
<th onclick="sortTable(6)">BD</th>
<th onclick="sortTable(7)">PAW</th>
<th onclick="sortTable(8)">PLF</th>
<th onclick="sortTable(9)">POO</th>
<th onclick="sortTable(10)">AM</th>
<th onclick="sortTable(11)">LFT</th>
</tr>


<?php
$conn = mysqli_connect("localhost", "", "", "");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql    = "SELECT catalog.CodSt as CodSt,student.Nume as Nume ,student.Prenume as Prenume,Sesiune,id,IP,BD,PAW ,PLF,POO,AM,LFT FROM catalog,student where student.CodSt=catalog.CodSt";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["CodSt"] . "</td><td>" . $row["Nume"] . "</td><td>" . $row["Prenume"] . "</td><td>" . $row["Sesiune"] . "</td><td>" . $row["IP"] . "</td><td>" . $row["BD"] . "</td><td>" . $row["PAW"]
         . "</td><td>" . $row["PLF"] . "</td><td>" . $row["POO"] . "</td><td>" . $row["AM"] . "</td><td>" . $row["LFT"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
</table>

	<form class="column-right" action="" method="post" id="comenzi">
          <h2> Introduceti datele studentului mai jos </h2>
          <div class="form-group <?php echo (!empty($codst_err)) ? 'has-error' : ''; ?>">
                <label>Cod Student</label>
                <input type="text" name="codst" class="form-control" value="<?php echo $codst; ?>">
                <span class="help-block"><?php echo $codst_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($id_err)) ? 'has-error' : ''; ?>">
                <label>ID</label>
                <input type="text" name="id" class="form-control" value="<?php echo $id; ?>">
                <span class="help-block"><?php echo $id_err; ?></span>
            </div>
         <div class="form-group <?php echo (!empty($sesiune_err)) ? 'has-error' : ''; ?>">
                <label>Sesiune</label>
                <input type="text" name="sesiune" class="form-control" value="<?php echo $sesiune; ?>">
                <span class="help-block"><?php echo $sesiune_err; ?></span>
            </div>
            <div class="form-group ">
                <label>IP</label>
                <input type="text" name="ip" class="form-control" value="<?php echo $ip; ?>">
                <span class="help-block"></span>
            </div>
           <div class="form-group ">
                <label>BD</label>
                <input type="text" name="bd" class="form-control" value="<?php echo $bd; ?>">
                <span class="help-block"></span>
            </div>
        	<div class="form-group ">
                <label>PAW</label>
                <input type="text" name="paw" class="form-control" value="<?php echo $paw; ?>">
                <span class="help-block"></span>
            </div>
        	<div class="form-group ">
                <label>PLF</label>
                <input type="text" name="plf" class="form-control" value="<?php echo $plf; ?>">
                <span class="help-block"></span>
            </div>
           <div class="form-group ">
                <label>POO</label>
                <input type="text" name="poo" class="form-control" value="<?php echo $poo; ?>">
                <span class="help-block"></span>
            </div>
          <div class="form-group ">
                <label>AM</label>
                <input type="text" name="am" class="form-control" value="<?php echo $am; ?>">
                <span class="help-block"></span>
            </div>
          <div class="form-group ">
                <label>LFT</label>
                <input type="text" name="lft" class="form-control" value="<?php echo $lft; ?>">
                <span class="help-block"></span>
            </div>
        
            <div class="form-group">
                <input type="submit" name = "Add" class="btn btn-primary" value="Add">
            	<input type="submit" name = "Modify" class="btn btn-primary" value="Modify">
                <input type="submit" name = "Delete" class="btn btn-primary" value="Delete">
          		<input type="reset"  name = "Reset" class="btn btn-primary" value="Reset">
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
    td = tr[i].getElementsByTagName("td")[2];
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
                    pdfMake.createPdf(docDefinition).download("Catalog.pdf");
                }
            });
        }
    </script>
</body>
</html>
