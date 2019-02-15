<?php 
 $num = $_POST["dist"];
//echo $num;
 require('connect.php');
 //$qu="SELECT id FROM public.geo_locations where name='".$num."'";
 // echo $qu;
// $pg = pg_query($connection, $qu);
$query = "SELECT * FROM public.district_trichy";
//echo $query;
$sql = pg_query($connection, $query);
while ($row = pg_fetch_assoc($sql)){
echo "<option value=".$row['district_trichy'].">". $row['district_trichy'] . "</option>";
}
//echo $sql;
?>