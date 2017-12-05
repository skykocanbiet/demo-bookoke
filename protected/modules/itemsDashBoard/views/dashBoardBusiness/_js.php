  <script type="text/javascript">
        
function SearchDashBoard(){

}




$( document ).ready(function() {

	var windowHeight =  $( window ).height();
	var header       = $("#headerMenu").height();

	$('#body_dashboard .chart').height(windowHeight-header-150);

	$('.cal-loading').fadeOut('slow');

});

$(window).resize(function() {
	var windowHeight =  $( window ).height();
	var header       = $("#headerMenu").height();

	$('#body_dashboard .chart').height(windowHeight-header-150);

});


</script>