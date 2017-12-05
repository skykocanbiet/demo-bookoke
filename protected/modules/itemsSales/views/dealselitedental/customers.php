<style type="text/css">
	
</style>
<div>
	<div class="col-sm-12" style="padding-left:22px;">
		
		 <div onclick="change_status()" id="slider_holder" class="slider_holder staffhours sliderdone">
						
				<input type="hidden" value="1">
				<span  id="off" class="slider_off Off sliders"> TẮT </span>
				<span  id="on" class="slider_on On sliders"> BẬT </span>
				<span  id="switch" class="slider_switch Switch"></span>

				<!-- <input type="hidden" value="0">
				<span class="slider_off sliders"> OFF </span>
				<span class="slider_on sliders"> ON </span>
				<span class="slider_switch"></span> -->
						

			</div> <lable style="margin-top: 3px;
    display: block;"> &nbsp; Giới hạn khách hàng </lable>
	</div>
	<div class="clearfix"></div>
    
          
	<div id="customer1" class="col-sm-12 input_value pmt">

		<table class="table" style="width:100%;">
			<thead>
				<th><input type="checkbox" name="" id="checkAll"></th>
				<th>Nhóm khách hàng</th>
				<th>Ghi chú</th>
			</thead>
			<tbody>
			<?php 
				$data = new Promotion;
				foreach ($data->getsegment() as $cus){
					# code...
				
				
			?>
				<tr>
					<td><input type="checkbox" class="chk" name="customer[]" value="<?php echo $cus['id']; ?>"></td>
					<td><?php echo $cus['name']; ?></td>
					<td><input type="text" class="form-control" name="txtcustomer[]"></td>
				</tr>
			<?php } ?>
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
function change_status()
    {
    	  $("#on").toggleClass("On");
    	  $("#off").toggleClass("Off");
    	  $('#switch').toggleClass("Switch");
       	  $('#customer1').toggleClass('input_value'); 
    	  $(".chk").each(function(){
		        this.checked=false;
		      }) 
		      $("#checkAll").prop("checked", false);

    }

$("#checkAll").change(function(){
    if(this.checked){
      $(".chk").each(function(){
        this.checked=true;
      })              
    }else{
      $(".chk").each(function(){
        this.checked=false;
      })              
    }
  });

  $(".chk").click(function () {
    if ($(this).is(":checked")){
      var isAllChecked = 0;
      $(".chk").each(function(){
        if(!this.checked)
           isAllChecked = 1;
      })              
      if(isAllChecked == 0){ $("#checkAll").prop("checked", true); }     
    }
    else {
      $("#checkAll").prop("checked", false);
    }
  });
</script>