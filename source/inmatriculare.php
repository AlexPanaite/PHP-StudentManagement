<?php

// Initialize the session
session_start();
require_once "config.php";
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;}



// Define variables and initialize with empty values
$codm = $nume = $prenume = $cetatenie = $datan = $medie = $formainv = $bursa = $codst = $cods = $an = $grupa = "";
$codm_err = $nume_err = $prenume_err = $cetatenie_err = $datan_err = $medie_err = $formainv_err = $bursa_err = $codst_err = $cods_err = $an_err = $grupa_err = "";
 
// Processing form data when form is submitted


if($_POST["Delete"]){
$_SESSION["command"] = "delete";
// Check if codst is empty
    if(empty(trim($_POST["codst"]))){
        $codst_err = "Introduceti codul de inregistrare al studentului.";
    } else{
        $codst = trim($_POST["codst"]);
    }
if(empty(trim($_POST["codm"]))){
        $codm_err = "Introduceti id-ul liniei.";
    } else{
        $codm = trim($_POST["codm"]);
    }



// Check input errors before inserting in database
    if(empty($codst_err) && empty($codm_err)){
        
        // Prepare an insert statement
        $sql = "DELETE FROM inmatriculare where codst = (?)";
        $sql1 = "DELETE FROM student where codst = (?)";
    

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_codst);
        	$param_codst= $codst;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
            
            }

            // Close statement
            $stmt->close();
        }
    if($stmt = $mysqli->prepare($sql1)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_codst);
        	$param_codst = $codst;
    		
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
    if(empty(trim($_POST["codm"]))){
        $codm_err = "Introduceti numarul matricol al studentului.";
    } else{
        $codm = trim($_POST["codm"]);
    }
    
    // Check if nume is empty
    if(empty(trim($_POST["nume"]))){
        $nume_err = "Introduceti numele studentului.";
    } else{
        $nume = trim($_POST["nume"]);
    }
    
    // Check if prenume is empty
    if(empty(trim($_POST["prenume"]))){
        $prenume_err = "Introduceti prenumele studentului.";
    } else{
        $prenume = trim($_POST["prenume"]);
    }

    // Check if cetatenie is empty
    if(empty(trim($_POST["cetatenie"]))){
        $cetatenie_err = "Introduceti cetatenia studentului.";
    } else{
        $cetatenie = trim($_POST["cetatenie"]);
    }
    
    // Check if datan is empty
    if(empty(trim($_POST["datan"]))){
        $datan_err = "Introduceti data nasterii studentului.";
    } else{
        $datan = trim($_POST["datan"]);
    }
    
        // Check if medie is empty
    if(empty(trim($_POST["medie"]))){
        $medie_err = "Introduceti media studentului.";
    } else{
        $medie = trim($_POST["medie"]);
    }
    
    // Check if formainv is empty
    if(empty(trim($_POST["formainv"]))){
        $formainv_err = "Introduceti forma de invatamant studentului.";
    } else{
        $formainv = trim($_POST["formainv"]);
    }

    // Check if integralist is empty
    if(strlen(trim($_POST["bursa"]))==0){
        $bursa_err = "Introduceti daca studentul are bursa (0 sau 1).";
    } else{
        $bursa = trim($_POST["bursa"]);
    }
    
    // Check if codst is empty
    if(empty(trim($_POST["codst"]))){
        $codst_err = "Introduceti codul de inregistrare al studentului.";
    } else{
        $codst = trim($_POST["codst"]);
    }

	// Check if codst is empty
    if(empty(trim($_POST["cods"]))){
        $cods_err = "Introduceti codul de specializare al studentului.";
    } else{
        $cods = trim($_POST["cods"]);
    }

	// Check if codst is empty
    if(empty(trim($_POST["an"]))){
        $an_err = "Introduceti anul in care se afla studentul.";
    } else{
        $an = trim($_POST["an"]);
    }

// Check if codst is empty
    if(empty(trim($_POST["grupa"]))){
        $grupa_err = "Introduceti grupa in care se afla studentul.";
    } else{
        $grupa = trim($_POST["grupa"]);
    }


  // Check input errors before inserting in database
    if(empty($codm_err) && empty($nume_err) && empty($prenume_err) && empty($cetatenie_err)&& empty($datan_err) && empty($medie_err) && empty($formainv_err)
       && empty($bursa_err) && empty($codst_err) && empty($cods_err) && empty($an_err) && empty($grupa_err)){
        
        // Prepare an insert statement
        $sql = "UPDATE  student SET  nume=?, prenume=?, cetatenie=?, datan=? where codst=?";
        $sql1 = "UPDATE  inmatriculare SET codm=?, an=?, grupa=?, medie=?, bursa=?, formainv=? , cods=? where codst=?";
    

       if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_nume, $param_prenume, $param_cetatenie, $param_datan, $param_codst);
        	$param_nume=$nume; 
        	$param_prenume = $prenume; 
        	$param_cetatenie= $cetatenie;
        	$param_datan = $datan;
       		$param_codst = $codst;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
            
            }

            // Close statement
            $stmt->close();
        }
    if($stmt = $mysqli->prepare($sql1)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssss", $param_codm, $param_an, $param_grupa, $param_medie, $param_bursa, $param_formainv, $param_cods,$param_codst);
    		$param_codm = $codm;
            $param_an = $an;
      		$param_grupa= $grupa;
        	$param_medie = $medie; 
        	$param_bursa = $bursa; 
        	$param_formainv= $formainv;
        	$param_cods = $cods;
    		$param_codst = $codst;
    		
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
    if(empty(trim($_POST["codm"]))){
        $codm_err = "Introduceti id-ul liniei.";
    } else{
        $codm = trim($_POST["codm"]);
    }
    
    // Check if nume is empty
    if(empty(trim($_POST["nume"]))){
        $nume_err = "Introduceti numele studentului.";
    } else{
        $nume = trim($_POST["nume"]);
    }
    
    // Check if prenume is empty
    if(empty(trim($_POST["prenume"]))){
        $prenume_err = "Introduceti prenumele studentului.";
    } else{
        $prenume = trim($_POST["prenume"]);
    }

    // Check if cetatenie is empty
    if(empty(trim($_POST["cetatenie"]))){
        $cetatenie_err = "Introduceti cetatenia studentului.";
    } else{
        $cetatenie = trim($_POST["cetatenie"]);
    }
    
    // Check if datan is empty
    if(empty(trim($_POST["datan"]))){
        $datan_err = "Introduceti data nasterii studentului.";
    } else{
        $datan = trim($_POST["datan"]);
    }
    
        // Check if medie is empty
    if(empty(trim($_POST["medie"]))){
        $medie_err = "Introduceti media studentului.";
    } else{
        $medie = trim($_POST["medie"]);
    }
    
    // Check if formainv is empty
    if(empty(trim($_POST["formainv"]))){
        $formainv_err = "Introduceti forma de invatamant studentului.";
    } else{
        $formainv = trim($_POST["formainv"]);
    }

    // Check if integralist is empty
    if(strlen(trim($_POST["bursa"]))==0){
        $bursa_err = "Introduceti daca studentul are bursa (0 sau 1).";
    } else{
        $bursa = trim($_POST["bursa"]);
    }
    
    // Check if codst is empty
    if(empty(trim($_POST["codst"]))){
        $codst_err = "Introduceti codul de inregistrare al studentului.";
    } else{
        $codst = trim($_POST["codst"]);
    }

	// Check if codst is empty
    if(empty(trim($_POST["cods"]))){
        $cods_err = "Introduceti codul de specializare al studentului.";
    } else{
        $cods = trim($_POST["cods"]);
    }

	// Check if codst is empty
    if(empty(trim($_POST["an"]))){
        $an_err = "Introduceti anul in care se afla studentul.";
    } else{
        $an = trim($_POST["an"]);
    }

// Check if codst is empty
    if(empty(trim($_POST["grupa"]))){
        $grupa_err = "Introduceti grupa in care se afla studentul.";
    } else{
        $grupa = trim($_POST["grupa"]);
    }


  // Check input errors before inserting in database
    if(empty($codm_err) && empty($nume_err) && empty($prenume_err) && empty($cetatenie_err)&& empty($datan_err) && empty($medie_err) && empty($formainv_err)
       && empty($bursa_err) && empty($codst_err) && empty($cods_err) && empty($an_err) && empty($grupa_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO student (codst, nume, prenume, cetatenie, datan) VALUES (?, ?, ?, ?, ?)";
        $sql1 = "INSERT INTO inmatriculare (codm, an, grupa, medie, bursa, formainv, codst, cods) VALUES (?,?,?,?,?,?,?,?)";
    

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_codst, $param_nume, $param_prenume, $param_cetatenie, $param_datan);
        	$param_codst= $codst;
        	$param_nume=$nume; 
        	$param_prenume = $prenume; 
        	$param_cetatenie= $cetatenie;
        	$param_datan = $datan;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
            
            }

            // Close statement
            $stmt->close();
        }
    if($stmt = $mysqli->prepare($sql1)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssss", $param_codm, $param_an, $param_grupa, $param_medie, $param_bursa, $param_formainv, $param_codst, $param_cods);
    		$param_codm = $codm;
            $param_an = $an;
      		$param_grupa= $grupa;
        	$param_medie = $medie; 
        	$param_bursa = $bursa; 
        	$param_formainv= $formainv;
        	$param_codst = $codst;
    		$param_cods = $cods;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
            
            }

            // Close statement
            $stmt->close();
        }
    }
    
 

}

if($_SESSION["role"]=="Profesor"){
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

if($_SESSION["role"]=="Secretar"){
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
            $param_table_name = "inmatriculare";
            $param_table_row = $codm;
            $param_command = $_SESSION["command"];
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
            }

            // Close statement
            $stmt->close();
        }

}


$chart = "select count(medie)as count from inmatriculare where medie=10";
$chartrs = $mysqli->query($chart);
$count = $chartrs->fetch_assoc()["count"];

$chart1 = "select count(medie)as count1 from inmatriculare where medie<10 and medie>=9";
$chartrs1 = $mysqli->query($chart1);
$count1 = $chartrs1->fetch_assoc()["count1"];

$chart2 = "select count(medie)as count2 from inmatriculare where medie<9 and medie>=8";
$chartrs2 = $mysqli->query($chart2);
$count2 = $chartrs2->fetch_assoc()["count2"];

$chart3 = "select count(medie)as count3 from inmatriculare where medie<8 and medie>=7";
$chartrs3 = $mysqli->query($chart3);
$count3 = $chartrs3->fetch_assoc()["count3"];

$chart4 = "select count(medie)as count4 from inmatriculare where medie<8 and medie>=7";
$chartrs4 = $mysqli->query($chart4);
$count4 = $chartrs4->fetch_assoc()["count4"];

$chart5 = "select count(medie)as count5 from inmatriculare where medie<7 and medie>=6";
$chartrs5 = $mysqli->query($chart5);
$count5 = $chartrs5->fetch_assoc()["count5"];

$chart6 = "select count(medie)as count6 from inmatriculare where medie<6 and medie>=5";
$chartrs6 = $mysqli->query($chart6);
$count6 = $chartrs4->fetch_assoc()["count6"];


$dataPoints = array(
	array("label"=> "Media 10", "y"=> $count),
	array("label"=> "Media intre 9 si 10", "y"=> $count1),
	array("label"=> "Media intre 8 si 9", "y"=> $count2),
	array("label"=> "Media intre 7 si 8", "y"=> $count3),
	array("label"=> "Media intre 6 si 7", "y"=> $count4),
	array("label"=> "Media intre 5 si 6", "y"=> $count5)
);

	   // Close connection
    $mysqli->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Inmatriculare</title>
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
#filter{
  
  margin-top: 30px;
  margin-left: 15px;
  
}

</style>
</head>
<body>


<div class="topnav">
  <a href="index.php">Home</a>
  <a href="studenti.php">Studenti</a>
  <a href="catalog.php">Catalog</a>
  <a class="active" href="inmatriculare.php">Inmatriculare</a>
<div id="usr">
  <a href="users.php">Users</a>
	</div>
<div id="log">
  <a href="logs.php">Logs</a>
	</div>
	<div class="topnav-right">
  		<a href="reset.php"  >Reset Your Password</a>
  		<a href="logout.php" >Log Out</a>
	</div>
</div>
 
<span class="column-left" >
<input  type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
<button class="btn btn-success" id= "btnXls" onclick="exportTableToExcel('myTable', 'Inmatriculare')" >Xls file</button>
<button class="btn btn-danger" id="btnExport" value="Export" onclick="Export()" >PDF file</button>
</span>
<form class="form-group" action="" method="post">
<select id="filter" name="filter" style="height:35px; width:120px" >
				<option value="reset">Reset</option> 
  				<option value="bursa">Cu bursa</option>  
  				<option value="fbursa">Fara bursa</option>  
			</select>
<input id="lbtn" type="submit" name="Load" class="btn btn-primary" value="Load">
</form>

<table id="myTable" class="column-left" border="1">
<tr>
<th onclick="sortTable(0)">ID</th>
<th onclick="sortTable(1)">Nume</th>
<th onclick="sortTable(2)">Prenume</th>
<th onclick="sortTable(3)">An</th>
<th onclick="sortTable(4)">Medie</th>
<th onclick="sortTable(5)">Bursa</th>
<th onclick="sortTable(6)">FormaInv</th>
<th onclick="sortTable(7)">CodSt</th>
<th onclick="sortTable(8)">CodS</th>
</tr>
<?php
if($_POST["filter"]=="reset"){
$conn = mysqli_connect("localhost", "", "", "");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql    = "SELECT inmatriculare.CodM as CodM,student.Nume as Nume,student.Prenume as Prenume,An,Grupa,Medie,Bursa,FormaInv,inmatriculare.CodSt,CodS FROM inmatriculare,student where inmatriculare.CodSt=student.CodSt";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["CodM"] . "</td><td>" . $row["Nume"] . "</td><td>" . $row["Prenume"] . "</td><td>" . $row["An"] . "</td><td>" . $row["Medie"] . "</td><td>" . $row["Bursa"] . "</td><td>" . $row["FormaInv"]
         . "</td><td>" . $row["CodSt"] . "</td><td>" . $row["CodS"]. "</td></tr>";
    }
    echo "</table>";
}
$conn->close();
}

if($_POST["filter"]=="bursa"){
$conn = mysqli_connect("localhost", "", "", "");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql    = "SELECT inmatriculare.CodM as CodM,student.Nume as Nume,student.Prenume as Prenume,An,Grupa,Medie,Bursa,FormaInv,inmatriculare.CodSt,CodS FROM inmatriculare,student where inmatriculare.CodSt=student.CodSt and bursa=1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["CodM"] . "</td><td>" . $row["Nume"] . "</td><td>" . $row["Prenume"] . "</td><td>" . $row["An"] . "</td><td>" . $row["Medie"] . "</td><td>" . $row["Bursa"] . "</td><td>" . $row["FormaInv"]
         . "</td><td>" . $row["CodSt"] . "</td><td>" . $row["CodS"]. "</td></tr>";
    }
    echo "</table>";
}
$conn->close();
}

if($_POST["filter"]=="fbursa"){
$conn = mysqli_connect("localhost", "", "", "");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql    = "SELECT inmatriculare.CodM as CodM,student.Nume as Nume,student.Prenume as Prenume,An,Grupa,Medie,Bursa,FormaInv,inmatriculare.CodSt,CodS FROM inmatriculare,student where inmatriculare.CodSt=student.CodSt and bursa=0";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["CodM"] . "</td><td>" . $row["Nume"] . "</td><td>" . $row["Prenume"] . "</td><td>" . $row["An"] . "</td><td>" . $row["Medie"] . "</td><td>" . $row["Bursa"] . "</td><td>" . $row["FormaInv"]
         . "</td><td>" . $row["CodSt"] . "</td><td>" . $row["CodS"]. "</td></tr>";
    }
    echo "</table>";
}
$conn->close();
}


?>
</table>

		<form class="column-right" action="" method="post" id="comenzi">
          <h2> Introduceti datele studentului mai jos </h2>
          <div class="form-group <?php echo (!empty($codst_err)) ? 'has-error' : ''; ?>">
                <label>Cod Student</label>
                <input type="text" name="codst" class="form-control" value="<?php echo $codst; ?>">
                <span class="help-block"><?php echo $codst_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($codm_err)) ? 'has-error' : ''; ?>">
                <label>ID</label>
                <input type="text" name="codm" class="form-control" value="<?php echo $codm; ?>">
                <span class="help-block"><?php echo $codm_err; ?></span>
            </div>
         <div class="form-group <?php echo (!empty($cods_err)) ? 'has-error' : ''; ?>">
                <label>Cod Specializare</label>
                <input type="text" name="cods" class="form-control" value="<?php echo $cods; ?>">
                <span class="help-block"><?php echo $cods_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($nume_err)) ? 'has-error' : ''; ?>">
                <label>Nume</label>
                <input type="text" name="nume" class="form-control" value="<?php echo $nume; ?>">
                <span class="help-block"><?php echo $nume_err; ?></span>
            </div>
           <div class="form-group <?php echo (!empty($prenume_err)) ? 'has-error' : ''; ?>">
                <label>Prenume</label>
                <input type="text" name="prenume" class="form-control" value="<?php echo $prenume; ?>">
                <span class="help-block"><?php echo $prenume_err; ?></span>
            </div>
        	<div class="form-group <?php echo (!empty($an_err)) ? 'has-error' : ''; ?>">
                <label>An</label>
                <input type="text" name="an" class="form-control" value="<?php echo $an; ?>">
                <span class="help-block"><?php echo $an_err; ?></span>
            </div>
        	<div class="form-group <?php echo (!empty($grupa_err)) ? 'has-error' : ''; ?>">
                <label>Grupa</label>
                <input type="text" name="grupa" class="form-control" value="<?php echo $grupa; ?>">
                <span class="help-block"><?php echo $grupa_err; ?></span>
            </div>
           <div class="form-group <?php echo (!empty($cetatenie_err)) ? 'has-error' : ''; ?>">
                <label>Cetatenie</label>
                <input type="text" name="cetatenie" class="form-control" value="<?php echo $cetatenie; ?>">
                <span class="help-block"><?php echo $cetatenie_err; ?></span>
            </div>
           <div class="form-group <?php echo (!empty($datan_err)) ? 'has-error' : ''; ?>">
                <label>Data nasterii</label>
                <input type="text" name="datan" class="form-control" value="<?php echo $datan; ?>">
                <span class="help-block"><?php echo $datan_err; ?></span>
            </div>
          <div class="form-group <?php echo (!empty($medie_err)) ? 'has-error' : ''; ?>">
                <label>Medie</label>
                <input type="text" name="medie" class="form-control" value="<?php echo $medie; ?>">
                <span class="help-block"><?php echo $medie_err; ?></span>
            </div>
          <div class="form-group <?php echo (!empty($formainv_err)) ? 'has-error' : ''; ?>">
                <label>Forma de invatamant</label>
                <input type="text" name="formainv" class="form-control" value="<?php echo $formainv; ?>">
                <span class="help-block"><?php echo $formainv_err; ?></span>
            </div>
          <div class="form-group <?php echo (!empty($bursa_err)) ? 'has-error' : ''; ?>">
                <label>Bursa</label>
                <input type="text" name="bursa" class="form-control" value="<?php echo $bursa; ?>">
                <span class="help-block"><?php echo $bursa_err; ?></span>
            </div>
        
            <div class="form-group">
                <input type="submit" name = "Add" class="btn btn-primary" value="Add">
            	<input type="submit" name = "Modify" class="btn btn-primary" value="Modify">
                <input type="submit" name = "Delete" class="btn btn-primary" value="Delete">
          		<input type="reset"  name = "Reset" class="btn btn-primary" value="Reset">
            </div>

        </form>
<div class="column-left" id="chartContainer" style="height: 450px; width: 750px; margin-left: 200px; margin-top: 150px;"></div>
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
                    pdfMake.createPdf(docDefinition).download("Inmatriculare.pdf");
                }
            });
        }
    </script>

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Diagrama cu mediile studentilor"
	},
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
