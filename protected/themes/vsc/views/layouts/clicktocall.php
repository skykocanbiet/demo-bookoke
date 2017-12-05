<script>
	function getCall() {
		var queryString = {'key' : "68247c4e4f9ab42da570c34b19206d93",'to_number':"01693339812",'from_number' :'200'};
		$.ajax({
				type : 'POST',
				url : 'http://webservice.bookoke.com/soap/ClickToCall',
				data :queryString,
				dataType:'json',
				success : function(dataString){
					console.log(dataString);
				} ,
		});
	}
</script>