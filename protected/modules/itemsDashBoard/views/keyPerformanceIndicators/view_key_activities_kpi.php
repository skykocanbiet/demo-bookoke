<style>
.valueEdit{
    width: 100%;
    line-height: 40px;
    height: 40px;
}
</style>
<?php 
if($keyactivities){
    $totalkey = count($keyactivities);
    foreach($keyactivities as $key => $value){

        ?>
            <div class="row_info_key_acctivities" style="<?php if($totalkey == $key+1){ echo 'margin-bottom: 25px;'; } ?>">
                <div class="title_key_acctivities" style="padding: 0px 65px 0px 70px;display: inline-block;width: 84%;">
                    <div class="valueEdit" style="<?php  if(strlen($value->title) > 145 ){ echo 'line-height: 20px;'; }?>"><?php if(strlen($value->title) > 250){ echo substr($value->title,0,250).'...'; }else{ echo $value->title; }  ?></div>
                    <textarea id="title_value<?php echo $key +1; ?>" class="valueNew hiden" style="width: 705px;height: 50px;"><?php echo $value->title; ?></textarea>
                </div>
                <span style="position: absolute;top: -4px; right: 10px;font-size: 27px;color: #8DC641;">
                    <i class="fa fa-sort-desc"></i>
                </span>
                <div class="round-key-acctivities">
                    <div class="round-center-key-acctivities" style="background: <?php echo $value->color; ?>;">
                        <div class="valueEdit" style="line-height: 45px;height: 45px;"><?php echo $value->number; ?>%</div>
                        <input id="number_value<?php echo $key +1; ?>" class="valueNew hiden" type="text" value="<?php echo $value->number; ?>" style="color: #333;width: 15px;" />
                    </div>
                    <div class="color-key-acctivities">
                        <input type="color" id="myColor" value="<?php echo $value->color; ?>" style="width: 15px;padding: 0;margin: 0;border: none;box-shadow: none;background: none;"/>
                    </div>
                </div>
                
            </div>
        <?php
    }
}
?>

<div class="clear"></div>
<script>
$(document).ready(function() {
    
    $(".row_info_key_acctivities .title_key_acctivities" ).dblclick(function(e) {
        $('.valueNew').removeClass("show").addClass("hiden");
        $('.valueEdit').removeClass("hiden");
        
        $(this).find('.valueEdit').addClass("hiden");
        $(this).find('.valueNew').removeClass("hiden").addClass("show");
    });
    
    $(".row_info_key_acctivities .round-key-acctivities" ).dblclick(function(e){

        $('.valueNew').removeClass("show").addClass("hiden");
        $('.valueEdit').removeClass("hiden");
        
        $(this).find('.valueEdit').addClass("hiden");
        $(this).find('.valueNew').removeClass("hiden").addClass("show");
        
        $(this).find('.color-key-acctivities').css('display','block');
    });
    
    $('.valueNew').click(function(e){
        e.stopPropagation();
        //console.log('no');
        return false;
    });
    
    $( ".row_info_key_acctivities" ).click(function(e) {
        e.stopPropagation();
        //console.log('show');
    });
    
    $("#mainbody").click(function(){
        if($('textarea').hasClass('show') || $('input').hasClass('show') ){
             $('.valueNew').removeClass("show").addClass("hiden");
             $('.valueEdit').removeClass("hiden");
             save_key_activities();
        }
    });
    
});
</script>