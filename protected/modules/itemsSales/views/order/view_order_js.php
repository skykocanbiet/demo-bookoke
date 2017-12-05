<script>
$(function(){
	var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
	$('.autoNum').autoNumeric('init',numberOptions);

    $('a.pay_detail').click(function(e){
        e.preventDefault();
        $('#pay_history div').removeClass('hidden');
        $('a.pay_detail').addClass('hidden');
    })

	$('.cal_pay').click(function(e){
		e.preventDefault();	

		id_order = $('input[name="id_order"]').val();

		$.ajax({ 
         	type:"POST",
            url:"<?php echo CController::createUrl('order/orderPay'); ?>",
            datatype:'json',
            data: {
            	id_order: id_order,
            },
            success:function(data){
            	if(data) {
            		$('#quote_modal').html(data);
            		$('#quote_modal').modal('show');
            	}
            },
            error: function(data) {
                alert("Error occured.Please try again!");
            },
        });
	})
})
</script>