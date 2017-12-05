<script type="text/javascript">
    var baseUrl = $('#baseUrl').val();
    function searchpromotion(id=''){
    
    var value = $('#searchnamepromotion').val(); 
    var type  = "1";
    //$('.cal-loading').fadeOut('slow');
    //$('.cal-loading').fadeIn('fast');
      $('.cal-loading').fadeIn('fast');
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsSales/Dealselitedental/SearchPromotion',   
        data: {"value":value,"type":type},  

        success:function(data){

            $('#abcabc').html(data);
            $('.cal-loading').fadeOut('slow');  
            
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });
    //$('.cal-loading').fadeOut('slow'); 
}
function runScript_search(e){
    
    if (e.keyCode == 13) {
        e.preventDefault();
       searchpromotion();
    }
}
</script>