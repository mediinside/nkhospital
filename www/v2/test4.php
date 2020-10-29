<script type="text/javascript">
var state = { 'page_id': 1, 'user_id': 5 }; 
var title = 'Hello World'; 
var url = 'test5.php'; 
console.log(state);
history.pushState(state, title, url);

window.onpopstate = function(event) { 
	console.log("location: " + document.location + ", state: " + JSON.stringify(event.state)); 
}
</script>