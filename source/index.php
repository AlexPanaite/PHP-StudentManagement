<?php
// Initialize the session
session_start();
 

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;}


if($_SESSION["role"]=="Student"){
?>
<style type="text/css">
#mat{
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

if($_SESSION["role"]=="Profesor" || $_SESSION["role"]=="Secretar"){
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



?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
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

.bg-image {
  /* The image used */
  background-image: url("bg.png");
  
  /* Add the blur effect */
  filter: blur(3px);
  -webkit-filter: blur(3px);
  
  /* Full height */
  height: 100%; 
  
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

/* Position text in the middle of the page/image */
.bg-text {
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
  color: white;
  font-weight: bold;
  border: 3px solid #f1f1f1;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  width: 80%;
  padding: 20px;
  text-align: center;
}
</style>
</head>
<body>

<div class="topnav">
  <a class="active" href="index.php">Home</a>
  <a href="studenti.php">Studenti</a>
  <a href="catalog.php">Catalog</a>
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
  		<a href="reset.php"  >Reset Your Password</a>
  		<a href="logout.php" >Log Out</a>
	</div>
</div>

<div class="bg-image"></div>

<div class="bg-text">
  <h2><?php echo "Welcome " . $_SESSION["username"]. " !"; ?></h2>
  <p><?php echo "Drepturi utilizator : " . $_SESSION["role"]; ?></p>
</div>

</body>
