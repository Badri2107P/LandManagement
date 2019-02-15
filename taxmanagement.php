<?php 
session_start();
 require('connect.php');
if (isset($_SESSION['username'])){
$username = $_SESSION['username'];
}
else{
	header("Location: login.php");
   exit;
}
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8" />
    <title>OpenLayers 3 - LayerSwitcher &amp; Popup</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ol3/3.17.1/ol.css" />
    <link rel="stylesheet" href="https://rawgit.com/walkermatt/ol3-layerswitcher/master/src/ol3-layerswitcher.css" />
    <link rel="stylesheet" href="https://rawgit.com/walkermatt/ol3-layerswitcher/master/examples/layerswitcher.css" />
    <link rel="stylesheet" href="https://rawgit.com/walkermatt/ol3-popup/master/src/ol3-popup.css" />
<link rel="stylesheet" href="styles.css">
<script href="drpdwnfn.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.4/css/ol.css" />
    <link rel="stylesheet" href="../a/src/ol-popup.css" />
    <link rel="stylesheet" href="popup.css" />
	<script src="https://openlayers.org/en/v4.6.4/build/ol.js"></script>
</head>
<body>

<div class="header">
  <a href="#default" class="logo">CompanyLogo</a>
  <div class="header-right">
   <div class="uname dropdown">
Welcome <?php echo $username;?>
    <div class="dropdown-content"  >
      <a href="logout.php">Logout</a>
    </div>
  
</div>
</div>
</div>
<div class="topnav">
  <a href="home.php">Land Management</a>
    <div class="dropdown active">
    <button class="dropbtn">Tax management 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#" id="findplotbyid" onclick="arrearplotid();">Pending arrear plots</a>
	  <a href="#" id="findhousebyid" onclick="arrearhouseid();">Pending arrear houses</a>

            <a href="#" id="selectaadharidassets">Show Assets From Aadhar</a>
<!-- The Modal -->
<div id="selectaadharidassetsModal" class="modal">
  <!-- Modal content -->
<div class="modal-content">
<span class="close">&times;</span>
<center>
 <form>
Show Assets From Aadhar: <input type="text" name="selectaadharid" id="selectaadharid">
<input type="button" value ="find" onclick="selectaadharidasset(selectaadharid.value);">
</form> 
</center>
</div>
</div>
      <a href="#" id="updatedetails">Update Details</a>
<!-- The Modal -->
<div id="updatedetailsModal" class="modal">
  <!-- Modal content -->
<div class="modal-content">
<span class="close">&times;</span>
<form>
<center>
Enter id: <input type="text" name="plotid" id="plotid" >
<input type="button" value ="Get Data" onclick="getplotdata(plotid.value);">
<div id= details>
</div>
</center>
</form> 
</div>
</div>
<a href="#" id="findvalue">Value finding</a>
<!-- The Modal -->
<div id="findvalueModal" class="modal">
  <!-- Modal content -->
<div class="modal-content">
<span class="close">&times;</span>
<form>
<center>
Plots Below: <input type="text" name="plotvalue" id="plotvaluebelow" >
<input type="button" value ="Find" onclick="getplotvalue(1,plotvaluebelow.value,2);">
<br/>
<br/>
Plots Above: <input type="text" name="plotvalue" id="plotvalueabove" >
<input type="button" value ="Find" onclick="getplotvalue(2,plotvalueabove.value,2);">
<br/>
<br/>
Plots Between: <input type="text" name="plotvalue" id="plotvaluemin" >
<input type="text" name="plotvalue" id="plotvaluemax" >
<input type="button" value ="Find" onclick="getplotvalue(3,plotvaluemin.value,plotvaluemax.value);">

</center>
</form> 
</div>
</div>
    </div>
  </div> 
  
  <a href="#contact">Contact</a>
  <a href="#about">About</a>
</div>
<div class="row">
  <div class="column1" style="background-color:#fff;">
 <center>
    <h3>Select Zone</h3>
<select id="zone" onChange="changedist(this.value);">
<?php 
$query = 'SELECT * FROM public.zone';
//echo $query;
//"<h3>" .  $query . "</h3>";
$sql = pg_query($connection, $query);
while ($row = pg_fetch_assoc($sql)){
echo "<option value=".$row['zone'].">". $row['zone'] ."</option>";
}
?>
</select>

<br/>
<h3>Select District</h3>
	<select select id="district" onChange="changesubreg(this.value);">
<option value="" disabled selected>Select</option>
</select>
<script type="text/javascript">
function changedist(value) {
	CenterMap(78.7047,10.7905,9);
		$.post('getdistricts.php', { dist: value }, function(result) { 
		//alert(result);
		document.getElementById("district").innerHTML = result;
		});
		}
	</script>
	<br/>
<h3>Select Sub Register Office</h3>
	<select select id="subreg" onChange="changevillage(this.value);">
<option value="" disabled selected>Select</option>
</select>
<script type="text/javascript">
function changesubreg(value) {
	CenterMap(78.682419,10.830512,12);
		$.post('getsubreg.php', { dist: value }, function(result) { 
		//alert(result);
		document.getElementById("subreg").innerHTML = result;
		});
		}
	</script>
	<br/>
<h3>Select Village</h3>
	<select select id="village" onChange="CenterMap(78.65837,10.81130,16);">
<option value="" disabled selected>Select</option>
</select>
<script type="text/javascript">
function changevillage(value) {
	CenterMap(78.65837,10.81130,12);
		$.post('getvillage.php', { dist: value }, function(result) { 
		//alert(result);
		document.getElementById("village").innerHTML = result;
		});
		}
	</script>
	</div>
  <div class="column2" style="background-color:#fff;">
  <div id="map"></div>
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ol3/3.17.1/ol.js"></script>
    <script src="https://rawgit.com/walkermatt/ol3-layerswitcher/master/src/ol3-layerswitcher.js"></script>
    <script src="https://rawgit.com/walkermatt/ol3-popup/master/src/ol3-popup.js"></script>
    <script src="../a/dist/ol-popup.js"></script>
    <script src="taxmanagementmap.js"></script>
  </div>
  
</div>

// <script>

// var aadmodal = document.getElementById("selectaadharidassetsModal");
// var aadbtn = document.getElementById("selectaadharidassets");
// var aadspan = document.getElementsByClassName("close")[0];
// aadbtn.onclick = function() {
    // aadmodal.style.display = "block";
// }
// aadspan.onclick = function() {
    // aadmodal.style.display = "none";
// }

// // var uppmodal = document.getElementById("updatedetailsModal");
// // var uppbtn = document.getElementById("updatedetails");
// // var uppspan = document.getElementsByClassName("close")[0];
// // uppbtn.onclick = function() {
    // // uppmodal.style.display = "block";
// // }
// // uppspan.onclick = function() {
    // // uppmodal.style.display = "none";
// // }

// var valmodal = document.getElementById("findvalueModal");
// var valbtn = document.getElementById("findvalue");
// var valspan = document.getElementsByClassName("close")[0];
// valbtn.onclick = function() {
    // valmodal.style.display = "block";
// }
// valspan.onclick = function() {
    // valmodal.style.display = "none";
// }



// window.onclick = function(event) {
    // if (event.target == uppmodal) {
        // uppmodal.style.display = "none";
    // }
	// if (event.target == aadmodal) {
        // aadmodal.style.display = "none";
    // }
	 // if (event.target == uppmodal) {
        // uppmodal.style.display = "none";
    // }
	 // if (event.target == valmodal) {
        // valmodal.style.display = "none";
    // }
// }

 // </script>
</body>
</html>
