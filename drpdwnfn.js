<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
function changedist(value) {
		$.post('script.php', { dist: value }, function(result) { 
		//alert(result);
		document.getElementById("district").innerHTML = result;
		});
		}
	</script>