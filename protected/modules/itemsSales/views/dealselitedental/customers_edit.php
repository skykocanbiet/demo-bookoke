<div>
	<div class="col-sm-12" style="padding-left:22px;">
		<div onclick="change_status_customer()" id="slider_holder" class="slider_holder staffhours sliderdone">
            
        <input type="hidden" value="1">
        <span  id="off_edit" class="slider_off <?php  if ($v['type_segment'] != 1) {echo "Off";} ?> sliders"> TẮT </span>
        <span  id="on_edit" class="slider_on <?php  if ($v['type_segment'] != 1) {echo "On";} ?> sliders"> BẬT </span>
        <span  id="switch_edit" class="slider_switch <?php  if ($v['type_segment'] != 1) {echo "Switch";} ?>"></span>

        <!-- <input type="hidden" value="0">
        <span class="slider_off sliders"> OFF </span>
        <span class="slider_on sliders"> ON </span>
        <span class="slider_switch"></span> -->
            

      </div>  <lable style="margin-top: 3px;
    display: block;">&nbsp; Giới hạn khách hàng </lable>

	</div>
	<div class="clearfix"></div>
  
          
	<div id="customer_edit1" class="col-sm-12 pmt <?php  if ($v['type_segment'] != 1) {echo "input_value";} ?>">

		<table class="table" style="width:100%;">
			<thead>
				<th><input type="checkbox" name="" id="checkAll_edit"></th>
				<th>Nhóm khách hàng</th>
				<th>Ghi chú</th>
			</thead>
			<tbody>
			<?php 
				 $store = new Promotion;
                            $list_segment = $store->getsegmentfor($v['id']);

                            foreach ($store->getsegment() as $s_m):
				
			?>
				<tr>
                            <td><input type="checkbox" class="chk_edit" name="customer_edit[]" value="<?php echo  $s_m['id']; ?>"<?php if(array_key_exists($s_m['id'],$list_segment)) echo "checked";?> ></td>
                            <td><?php echo $s_m['name']; ?></td>
                            <td><input type="text" class="form-control" name=""></td>
                          </tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
/*$("#checkAll").click(function(){
    $('.chk').not(this).prop('checked', this.checked);
});
$(".chk").click(function(){
	if()
    $('#checkAll').not(this).prop('checked', this.checked);
});*/

function change_status_customer()
    {
        $("#on_edit").toggleClass("On");
        $("#off_edit").toggleClass("Off");
        $('#switch_edit').toggleClass("Switch");
           $('#customer_edit1').toggleClass('input_value'); 
               $(".chk_edit").each(function(){
            this.checked=false;
          }) 
          $("#checkAll_edit").prop("checked", false);   

    }
$("#checkAll_edit").change(function(){
    if(this.checked){
      $(".chk_edit").each(function(){
        this.checked=true;
      })              
    }else{
      $(".chk_edit").each(function(){
        this.checked=false;
      })              
    }
  });

  $(".chk_edit").click(function () {
    if ($(this).is(":checked")){
      var isAllChecked = 0;
      $(".chk_edit").each(function(){
        if(!this.checked)
           isAllChecked = 1;
      })              
      if(isAllChecked == 0){ $("#checkAll_edit").prop("checked", true); }     
    }
    else {
      $("#checkAll_edit").prop("checked", false);
    }
  });
</script>