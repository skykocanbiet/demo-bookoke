<div>
	<div class="col-sm-12" style="padding-left:22px;">
		<div onclick="change_store()" id="slider_holder" class="slider_holder staffhours sliderdone">
						
				<input type="hidden" value="1">
				<span  id="off_store" class="slider_off Off sliders"> TẮT </span>
				<span  id="on_store" class="slider_on On sliders"> BẬT </span>
				<span  id="switch_store" class="slider_switch Switch"></span>

				<!-- <input type="hidden" value="0">
				<span class="slider_off sliders"> OFF </span>
				<span class="slider_on sliders"> ON </span>
				<span class="slider_switch"></span> -->
						

			</div> <lable style="margin-top: 3px;
    display: block;"> &nbsp; Giới hạn chi nhánh </lable>

	</div>
	<div class="clearfix"></div>
  
          
	<div id="store1" class="col-sm-12 input_value pmt">

		<table class="table" style="width:100%;">
			<thead>
				<th><input type="checkbox" name="" id="checkAll_store"></th>
				<th>Chi nhánh</th>
				<th>Ghi chú</th>
			</thead>
			<tbody>
			<?php 
					$store = new Promotion;
					foreach ($store->getbranch() as $key):
						
					
			?>
				<tr>
					<td><input type="checkbox" class="chk_store" name="store[]" value="<?php echo $key['id']; ?>"></td>
					<td><?php echo $key['name']; ?></td>
					<td><input type="text" class="form-control" name=""></td>
				</tr>
			<?php endforeach; ?>	
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">

function change_store()
    {
    	  $("#on_store").toggleClass("On");
    	  $("#off_store").toggleClass("Off");
    	  $('#switch_store').toggleClass("Switch");
       	  $('#store1').toggleClass('input_value'); 
    	  $(".chk_store").each(function(){
		        this.checked=false;
		      }) 
		      $("#checkAll_store").prop("checked", false);

    }
$("#limit_store").change(function(){
	if(this.checked){
      
               $('#store1').removeClass('input_value');  
    }else{
      
              $('#store1').addClass('input_value');
               $(".chk_store").each(function(){
		        this.checked=false;
		      }) 
		      $("#checkAll_store").prop("checked", false);      
    }
});
$("#checkAll_store").change(function(){
    if(this.checked){
      $(".chk_store").each(function(){
        this.checked=true;
      })              
    }else{
      $(".chk_store").each(function(){
        this.checked=false;
      })              
    }
  });

  $(".chk_store").click(function () {
    if ($(this).is(":checked")){
      var isAllChecked = 0;
      $(".chk_store").each(function(){
        if(!this.checked)
           isAllChecked = 1;
      })              
      if(isAllChecked == 0){ $("#checkAll_store").prop("checked", true); }     
    }
    else {
      $("#checkAll_store").prop("checked", false);
    }
  });
</script>