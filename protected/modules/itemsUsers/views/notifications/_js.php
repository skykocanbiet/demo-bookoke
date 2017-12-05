<script>
function loadNoti(page, sms_time, sms_phone, sms_ct) {
    $('.cal-loading').fadeIn('fast');
    $.ajax({ 
        type    :"POST",
        url     :"<?php echo Yii::app()->createUrl('itemsUsers/Notifications/viewDetail')?>",
        dataType: 'html',
        data: {
            page     : page,
            sms_time :sms_time,
            sms_phone: sms_phone, 
            sms_ct   : sms_ct, 
        },
        success:function(data){
            if(data){
                $("#noty_List").html(data);
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
    loadNoti(1);

    $('#sms_time').change(function(e){
        sms_time = $('#sms_time').val();
        sms_phone = $('#sms_phone').val();

        loadNoti(1, sms_time, sms_phone);
    })

    // search branch
    $('#sms_phone_btn').on(' click',function(e){
        sms_time = $('#sms_time').val();
        sms_phone = $('#sms_phone').val();

        loadNoti(1, sms_time, sms_phone);
    })

    $('#srch_btn').on(' click',function(e){
        sms_ct= $('#srch_ct').val();

        loadNoti(1, '', '',sms_ct);
    })

    //xem xóa noti
    $('#taskNoti').change(function(e){
        var type = $(this).val();

        if (type == 1) {
            $('#noty_List').find('input[name=checkNoti]').removeClass('hidden');
            $('#btnHidden').removeClass('hidden');

        }else if (type == 2){
            $('#noty_List').find('input[name=checkNoti]').addClass('hidden');
            $('#btnHidden').addClass('hidden');
            allWatchNoti(type);
        }else if (type == 3){
            $('#noty_List').find('input[name=checkNoti]').addClass('hidden');
            $('#btnHidden').addClass('hidden');
            allCancelNoti(type);
        }

    })
})

//xóa tất cả thông báo
function allCancelNoti(type){
    if(confirm("Bạn có thực sự muốn xóa tất cả thông báo?")) {
        $.ajax({ 
                type    :"POST",
                url     :"<?php echo Yii::app()->createUrl('itemsUsers/notifications/allWatchNoti')?>",
                dataType:'html',
                data    :{type : type},
                success :function(data){
                    if(data== -1){
                        alert('Tất cả thông báo đã được xóa trước đó!');
                        sumNotifications();
                    }
                    if(data== 1){
                        alert('Xóa thành công!');
                        sumNotifications();
                        loadNoti(1);
                    }
                    //return;
                },
                error: function(data) {
                    alert("Error occured.Please try again!");
                },
        });
    }
}

$('#watchNoti').click(function(e){
    var type = 4;
    var list_noti = [];
    $(':checkbox:checked').each(function(i){
      list_noti[i] = $(this).val();
    });
    if(list_noti == ''){
        alert('Vui lòng chọn thông báo cần xem!');
        return;
    }
    $.ajax({ 
            type    :"POST",
            url     :"<?php echo Yii::app()->createUrl('itemsUsers/notifications/allWatchNoti')?>",
            dataType:'html',
            data    :{type : type,list_noti:list_noti},
            success :function(data){
                if(data== -1){
                    alert('Tất cả thông báo đã được xem trước đó!');
                    sumNotifications();
                    loadNoti(1);
                }
                if(data== 1){
                    alert('Thành công!');
                    sumNotifications();
                    loadNoti(1);
                }
            },
            error: function(data) {
                alert("Error occured.Please try again!");
            },
    });
})

$('#cancelNoti').click(function(e){
    var type = 5;
    var list_noti = [];
    $(':checkbox:checked').each(function(i){
      list_noti[i] = $(this).val();
    });
    if(list_noti == ''){
        alert('Vui lòng chọn thông báo cần xóa!');
        return;
    }
    if(confirm("Bạn có thực sự muốn xóa "+ list_noti.length +" thông báo vừa chọn?")) {
        $.ajax({ 
                type    :"POST",
                url     :"<?php echo Yii::app()->createUrl('itemsUsers/notifications/allWatchNoti')?>",
                dataType:'html',
                data    :{type : type,list_noti:list_noti},
                success :function(data){
                    if(data== -1){
                        alert('Thông báo đã được xóa trước đó!');
                        sumNotifications();
                        loadNoti(1);
                    }
                    if(data== 1){
                        alert('Xóa thành công!');
                        sumNotifications();
                        loadNoti(1);
                    }
                },
                error: function(data) {
                    alert("Error occured.Please try again!");
                },
        });
    }
})
</script>