<script type="text/javascript">
	window.onpopstate = function(event) { 
		console.log("location: " + document.location + ", state: " + JSON.stringify(event.state)); 
	}
</script>