<?php 
$baseUrl = Yii::app()->baseUrl;
?> 
                                       
<?php  
if(!empty($list_data['data']))
{       
foreach($list_data['data'] as $k=> $value)
{
?>
<li id="c<?php echo $value['id'];?>" onclick="detailSegment(<?php echo $value['id'];?>);" class="n">
                                    
    <span class="jqTransformCheckboxWrapper" style="display:none;">
        <a href="#" class="jqTransformCheckbox"></a>
        <input type="checkbox" value="<?php echo $value['id'];?>" class="fl" style="display : none;">
    </span>    
   
    <label class="fl"> <?php echo $model->titleCase($value['name']);?> </label>
   	<img id="ltn<?php echo $value['id'];?>" class="hide" onclick="showUpdateSegment(<?php echo $value['id'];?>);" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/edit_cam.png" style="float:right;margin: 9px 6px 0 0;width: 20px;height: 20px;">
    <div class="clearfix"></div>

</li>  

<div id="updateSegmentPopup<?php echo $value['id'];?>" class="popover bottom segment" style="display: none;padding:0px;top:150px;left:500px;">
    <form id="frm-update-segment-<?php echo $value['id'];?>" onsubmit="return false;" class="form-horizontal">                                                                                                 
        <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Chỉnh sửa nhóm</h3>
        <div class="popover-content" style="width:225px;">
            <input type="text" required="" oninvalid="this.setCustomValidity('Vui lòng nhập tên nhóm.')" oninput="setCustomValidity('')" class="form-control" id="segmentNewName<?php echo $value['id'];?>" name="segmentNewName" value="<?php echo $value['name'];?>" placeholder="Tên nhóm" style="margin-top:0px;padding: 6px 12px;margin-bottom:10px;width:98%;">
            <button onclick="deleteSegment(<?php echo $value['id'];?>);" class="btn btn_delete" style="min-width: 94px;margin-right: 0px;">Xóa</button>
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
<li>Không Tìm Thấy Phân Khúc!!!</li>
<?php
} 
?>

<script type="text/javascript">	

$(function() {
$("#customerList li")
    .mouseover(function() { 
        $(this).find("img").removeClass("hide");         
    })
    .mouseout(function() {                  
        $(this).find("img").addClass("hide");    
    })    
});

function showUpdateSegment(id){    
    var evt = window.event || arguments.callee.caller.arguments[0];
    evt.preventDefault();
    var position = $('#ltn'+id).position();    
    $('#updateSegmentPopup'+id).css({"top": position.top-50, "left": position.left+50});
    $('#updateSegmentPopup'+id).fadeToggle('fast');
    evt.stopPropagation();
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

function updateSegment(id){ 
    if($('#segmentNewName'+id).val()!=""){
        var formData = new FormData($('#frm-update-segment-'+id)[0]);  
        formData.append('id_segment',id);     
        if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({
                type:'POST',
                url: baseUrl+'/itemsCustomers/Segment/updateSegmentNewName',
                data:formData,
                datatype:'json',
                success:function(data){             
                    if(data == '1'){ 
	                    $('#updateSegmentPopup'+id).hide();  
	                    searchSegment(id); 
                    }
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    }
}

function deleteSegment(id){
    if (confirm("Bạn có thật sự muốn xóa?")) {  
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsCustomers/Segment/deleteSegment',    
            data: {"id":id},   
            success:function(data){
                if(data == '1'){                                   
                    $('#updateSegmentPopup'+id).hide();  
	                searchSegment(); 
                }                 
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
    }      
}

</script>