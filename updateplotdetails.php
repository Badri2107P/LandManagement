<?php 
require('connect.php');
$plotid= $_POST["plotid"];
$unique_id = $_POST["unique_id"];
$aad_no= $_POST["aad_no"];
$state= $_POST["state"];
$reg_date= $_POST["reg_date"];
$bk_val= $_POST["bk_val"];
$district= $_POST["district"];
$zone= $_POST["zone"];
$sub_rg_off= $_POST["sub_rg_off"];
$village= $_POST["village"];
$ward= $_POST["ward"];
$sr_no= $_POST["sr_no"];
$subdiv_no= $_POST["subdiv_no"];
$plot_no= $_POST["plot_no"];
$area= $_POST["area"];
$bk_val= $_POST["bk_val"];

$query = "UPDATE public.plot
	SET unique_id='".$unique_id."',aad_no='".$aad_no."', state='".$state."', zone='".$zone."',
	district='".$district."', sub_rg_off='".$sub_rg_off."', village='".$village."', ward='".$ward."',
	sr_no='".$sr_no."', subdiv_no='".$subdiv_no."', plot_no='".$plot_no."', area='".$area."', bk_val='".$bk_val."', reg_date='".$reg_date."'
	WHERE id='".$plotid."'"; 
//echo $query;
if(pg_query($connection, $query)){

    echo "Records updated successfully.";

} else{
    echo "ERROR: Could not able to execute $sql. " . pg_sql_error($connection);
}
?>