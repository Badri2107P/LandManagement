<?php 
session_start();
 require('connect.php');
if (isset($_SESSION['username'])){
$username = $_SESSION['username'];
}
else{
	//header("Location: login.php");
  // exit;
}
?>
<center>
    <h3>Select State</h3>
<select id="state" onChange="changedist(this.value);">
<option value="" disabled selected>Select</option>
<?php 
$query = "SELECT name FROM public.geo_locations where location_type='STATE' ORDER BY name ASC";
echo $query;
"<h3>" .  $query . "</h3>";
$sql = pg_query($connection, $query);
while ($row = pg_fetch_assoc($sql)){
echo "<option value=".$row['name'].">". $row['name'] . "</option>";
}
?>
</select>


<h6>Select District</h6>
	<select select id="district" onChange="changedist(this.value);">
<option value="" disabled selected>Select</option>
</select>
<script type="text/javascript">
function changedist(value) {
		$.post('getdistricts.php', { dist: value }, function(result) { 
		//alert(result);
		document.getElementById("district").innerHTML = result;
		});
		}
	</script>

<h6>Query3</h6>
	<select>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="opel">Opel</option>
  <option value="audi">Audi</option>
</select><h6>Query4</h6>
	<select>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="opel">Opel</option>
  <option value="audi">Audi</option>
</select>
<h6>Query5</h6>
	<select>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="opel">Opel</option>
  <option value="audi">Audi</option>
</select>
<h6>Query6</h6>
	<select>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="opel">Opel</option>
  <option value="audi">Audi</option>
</select>
<h6>Query7</h6>
	<select>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="opel">Opel</option>
  <option value="audi">Audi</option>
</select>
</center>