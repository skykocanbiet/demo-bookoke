<script type="text/javascript">

$( "#showFamilyPopover" ).click(function() {
	$("#familyPopover").fadeToggle('fast');
});
$( "#hideFamilyPopover" ).click(function() {
	$("#familyPopover").hide(); 
});

$( "#showSocietyPopover" ).click(function() {
	$("#societyPopover").fadeToggle('fast');
});
$( "#hideSocietyPopover" ).click(function() {
	("#societyPopover").hide(); 
});

	function customer() {
	    $('#customer_relation').select2({
	        placeholder: 'Chọn người',
	        width: '100%',
	        allowClear: true,
	        ajax: {
	            dataType : "json",
	            url      : '<?php echo CController::createUrl('Accounts/getCustomerList'); ?>',
	            type     : "post",
	            delay    : 50,
	            data : function (params) {
	                return {
	                    q: params.term, // search term
	                    page: params.page || 1
	                };
	            }, 
	            processResults: function (data, params) {
	                params.page = params.page || 1;
	                
	                return {
	                    results: data,
	                    pagination: {
	                        more:true
	                    }
	                }; 
	            },
	            cache: true,
	        },
	    });
	}
	function customer2() {
	    $('#customer_relation_social').select2({
	        placeholder: 'Chọn người',
	        width: '100%',
	        allowClear: true,
	        ajax: {
	            dataType : "json",
	            url      : '<?php echo CController::createUrl('Accounts/getCustomerList'); ?>',
	            type     : "post",
	            delay    : 50,
	            data : function (params) {
	                return {
	                    q: params.term, // search term
	                    page: params.page || 1
	                };
	            }, 
	            processResults: function (data, params) {
	                params.page = params.page || 1;
	                
	                return {
	                    results: data,
	                    pagination: {
	                        more:true
	                    }
	                }; 
	            },
	            cache: true,
	        },
	    });
	}
	$( document ).ready(function() {
	    
	       $.fn.select2.defaults.set( "theme", "bootstrap" );
	       customer();
	       customer2();
	});

$('#frm-add-relation-family').submit(function(e) {
    e.preventDefault();    
    var formData = new FormData($("#frm-add-relation-family")[0]);    
    if (!formData.checkValidity || formData.checkValidity()) {
    	//$('.cal-loading').fadeIn('fast');
        jQuery.ajax({           
            type:"POST",
            url: baseUrl+'/itemsCustomers/Accounts/addRelationFamily',    
            data:formData,
            datatype:'json',
            success:function(data){  
            console.log(data);                          
                if(data == -1){                  
                }if(data == -2){                
                }else if(data >= 1){ 
                    $('#frm-add-relation-family')[0].reset();    
                    $('#familyPopover').hide(); 
                    //$('.cal-loading').fadeOut('fast');
                     window.location.href = '<?php echo CController::createUrl("Accounts/admin");?>';  
                    
                }
            },
            error: function(data) {
                alert("Error occured. Please try again!");
            },
            cache: false, 
            contentType: false,
            processData: false
        });
    }
    return false;
});

$('#frm-add-relation-social').submit(function(e) {
    e.preventDefault();    
    var formData = new FormData($("#frm-add-relation-social")[0]);    
    if (!formData.checkValidity || formData.checkValidity()) {
    	//$('.cal-loading').fadeIn('fast');
        jQuery.ajax({           
            type:"POST",
            url: baseUrl+'/itemsCustomers/Accounts/addRelationSocial',    
            data:formData,
            datatype:'json',
            success:function(data){  
            console.log(data);                          
                if(data == -1){                  
                }if(data == -2){                
                }else if(data >= 1){ 
                    $('#frm-add-relation-social')[0].reset();    
                    $('#societyPopover').hide(); 
                    //$('.cal-loading').fadeOut('fast');
                     window.location.href = '<?php echo CController::createUrl("Accounts/admin");?>';  
                    
                }
            },
            error: function(data) {
                alert("Error occured. Please try again!");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
    return false;
});

</script>