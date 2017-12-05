<script>
function loadSms(page, sms_time, sms_phone, sms_ct) {
    $('.cal-loading').fadeIn('fast');
    $.ajax({ 
        type    :"POST",
        url     :"<?php echo Yii::app()->createUrl('itemsUsers/Sms/viewDetail')?>",
        dataType: 'html',
        data: {
            page     : page,
            sms_time :sms_time,
            sms_phone: sms_phone, 
            sms_ct   : sms_ct, 
        },
        success:function(data){
            if(data){
                $("#smsList").html(data);
                $('.cal-loading').fadeOut('slow');
            }
        },
        error: function(data) {
            alert("Error occured.Please try again!");
        },
    });
}

$(function(){
    $('#noty_List').on('show.bs.collapse','.collapse', function () {
        $('.collapse.in').collapse('hide');
    });
	loadSms(1);

    $('#sms_time').change(function(e){
        sms_time = $('#sms_time').val();
        sms_phone = $('#sms_phone').val();

        loadSms(1, sms_time, sms_phone);
    })

    // search branch
    $('#sms_phone_btn').on(' click',function(e){
        sms_time = $('#sms_time').val();
        sms_phone = $('#sms_phone').val();

        loadSms(1, sms_time, sms_phone);
    })

    $('#srch_btn').on(' click',function(e){
        sms_ct= $('#srch_ct').val();

        loadSms(1, '', '',sms_ct);
    })
})
</script>