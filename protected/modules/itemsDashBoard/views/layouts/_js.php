  <script type="text/javascript">
        
        $( document ).ready(function() {
            var windowHeight =  $( window ).height();
            var header       = $("#headerMenu").height();

            $('#profileSideNav').height(windowHeight-header);
        });

		$(window).resize(function() {
 			var windowHeight =  $( window ).height();
            var header       = $("#headerMenu").height();

            $('#profileSideNav').height(windowHeight-header);

		});


</script>