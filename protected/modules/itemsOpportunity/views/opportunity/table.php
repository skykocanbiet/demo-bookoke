<?php 
$exchange_rate = 22000;
?>

	<table class="list table-deals table">
		
		<thead id="thead">
			
				<tr>

				
			
			
				<th data-field="title" data-type="varchar" data-tooltip="" class="type draggable sorted primary">
					<div class="headItem">
						<span class="headerColText">
							
							Cơ hội
						</span>
						
					</div>
				</th>
			
				<th data-field="value" data-type="monetary" data-tooltip="" class="type draggable ">
					<div class="headItem">
						<span class="headerColText">
							
							Giá trị
						</span>
						
					</div>
				</th>
			
				<th data-field="org_id" data-type="organization" data-tooltip="" class="type draggable ">
					<div class="headItem">
						<span class="headerColText">
							
							Công ty
						</span>
						
					</div>
				</th>
			
				<th data-field="person_id" data-type="person" data-tooltip="" class="type draggable ">
					<div class="headItem">
						<span class="headerColText">
							
							Người đại diện
						</span>
						
					</div>
				</th>
			
				<th data-field="expected_close_date" data-type="date" data-tooltip="" class="type draggable descending">
					<div class="headItem">
						<span class="headerColText">
							
							Ngày dự kiến hoàn tất
						</span>
						
					</div>
				</th>
			
				<th data-field="next_activity_date" data-type="date" data-tooltip="" class="type draggable descending">
					<div class="headItem">
						<span class="headerColText">
							
							Ngày hẹn kế tiếp
						</span>
						
					</div>
				</th>
			
				<th data-field="user_id" data-type="user" data-tooltip="" class="type draggable ">
					<div class="headItem">
						<span class="headerColText">
							
							Người phụ trách
						</span>
						
					</div>
				</th>		
			

				<th>
					Thực hiện
				</th>
			
		</tr>
		</thead>
		
	<tbody id="bodyTblContent">
		<?php 
		if (!empty($data['data'])) 
		{			
		foreach ($data['data'] as $key => $value) 
		{
			$getMinDateTimeSchedule = $model->getMinDateTimeSchedule($value['id']);
		?>
		<tr class="viewItem" data-cid="c1578">
			
			<td data-field="title">
				<div class="item read varcharField editable">
					<span class="editField">
						<span class="input"><a data-toggle="popover" data-placement="bottom" data-popover-content="#edit-title<?php echo $value['id'];?>" class="button small"><span class="fa fa-pencil"></span></a></span>
					</span>
					<div class="valueWrap singleRow clearfix">
						<span class="value link"><a href="" data-test="title-label"><?php echo $value['title'];?></a></span>
					</div>
				</div>
			</td>
			<td data-field="value">
				<div class="item read monetaryField editable">
					<span class="editField">
						<span class="input"><a data-toggle="popover" data-placement="bottom" data-popover-content="#edit-value<?php echo $value['id'];?>" class="button small" id="pipeButton-zwCaXzcX"><span class="fa fa-pencil"></span></a></span>
					</span>
					<div class="valueWrap singleRow clearfix">
						<span class="value monetary" data-test="value-label"><?php if($value['currency']=="VND") echo number_format($value['deal_value'],0,",",".")." VND"; else echo $model->money_format('%#10n',$value['deal_value']/$exchange_rate); ?></span>
					</div>
				</div>
			</td>
			<td data-field="org_id">
				<div class="item read organizationField editable">
					<span class="editField">
						<span class="input"><a data-toggle="popover" data-placement="bottom" data-popover-content="#edit-organization<?php echo $value['id'];?>" class="button small" id="pipeButton-7EbsAKwX"><span class="fa fa-pencil"></span></a></span>
					</span>
					<div class="valueWrap singleRow clearfix">
						<span class="value link"><a href="" data-test="org_id-label"><?php echo $value['organization_name'];?></a></span>
					</div>
				</div>
			</td>
			<td data-field="person_id">
				<div class="item read personField editable">
					<span class="editField">
						<span class="input"><a data-toggle="popover" data-placement="bottom" data-popover-content="#edit-contact-person<?php echo $value['id'];?>" class="button small" id="pipeButton-Y4QbexYX"><span class="fa fa-pencil"></span></a></span>
					</span>
					<div class="valueWrap singleRow clearfix">
						<span class="value link"><a href="" data-test="person_id-label"><?php echo $value['contact_person_name'];?></a></span>
					</div>
				</div>
			</td>
			<td data-field="expected_close_date">
				<div class="item read dateField editable">
					<span class="editField">
						<span class="input"><a data-toggle="popover" data-placement="bottom" data-popover-content="#edit-finish-date<?php echo $value['id'];?>" class="button small" id="pipeButton-027s5rDL"><span class="fa fa-pencil"></span></a></span>
					</span>
					<div class="valueWrap singleRow clearfix">
						<span class="value date" data-test="expected_close_date-label"><?php if(strtotime($value['finish_date'])) echo date('d/m/Y',strtotime($value['finish_date']));?></span>
					</div>
				</div>
			</td>
			<td data-field="next_activity_date">
				<div class="item read dateField">
					<div class="valueWrap singleRow clearfix">
						<span class="value date" data-test="next_activity_date-label">						
						<?php if(strtotime($getMinDateTimeSchedule)) echo date('d/m/Y',strtotime($getMinDateTimeSchedule));?>
						</span>
					</div>
				</div>
			</td>
			<td data-field="user_id">
				<div class="item read userField editable">
					<span class="editField">
						<span class="input"><a href="#" class="button small" id="pipeButton-dmkerj8C"><span class="fa fa-pencil"></span></a></span>
					</span>
					<div class="valueWrap singleRow clearfix">
						<span class="value link"><a href="" data-test="user_id-label"></a></span>
					</div>
				</div>
			</td>

			<td class="deleteRow">				
                <img onclick="deleteDeal(<?php echo $value['id'];?>)" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width:15px;height:15px;cursor:pointer;">
			</td>

		</tr>

		<!-- Popover Edit Title -->
		<div class="hiden popover-edit" id="edit-title<?php echo $value['id'];?>">	

            <h3 class="popover-heading" style="background-color: #fff;">
               Chỉnh Sửa Cơ Hội
            </h3>

            <div class="popover-body">               
            	
	            <input type="text" id="title<?php echo $value['id'];?>" class="input_addnew_deal input-xlarge form-control" value="<?php echo $value['title'];?>" style="margin:10px 0px 10px 7px;">  
        
               	<div class="actions">
	               	<span class="input cancel">
		               	<a href="javascript:void(0)" class="button cancel" id="" data-test="title-cancel">
		               		<span class="soft action cancel">Hủy</span>
		               	</a>
	               	</span> 
	               	<span class="input save">
		               	<button onclick="editTitle(<?php echo $value['id'];?>);" class="new-gray-btn new-green-btn">Lưu</button>
	               	</span>
               	</div> 
	           	
            </div>
           
        </div>

        <!-- Popover Edit Deal Value Currency -->
		<div class="hiden popover-edit" id="edit-value<?php echo $value['id'];?>">	

            <h3 class="popover-heading" style="background-color: #fff;">
               Chỉnh Sửa Giá Trị
            </h3>

            <div class="popover-body">               
            	<span class="input-icon-prepend" style="width: 35%; display: inline-block;margin-right: 12px;" >   
	            	<input type="text" id="value<?php echo $value['id'];?>" class="form-control" value="<?php if($value['currency']=="VND") echo $value['deal_value']; else echo round($value['deal_value']/$exchange_rate, 2); ?>" style="margin:10px 0px 10px 0px;">  
        		</span>
        		<span>
	                <select id="currency<?php echo $value['id'];?>" class="input-xlarge form-control" style="width: 55%;display: inline-block;" >
	                    <option <?php if($value['currency']=="USD") echo "selected";?> value="USD">US Dollar (USD)</option>
	                    <option <?php if($value['currency']=="VND") echo "selected";?> value="VND">Vietnamese Dong (VND)</option>
	                </select>
            	</span>
               	<div class="actions">
	               	<span class="input cancel">
		               	<a href="javascript:void(0)" class="button cancel" id="" data-test="title-cancel">
		               		<span class="soft action cancel">Hủy</span>
		               	</a>
	               	</span> 
	               	<span class="input save">
		               	<button onclick="editValue(<?php echo $value['id'];?>);" class="new-gray-btn new-green-btn">Lưu</button>
	               	</span>
               	</div> 
	           	
            </div>
           
        </div>

        <!-- Popover Edit Organization -->
		<div class="hiden popover-edit" id="edit-organization<?php echo $value['id'];?>">	

            <h3 class="popover-heading" style="background-color: #fff;">
               Chỉnh Sửa Công Ty
            </h3>

            <div class="popover-body">               
            	
	            <input type="text" id="organization<?php echo $value['id'];?>" class="input_addnew_deal input-xlarge form-control" value="<?php echo $value['organization_name'];?>" style="margin:10px 0px 10px 7px;">  
        
               	<div class="actions">
	               	<span class="input cancel">
		               	<a href="javascript:void(0)" class="button cancel" id="" data-test="title-cancel">
		               		<span class="soft action cancel">Hủy</span>
		               	</a>
	               	</span> 
	               	<span class="input save">
		               	<button onclick="editOrganization(<?php echo $value['id'];?>);" class="new-gray-btn new-green-btn">Lưu</button>
	               	</span>
               	</div> 
	           	
            </div>
           
        </div>

        <!-- Popover Contact Person -->
		<div class="hiden popover-edit" id="edit-contact-person<?php echo $value['id'];?>">	

            <h3 class="popover-heading" style="background-color: #fff;">
               Chỉnh Sửa Người Đại Diện
            </h3>

            <div class="popover-body">               
            	
	            <input type="text" id="contact-person<?php echo $value['id'];?>" class="input_addnew_deal input-xlarge form-control" value="<?php echo $value['contact_person_name'];?>" style="margin:10px 0px 10px 7px;">  
        
               	<div class="actions">
	               	<span class="input cancel">
		               	<a href="javascript:void(0)" class="button cancel" id="" data-test="title-cancel">
		               		<span class="soft action cancel">Hủy</span>
		               	</a>
	               	</span> 
	               	<span class="input save">
		               	<button onclick="editContactPerson(<?php echo $value['id'];?>);" class="new-gray-btn new-green-btn">Lưu</button>
	               	</span>
               	</div> 
	           	
            </div>
           
        </div>

         <!-- Popover Finish Date -->
		<div class="hiden popover-edit" id="edit-finish-date<?php echo $value['id'];?>">	            

            <div class="popover-body">               
            	
	            <input type="date" id="finish-date<?php echo $value['id'];?>" class="input_addnew_deal input-xlarge form-control" value="<?php if(strtotime($value['finish_date'])) echo date('Y-m-d',strtotime($value['finish_date']));?>" style="margin:10px 0px 10px 7px;">  
        		
        		

               	<div class="actions">
	               	<span class="input cancel">
		               	<a href="javascript:void(0)" class="button cancel" id="" data-test="title-cancel">
		               		<span class="soft action cancel">Cancel</span>
		               	</a>
	               	</span> 
	               	<span class="input save">
		               	<button onclick="editFinishDate(<?php echo $value['id'];?>);" class="new-gray-btn new-green-btn">Save</button>
	               	</span>
               	</div> 
	           	
            </div>
           
        </div>

		<?php 
		}
		}
		else
		{
		?>
		<tr class="viewItem">
			<td colspan="8">
				<div class="emptyView">
					<div class="emptyList">
	
						<div class="emptyMessage">
							
								<h1>No deals found to match your criteria</h1>								
							
						</div>
					
					</div>
				</div>
			</td>		
		</tr>
		<?php 
		}
		?>
	</tbody>
	<tfoot></tfoot>
	</table>

<script>

$(function() {	
    $("table.list td")
        .click(function() { 
        	$(this).find("div").children(".editField").css("visibility","visible");         
        })
        
});
$(function() {
    $("table.list td")
        .mouseover(function() { 
        	$(this).find("div").children(".editField").css("visibility","visible");         
        })
        .mouseout(function() {
        	if (!$(this).find("div").children(".editField").find("span").find("a").attr('aria-describedby')) {        		
        		$(this).find("div").children(".editField").css("visibility","hidden");        		
        	}		    
		})          

	    $(document).mouseup(function (e)
		{
			var container = $(".popover-edit");

		    if (!container.is(e.target) // if the target of the click isn't the container...
		        && container.has(e.target).length === 0) // ... nor a descendant of the container
		    {
		        $(this).find("div").children(".editField").css("visibility","hidden");		      
		    }
		    	   
		});
        
});
$(function(){
    $("[data-toggle=popover]").popover({
        html : true,
        content: function() {
          var content = $(this).attr("data-popover-content");
          return $(content).children(".popover-body").html();
        },
        title: function() {
          var title = $(this).attr("data-popover-content");
          return $(title).children(".popover-heading").html();
        }
    });
});

$('html').on('mouseup', function(e) {
    if(!$(e.target).closest('.popover').length) {
        $('.popover').each(function(){
            $(this.previousSibling).popover('hide');            
        });
    }
});

$(document).on("click", ".popover .cancel" , function(){
    $(this).parents(".popover").popover('hide');
    $(".editField").css("visibility","hidden"); 
});

function editTitle(id){

	var title = $('.popover '+'#title'+id).val();

	if (title == "") {
		alert("This item could not be updated!");
		AjaxSearchDealTable('1');
		return false;
	}
	
    $.ajax({
	    type:'POST',
	    url:"<?php echo CController::createUrl('Opportunity/editTitle')?>",
	    data: {"id":id,"title":title},   
	    success:function(data){
	    	if(data == '1'){
                AjaxSearchDealTable(data);  
            }              
	    },
	    error: function(data){
	    console.log("error");
	    console.log(data);
	    }
    });
}
function editValue(id){

	var value    = $('.popover '+'#value'+id).val();
	var currency = $('.popover '+'#currency'+id).val();	
	
	if (value == "" || value == 0) {		
		AjaxSearchDealTable('1');
	}

    $.ajax({
	    type:'POST',
	    url:"<?php echo CController::createUrl('Opportunity/editValue')?>",
	    data: {"id":id,"value":value,"currency":currency},   
	    success:function(data){
	    	if(data == '1'){
                AjaxSearchDealTable(data);  
            }              
	    },
	    error: function(data){
	    console.log("error");
	    console.log(data);
	    }
    });
}
function editOrganization(id){

	var organization = $('.popover '+'#organization'+id).val();	

	if (organization == "") {		
		AjaxSearchDealTable('1');
	}

    $.ajax({
	    type:'POST',
	    url:"<?php echo CController::createUrl('Opportunity/editOrganization')?>",
	    data: {"id":id,"organization":organization},   
	    success:function(data){
	    	if(data == '1'){
                AjaxSearchDealTable(data);  
            }              
	    },
	    error: function(data){
	    console.log("error");
	    console.log(data);
	    }
    });
}
function editContactPerson(id){

	var contact_person = $('.popover '+'#contact-person'+id).val();

	if (contact_person == "") {
		alert("This item could not be updated!");
		AjaxSearchDealTable('1');
		return false;
	}
	
    $.ajax({
	    type:'POST',
	    url:"<?php echo CController::createUrl('Opportunity/editContactPerson')?>",
	    data: {"id":id,"contact_person":contact_person},   
	    success:function(data){
	    	if(data == '1'){
                AjaxSearchDealTable(data);  
            }              
	    },
	    error: function(data){
	    console.log("error");
	    console.log(data);
	    }
    });
}
function editFinishDate(id){

	var finish_date = $('.popover '+'#finish-date'+id).val();

	if (finish_date == "") {	
		AjaxSearchDealTable('1');
	}
	
    $.ajax({
	    type:'POST',
	    url:"<?php echo CController::createUrl('Opportunity/editFinishDate')?>",
	    data: {"id":id,"finish_date":finish_date},   
	    success:function(data){
	    	if(data == '1'){
                AjaxSearchDealTable(data);  
            }              
	    },
	    error: function(data){
	    console.log("error");
	    console.log(data);
	    }
    });
}
function deleteDeal(id){
	if (confirm("Bạn có thật sự muốn xóa cơ hội này?")) {  
        $.ajax({
		    type:'POST',
		    url:"<?php echo CController::createUrl('Opportunity/deleteDeal')?>",
		    data: {"id":id},   
		    success:function(data){
		    	if(data == '1'){
	                AjaxSearchDealTable(data);  
	            }              
		    },
		    error: function(data){
		    console.log("error");
		    console.log(data);
		    }
    	});
    }
}

$(window).resize(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height(); 
    var oSrchBar     = $("#oSrchBar").height();
    var thead           = $("#thead").height();

    $('#bodyTblContent').height(windowHeight-header-oSrchBar-thead-110);

});
$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var oSrchBar     = $("#oSrchBar").height();
    var thead           = $("#thead").height();

    $('#bodyTblContent').height(windowHeight-header-oSrchBar-thead-110);
   
});
</script>