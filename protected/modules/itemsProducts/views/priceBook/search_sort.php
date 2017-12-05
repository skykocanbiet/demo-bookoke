<?php 
$baseUrl = Yii::app()->baseUrl;
?> 
                                       
<?php  
if(!empty($list_data['data']))
{       
foreach($list_data['data'] as $k=> $value)
{
?>
<li id="c<?php echo $value['id'];?>" onclick="detailPriceBook(<?php echo $value['id'];?>);" class="n">
                                    
    <span class="jqTransformCheckboxWrapper" style="display:none;">
        <a href="#" class="jqTransformCheckbox"></a>
        <input type="checkbox" value="<?php echo $value['id'];?>" class="fl" style="display : none;">
    </span>
    
   
    <label class="fl"> <?php echo $model->titleCase($value['name']);?> </label>
   	<img class="hide" onclick="showEditPriceBookModal(<?php echo $value['id'];?>);" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/edit_cam.png" style="float:right;margin: 9px 6px 0px 0px;width: 20px;height: 20px;">
    <div class="clearfix"></div>

</li>   
<?php
include("popup_edit_price_book.php");
}
}
else
{   
?>
<li>Không Tìm Thấy Bảng Giá!!!</li>
<?php
} 
?>

