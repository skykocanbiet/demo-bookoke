<div style="margin-top: 5px;">
	<span class="lead_label" style="width: 150px; display: inline-block;" >Product Type <span style='color:red;'>*</span>:</span>
	<span>
		<?php
			$list_product=array();
			$list_product[''] = "Select Product Type";
			$list_data = ProductType::model()->findAllByAttributes(array('st'=>1));
			foreach($list_data as $row )
			{
				$list_product[$row['id']]=$row['name'];
			}
			?>

				<?php
			   $loading = "<img src=\"".Yii::app()->request->baseUrl.'/images/vtbusy.gif" alt="waiting....." />';
			   echo CHtml::dropDownList('add_new_account_products_type',"",$list_product,
											array('onChange'=>CHtml::ajax(array(
														'type'=>'GET',
														'url'=>CController::createUrl('pinless/ajax_product'),
														'data'=>array('idproductstype'=>'js:this.value'),
														'beforeSend'=> "function( request ) {

															jQuery('#id_waiting_product').html('$loading');
															}
															",
														 'success'=>'function(data) {
															 $("#add_new_account_products").html(data);
															 jQuery("#id_waiting_product").html("");
														  }',
														))));

		?>
	</span>
</div>
<div style="margin-top: 5px;">
	<span class="lead_label" style="width: 150px; display: inline-block;" >Product <span style='color:red;'>*</span>:</span>
	<span>
		<?php
										$list_product=array();
										$list_product[''] = "Select Product";
										?>

											<?php
										   $loading = "<img src=\"".Yii::app()->request->baseUrl.'/images/vtbusy.gif" alt="waiting....." />';
										   echo CHtml::dropDownList('add_new_account_products',"",$list_product);

									?>
	</span>
</div>
<div style="margin-top: 5px;">
	<span class="lead_label" style="width: 150px; display: inline-block;">Note <span style='color:red;'>*</span>:</span>
	<span>
	<textarea id="note_potential"></textarea>
	</span>
</div>
<div style="margin-top: 10px;">
	<span class="lead_label">&nbsp;</span>
	<span style="margin-left: 200px;">
	<button class="button_izi" style="margin-right: 20px;" onclick="add_new_opportunity('<?=$idlead?>')" >Submit</button>
	<!--<button style="width: 60px;" onclick="cancel()"  >Cancel</button>-->
	</span>
</div> 
<script>
function add_new_opportunity(idlead){
	var search_phone=$("#search_phone").val();
	var producttype=$("#add_new_account_products_type").val();
	var product=$("#add_new_account_products").val();
	var note=$("#note_potential").val();
    
	if(producttype == ""){
		$('#add_new_account_products_type').css({'border': '1px solid red'});
		return false;
	}
	else{
		$('#add_new_account_products_type').css({'border': '1px solid #333'});
	}
    
	if(product == ""){
		$('#add_new_account_products').css({'border': '1px solid red'});
		return ;
	}
	else{
		$('#add_new_account_products').css({'border': '1px solid #333'});
	}
    
	if(note == ""){
		$('#note_potential').css({'border': '1px solid red'});
		return ;
	}
	else{
		$('#note_potential').css({'border': '1px solid #333'});
	}
	
	$('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
        var url_temp="<?php echo CController::createUrl('opportunity/ajax_new')?>&idlead=<?=$idlead?>"+
																				"&producttype=" + producttype +
																				"&product=" + product +
																				"&note=" + note;
         jQuery.ajax({ type:"POST",
                        url:url_temp,
                        success:function(html){
                             jQuery("#idwaiting_main").html('');
                             if(html!='-1' && html!='' && html!='-2')
                             {
                               // location.href = '<?php echo CController::createUrl('lead/searchlead')?>';
                                jAlert('Add lead success !','Notice');
								jQuery("#id_view_cusinfo").slideUp();
                             } 
                             else 
                             {
                                if(html=='-1')
                                    jAlert('Lead already had an account !','Errors');
                                else if(html=='-2')
                                    jAlert('Lead is processing by an agent !','Errors');
                                else if(html=='')
                                    jAlert('New lead ERRORS!!!','Errors');
                             }
                        }
                          });
}
</script>


















