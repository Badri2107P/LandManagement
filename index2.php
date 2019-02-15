<?php 
session_start();
 require('connect.php');
?>
<html>
<body>
<select name="meal" id="meal" onChange="changecat(this.value);">
<option value="" disabled selected>Select</option>
    <?php 
$query = "SELECT name FROM public.geo_locations where location_type='STATE' ORDER BY name ASC";
echo $query;
$sql = pg_query($connection, $query);
while ($row = pg_fetch_assoc($sql)){
echo "<option value=".$row['name'].">". $row['name'] . "</option>";
}
echo $query;
?>
</select>
<select name="category" id="category">
    <option value="" disabled selected>Select</option>
</select>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
function changecat(value) {
		$.post('script.php', { dist: value }, function(result) { 
		alert(result);
		//document.getElementById("category").innerHTML = result;
		});
		}
	</script>
	</body>
	</html>