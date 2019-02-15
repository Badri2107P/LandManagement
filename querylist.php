<center>
<a href ="#" onclick="load_selectarea()"> Select Location! </a> </div>
<div id ="content"> </div>
<script>
      function load_selectarea(){
             document.getElementById("content").innerHTML='<iframe src="selectarea.php" name="targetframe" allowTransparency="true" scrolling="no" frameborder="0" style="height:600px;" ></iframe>';
  }
</script>
<a href ="#" onclick="load_selectarea()"> Find by ID! </a> </div>
<div id ="content"> </div>
<script>
      function load_selectarea(){
             document.getElementById("content").innerHTML='<iframe src="findbyid.php" name="targetframe" allowTransparency="true" scrolling="no" frameborder="0" style="height:600px;" ></iframe>';
  }
</script>
</center>