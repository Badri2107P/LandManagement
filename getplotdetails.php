<?php 
require('connect.php');
$num = $_POST["dist"];
$query = "SELECT * FROM public.plot where id='".$num."'";
//echo $query;
$sql = pg_query($connection, $query);
while ($row = pg_fetch_assoc($sql)){
echo '
<br/>Unique id: <input type="text" name="unique_id" id="unique_id" value='.$row['unique_id'].'><br/>
<br/>aad_no: <input type="text" name="aad_no" id="aad_no" value='.$row['aad_no'].'><br/>
<br/>state: <input type="text" name="state" id="state" value='.$row['state'].'><br/>
<br/>zone: <input type="text" name="zone" id="zone" value='.$row['zone'].'><br/>
<br/>district: <input type="text" name="district" id="district" value='.$row['district'].'><br/>
<br/>sub_rg_off: <input type="text" name="sub_rg_off" id="sub_rg_off" value='.$row['sub_rg_off'].'><br/>
<br/>village: <input type="text" name="village" id="village" value='.$row['village'].'><br/>
<br/>ward: <input type="text" name="ward" id="ward" value='.$row['ward'].'><br/>
<br/>sr_no: <input type="text" name="sr_no" id="sr_no" value='.$row['sr_no'].'><br/>
<br/>subdiv_no: <input type="text" name="subdiv_no" id="subdiv_no" value='.$row['subdiv_no'].'><br/>
<br/>plot_no: <input type="text" name="plot_no" id="plot_no" value='.$row['plot_no'].'><br/>
<br/>area: <input type="text" name="area" id="area" value='.$row['area'].'><br/>
<br/>bk_val: <input type="text" name="bk_val" id="bk_val" value='.$row['bk_val'].'><br/>
<br/>reg_date: <input type="text" name="reg_date" id="reg_date" value='.$row['reg_date'].'><br/>
<br/><input type="button" value ="Update details" onclick="updateplotdata(plotid.value,unique_id.value,aad_no.value,state.value,zone.value,district.value,sub_rg_off.value,village.value,ward.value,sr_no.value,subdiv_no.value,plot_no.value,area.value,bk_val.value,reg_date.value);">';
}
?>