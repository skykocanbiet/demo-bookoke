<script>

    function getCrmNotification(timestamp)
    {
        var queryString = {'timestamp' : timestamp};
        $.ajax(
            {
                type: 'GET',
                url: '//webservice.bookoke.com/ee7f23210bb7b98aa91853c2b5d88d96',
                data: queryString,
                success: function(dataString){

                    //console.log(dataString);
                    // put result data into "obj"
                    if(dataString == 0){
                        return false;
                    }

                    var obj = jQuery.parseJSON(dataString);
                    
                    //var createdate = obj.createdate;
                
                    //timeStamp = new Date(obj.timestamp*1000);
                    //console.log(obj.createdate);
                   // document.write(timeStamp.toString());

                    if(obj.status == 1){

                        var objnewdata = jQuery.parseJSON(obj.data);
                        
                        var StartDateSchdule = new Date(objnewdata.start_time);
                        var sd_date = StartDateSchdule.getDate();
                        var sd_month = StartDateSchdule.getMonth() + 1; //Months are zero based
                        var sd_year = StartDateSchdule.getFullYear();
                        var sd_hours = StartDateSchdule.getHours();
                        var sd_minutes = StartDateSchdule.getMinutes();
                        
                        
                        var EndDateSchdule = new Date(objnewdata.end_time);
                        var ed_hours = EndDateSchdule.getHours();
                        var ed_minutes = EndDateSchdule.getMinutes();
                        
                        var agoStartEnd = relative_time(objnewdata.create_date);
                        //console.log(agoStartEnd);
                        //console.log(relative_time(objnewdata.create_date));
                        var str_sch_status = "";
                        
                        if(objnewdata.status == -2){
                            str_sch_status = '<span class = "label label_bookoke label_sch_khongden">Không đến</span>';
                        }

                        if(objnewdata.status == -1){
                            str_sch_status = '<span class = "label label_bookoke label_sch_huy">Hủy hẹn</span>';
                        }

                        if(objnewdata.status == 0){
                            str_sch_status = '<span class = "label label_bookoke label_notworking">Không làm việc</span>';
                            objnewdata.fullname = 'Không làm việc';
                        }

                        if(objnewdata.status == 1){
                            str_sch_status = '<span class = "label label_bookoke label_sch_moi">Lịch mới</span>';
                        }

                        if(objnewdata.status == 2){
                            str_sch_status = '<span class = "label label_bookoke label_sch_daden">Đã đến</span>';
                        }

                        if(objnewdata.status == 3){
                            str_sch_status = '<span class = "label label_bookoke label_sch_vaokham">Vào khám</span>';
                        }

                        if(objnewdata.status == 4){
                            str_sch_status = '<span class = "label label_bookoke label_sch_hoantat">Hoàn tất</span>';
                        }

                        if(objnewdata.status == 5){
                            str_sch_status = '<span class = "label label_bookoke label_sch_hoantat">Bỏ về</span>';
                        }


                        
                        var htmlNoti = '<li>'+
                            '<div id="activity_notification_list_holder" onclick="showNotifications('+objnewdata.id+','+objnewdata.id+')">'+ 
                                '<div style=" float: left;width:100%; color: #333;">'+
                                    '<div style="margin-bottom: 2px;">'+
                                        '<span style="font-size: 14px;">'+objnewdata.fullname+'</span>'+
                                        '<span style="text-align: right;float: right;font-size: 11px;">'+
                                        '<em>'+agoStartEnd+'</em>'+
                                        '<input type="hidden" class="createdate_noti" value="'+obj.createdate+'" />'+
                                        '</span>'+
                                    '</div>'+
                                    '<p style="font-size: 12px;margin:0px;line-height: 19px;">'+
                                        '<span><strong>Bác Sĩ:</strong>'+objnewdata.name_dentist+'</span><br>'+
                                        '<span>'+sd_year+'/'+sd_month+'/'+sd_date+'</span>'+
                                        '<span> '+sd_hours+':'+sd_minutes+'-'+ed_hours+':'+ed_minutes+'</span>'+
                                        ''+str_sch_status+''+
                                    '</p>'+
                                '</div>'+
                                '<div class="clearfix"></div>'+
                            '</div>'+
                        '<li/>';
                        $( "#activity_notification_list" ).prepend(htmlNoti);
                        

                        var lay_out = $("#LayoutCalendar").val();
                        if(lay_out == 1){
                            getNewSch(obj.data);
                        }
                        
                        getsumNotifications();

                        
                    }
                    if(obj.status == 2) //kết thúc cuộc gọi
                    {
                        // alert("asdasdasd");
                        //  return false;
                         var objcall = jQuery.parseJSON(obj.data.data);
                         var id_user = <?php echo Yii::app()->user->getState('user_id') ?>;
                         var id = objcall.id;

                         var date_call = objcall.date_call;
                         var duration_call= objcall.duration_call;
                         var extention = objcall.extention;
                         var phone =objcall.phone;
                         var file_record=objcall.file_record;
                         var status = objcall.status;
                         var clove_call=objcall.clove_call;
                         
                         saveHistoryCall(id_user,id,date_call,duration_call,extention,phone,file_record,status,clove_call);
                         return true;

                    }

                    if(obj.status == 3)//popup thống báo cuộc gọi đến
                    {
                        var objcallnew = jQuery.parseJSON(obj.data.data);
                        var phone = objcallnew.phone;
                        var extention = objcallnew.extention;
                        // var id_user = <?php echo Yii::app()->user->getState('user_id') ?>;
                        // var queue_login = <?php echo Yii::app()->user->getState('queue_login') ?>;
                        // if (extention == queue_login) {
                        //     popupCallNotification(phone);
                        // }
                        
                       
                        
                    }

                    // put the data_from_file into #response
                    //$('#response').html(obj.data_from_file);
                    // call the function again, this time with the timestamp we just got from server.php
                    getCrmNotification(obj.timestamp);
                },
            }
        );
    }

    function saveHistoryCall(id_user,id,date_call,duration_call,extention,phone,file_record,status,clove_call){
        $.ajax({
                type:'POST',
                url:'https://dev.bookoke.com/itemsCustomers/Accounts/addNewCallHistory',
                data:{
                    'id_user'           :id_user,
                    'id'                :id,
                    'date_call'         :date_call,
                    'duration_call'     :duration_call,
                    'extention'         :extention,
                    'phone'             :phone,
                    'file_record'       :file_record,
                    'status'            :status,
                    'clove_call'        :clove_call,
                },
                success: function(dataString){
                    if (dataString) {
                        // console.log(dataString);
                        //  $.jAlert({
                        // 'title': "Thông báo !",
                        // 'content': "Lịch sử cuộc gọi đã được lưu lại"
                        // });
                    }
                },
             });
    }

    function popupCallNotification(phone)
    {
        $.ajax({
            type:'POST',
            url:'https://dev.bookoke.com/itemsCustomers/Accounts/searchCustomersCall',
            data:{
                'phone' : phone,
            },
            success: function(dataString){
                if (dataString) {
                    getcallcoming(dataString,phone);
                }
            },
         });
    }

    function getcallcoming(id_cus,phone_cus)
    {
        if (id_cus==0) {
            var html ='<div data-toggle="popover" id="call-animation" class="call-animation" style="position: fixed;bottom: 30px;right: 50px;z-index: 999"><a href="<?php echo Yii::app()->request->baseUrl; ?>/itemsCustomers/Potential/admin"><img  class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/medical_record/more_icon/phone.jpg" alt=""/></a></div>';
        }
        else {
            var html ='<div data-toggle="popover" onclick="detailCustomer('+id_cus+');" id="call-animation" class="call-animation" style="position: fixed;bottom: 30px;right: 50px;z-index: 999"><img  class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/medical_record/more_icon/phone.jpg" alt=""/></div>';
        }
        
        $('#ring-call').fadeIn(5000).append(html);
        var audio = document.createElement('audio');
          audio.style.display = "none";
          audio.src = "<?php echo Yii::app()->request->baseUrl; ?>/images/84586-telephone-bell.mp3";
          audio.autoplay = true;
          audio.loop = true;
        document.body.appendChild(audio);
        $('[data-toggle="popover"]').popover({
            title :'Cuộc gọi mới',
            content :"số điện thoại: "+phone_cus,
            trigger: 'hover',
            placement:'left'
         }); 
    }

    function updateUserNotifications(id_notification){
        $.ajax({
            type    : "post",
            dataType: 'json',
            url     : '/itemsUsers/Users/UpdateNotification',
            data    : {
                    id_notification: id_notification,
            },
            success: function(data){
                if(data){
                    var sumNoti = $("#sumNotification").val();
                    //console.log("Before:"+sumNoti);
                    sumNoti = parseInt(sumNoti);
                    sumNoti = sumNoti-1;
                    //console.log("After:"+sumNoti);

                    $("#sumNotification").val(sumNoti);
                    $("#sumBoxNotification").html(sumNoti);
                    $("#notification_sch"+id_notification).addClass('watched');

                    $(".watched"+id_notification).css("display","none");

                }
                
            },
        });
    }

    function showNotifications(id_notification,id_sch){
        showNotificationsSchudle(id_sch);
        updateUserNotifications(id_notification);
    }

    function showNotificationsSchudle(id_sch){
            $.ajax({ 
                type    :"POST",
                url     :"<?php echo Yii::app()->createUrl('itemsSchedule/calendar/updateEventAllLayout')?>",
                dataType:'html',
                data    : {id_schedule:id_sch},
                success :function(data){
                  $('.updateEventAllLayout').html(data);
                  $('#update_sch_modal_all').modal('show');
                  
                },
                error: function(data) {
                    alert("Error occured.Please try again!");
                },
            });
    }

    function getsumNotifications(){
        var sumNoti = $("#sumNotification").val();

        //console.log("Before:"+sumNoti);
        sumNoti = parseInt(sumNoti);
        sumNoti = parseInt(sumNoti+1);
        //console.log("After:"+sumNoti);

        $("#sumNotification").val(sumNoti);
        $("#sumBoxNotification").html(sumNoti);
      
    }
    function timeDifference(current, previous) {

            var msPerMinute = 60 * 1000;
            var msPerHour = msPerMinute * 60;
            var msPerDay = msPerHour * 24;
            var msPerMonth = msPerDay * 30;
            var msPerYear = msPerDay * 365;

            var elapsed = current - previous;

            //console.log(elapsed);
            if (elapsed < msPerMinute) {
                 return Math.round(elapsed/1000) + ' giây trước';   
            }

            else if (elapsed < msPerHour) {
                 return Math.round(elapsed/msPerMinute) + ' phút trước';   
            }

            else if (elapsed < msPerDay ) {
                 return Math.round(elapsed/msPerHour ) + ' giờ trước';   
            }

            else if (elapsed < msPerMonth) {
                return 'approximately ' + Math.round(elapsed/msPerDay) + ' ngày trước';   
            }

            else if (elapsed < msPerYear) {
                return 'approximately ' + Math.round(elapsed/msPerMonth) + ' tháng trước';   
            }

            else {
                return 'approximately ' + Math.round(elapsed/msPerYear ) + ' năm trước';   
            }

    }

    function relative_time(date_str) {
        
        return  moment(date_str).fromNow(); 
   /*   var dateFrom = moment(date_str);      
      var dateTo = moment();
      console.log(dateFrom.diff(dateTo,'days'));*/
    }
 
   $(document).ready(function (){
        //getLoadNotifications();
        //getsumNotifications();
        getCrmNotification();
        
        //updateTime();
        // getcallcoming("15","01693339812");

   });

    function updateTime(){
  
        $( "#activity_notification_list li" ).each(function( index ) {

            var cur = $(this).find('.createdate_noti').val();

            var agoStartEnd = relative_time(cur);

            $(this).find('em').html(agoStartEnd);
    
        });
    }


    setInterval(updateTime, 6000);

/*$(window).load(function() {
    getCrmNotification();
});
*/

//xem tất cả thông báo
function allWatchNoti(type){
     $.ajax({ 
                type    :"POST",
                url     :"<?php echo Yii::app()->createUrl('itemsUsers/notifications/allWatchNoti')?>",
                dataType:'html',
                data    :{type : type},
                success :function(data){
                    if(data ==1 || data == -1){
                        sumNotifications();
                    }
                },
                error: function(data) {
                    alert("Error occured.Please try again!");
                },
            });

}

function sumNotifications(){
    $.ajax({ 
        type    :"POST",
        url     :"<?php echo Yii::app()->createUrl('itemsUsers/notifications/sumNoti')?>",
        dataType:'html',
        success :function(data){
            if(data){
                $("#sumNotification").val(data);
                $("#sumBoxNotification").html(data);
            }
        },
        error: function(data) {
            alert("Error occured.Please try again!");
        },
    });

}
</script>

