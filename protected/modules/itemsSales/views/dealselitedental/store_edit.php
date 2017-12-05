<div id="cl">
	<div class="col-sm-12" style="padding-left:22px;">

		<div onclick="change_status_store()" id="slider_holder" class="slider_holder staffhours sliderdone">
            
        <input type="hidden" value="1">
        <span  id="off_store_edit" class="slider_off <?php  if ($v['type_branch'] != 1) {echo "Off";} ?> sliders"> TẮT </span>
        <span  id="on_store_edit" class="slider_on <?php  if ($v['type_branch'] != 1) {echo "On";} ?> sliders"> BẬT </span>
        <span  id="switch_store_edit" class="slider_switch <?php  if ($v['type_branch'] != 1) {echo "Switch";} ?>"></span>

        <!-- <input type="hidden" value="0">
        <span class="slider_off sliders"> OFF </span>
        <span class="slider_on sliders"> ON </span>
        <span class="slider_switch"></span> -->
            

      </div> <lable style="margin-top: 3px;
    display: block;"> &nbsp; Giới hạn chi nhánh </lable>

	</div>
	<div class="clearfix"></div>
    
          
	<div id="store_edit1" class="col-sm-12 pmt <?php  if ($v['type_branch'] != 1) {echo "input_value";} ?>">

		<table class="table" style="width:100%;">
			<thead>
				<th><input type="checkbox" name="" id="checkAll_store_edit"></th>
				<th>Tên chi nhánh</th>
				<th>Ghi chú</th>
			</thead>
			<tbody>
			<?php 
					$store = new Promotion;
					$list_data = $store->getbranchfor($v['id']);
					foreach ($store->getbranch() as $key):
						
					
			?>
				 <tr>
                            <td><input type="checkbox" class="chk_store_edit" name="store_edit[]" value="<?php echo  $key['id']; ?>"<?php if(array_key_exists($key['id'],$list_data)) echo "checked";?> ></td>
                            <td><?php echo $key['name']; ?></td>
                            <td><input type="text" class="form-control" name=""></td>
                          </tr>
			<?php endforeach; ?>	
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
function change_status_store()
    {
        $("#on_store_edit").toggleClass("On");
        $("#off_store_edit").toggleClass("Off");
        $('#switch_store_edit').toggleClass("Switch");
           $('#store_edit1').toggleClass('input_value'); 
               $(".chk_store_edit").each(function(){
            this.checked=false;
          }) 
          $("#checkAll_store_edit").prop("checked", false);   

    }
$("#limit_store_edit").change(function(){
	if(this.checked){
      
               $('#store_edit1').removeClass('input_value');  
    }else{
      
              $('#store_edit1').addClass('input_value');
               $(".chk_store_edit").each(function(){
		        this.checked=false;
		      }) 
		      $("#checkAll_store_edit").prop("checked", false);      
    }
});
$("#checkAll_store_edit").change(function(){
    if(this.checked){
      $(".chk_store_edit").each(function(){
        this.checked=true;
      })              
    }else{
      $(".chk_store_edit").each(function(){
        this.checked=false;
      })              
    }
  });

  $(".chk_store_edit").click(function () {
    if ($(this).is(":checked")){
      var isAllChecked = 0;
      $(".chk_store_edit").each(function(){
        if(!this.checked)
           isAllChecked = 1;
      })              
      if(isAllChecked == 0){ $("#checkAll_store_edit").prop("checked", true); }     
    }
    else {
      $("#checkAll_store").prop("checked", false);
    }
  });
  function checkbox(){

}
</script>