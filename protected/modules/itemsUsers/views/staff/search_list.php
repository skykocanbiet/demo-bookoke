 <?php $baseUrl = Yii::app()->baseUrl;?>
 <style>
    #customerList li:hover .hide
    {   
        display: block !important;
    }
 </style>
 <ul id="customerList">
                                       
        <?php  
        if(!empty($list_data['data']))
        {               
        foreach($list_data['data'] as $k=> $value)
        {
        ?>
        <li id="c<?php echo $value['id'];?>" onclick="detailCustomer(<?php echo $value['id'];?>);"  class="n" >
                                        
            <span class="jqTransformCheckboxWrapper" style="display:none;">
                <a href="#" class="jqTransformCheckbox"></a>
                <input type="checkbox" value="<?php echo $value['id'];?>" class="fl" style="display : none;">
            </span>
            
            <img class="user_img<?php echo $value['id'];?>" src="<?php echo $baseUrl; ?><?php if($value['image']!="") echo '/upload/users/sm/'.$value['image']; else echo "/upload/users/no_avatar.png";?>" class="fl" style="border-radius:100%;float:left;">
            <label class="fl"><?php echo $value['name'];?> </label>
            <img id="ltn<?php echo $value['id'];?>" class="hide" onclick="showUpdateStaff(<?php echo $value['id'];?>);" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/edit_cam.png" style="float:right;margin: 9px 6px 0 0;width: 20px;height: 20px;">
            <div class="clearfix"></div>
        </li>
        <div id="updateSegmentPopup<?php echo $value['id'];?>" class="popover bottom segment" style="display: none;padding:0px;top:150px;left:500px;">
            <form id="frm-update-staff-<?php echo $value['id'];?>" onsubmit="return false;" class="form-horizontal">                                                                                                 
                <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Chỉnh sửa nhân viên</h3>
                <div class="popover-content" style="width:225px;">
                    <input type="text" required="" oninvalid="this.setCustomValidity('Vui lòng nhập tên nhân viên.')" oninput="setCustomValidity('')" class="form-control" id="segmentNewName<?php echo $value['id'];?>" name="segmentNewName" value="<?php echo $value['name'];?>" placeholder="Tên nhân viên" style="margin-top:0px;padding: 6px 12px;margin-bottom:10px;width:98%;">
                    <button onclick="deleteStaff(<?php echo $value['id'];?>);" id="btn-delete-<?php echo $value['id'];?>" class="btn btn_delete" style="min-width: 94px;margin-right: 0px;">Xóa</button>
                    <button onclick="updateSegment(<?php echo $value['id'];?>);" class="btn btn_bookoke">Cập nhật</button>
                </div>
            </form>
        </div> 
        <?php
        }
        }
        else
        {   
        ?>
        <li>Không Tìm Thấy Nhân Viên!!!</li>
        <?php
        } 
        ?>
</ul>
<script type="text/javascript">
    $(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#navbar-collapse").height();
    var title = $('.customerListContainer .customersActionHolder').height();
    var search = $('.customerSearchHolder').height();

    $('#customerList').height(windowHeight-header-title-search-69);
    
    
});
$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#navbar-collapse").height();
    var title = $('.customersActionHolder').height();
    var search = $('.customerSearchHolder').height();


    $('#customerList').height(windowHeight-header-title-search-69);
    

});
function showUpdateStaff(id){    
    var evt = window.event || arguments.callee.caller.arguments[0];
    evt.preventDefault();
    var position = $('#ltn'+id).position();    
    $('#updateSegmentPopup'+id).css({"top": position.top-50, "left": position.left+50});
    $('#updateSegmentPopup'+id).fadeToggle('fast');
    evt.stopPropagation();
}
function deleteStaff(id)
{
    $.alertOnClick('#btn-delete-'+id, {
                'title':'Xóa thời gian !',
                'content':'Bạn chắc chắn muốn xóa nhân viên này không ?',
                'btns': [
                    {'text':'Hủy', 'closeAlert':true},
                    {'text':'Đồng ý', 'closeAlert':true, 'onClick': function(){
                        $('.cal-loading').fadeIn('fast');
                        $.ajax({
                                type:'POST',
                                url: baseUrl+'DeleteStaff',    
                                data: {"id":id},   
                                success:function(data){
                                    if(data == '1')
                                    {
                                        $('.cal-loading').fadeOut('slow'); 
                                        window.location.assign("<?php echo CController::createUrl('Staff/View')?>"); 
                                    }                 
                                },
                                error: function(data){
                                console.log("error");
                                console.log(data);
                                }
                            });
                    }}
                ]
        });
}
$(document).mouseup(function (e)
{
    var container = $(".popover.bottom.segment");
    if (!container.is(e.target) 
        && container.has(e.target).length === 0) 
    {        
        container.hide();
    } 
});
</script>


