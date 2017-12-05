<div class="customerProfileContainer">
    <div id="customerProfileDetail" class="customerProfileHolder" style="display: block;">

        <div id="content" style="padding-right: 0;">
        
        <ul id="menuk" class="menuk">
        <?php      
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/bootstrap-typeahead.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/bootstrap-popover.js");
        ?>
        </ul>

        <div id="list_deal" class="contentk" style="padding: 0px;height: 100%;min-height: 900px;">
            <!-- Body List -->
            
            <div class="pageContent">
            	<div class="tableContainer">
            		<div id="tableView" class="tableView">	
            	
            		</div>
            	</div>	
            </div>

       
            <!-- AddNew Deal -->
            <?php include_once('addnew_deal_opportunity.php'); ?>
         
        </div>
            
        </div>
    </div>

</div>
<script>
   
    function AddnewDealOpportunity(){
        
        var stage               = $("#addnew_stage .widget-radio" ).find('input:checked').val();        
       
        var contact_person_name = $('#addnew_contact_person_name').val();
        var organization_name   = $('#addnew_organization_name').val();
        var deal_value          = $("#addnew_deal_value").val();
        var title               = $("#addnew_title").val();
        var finish_date         = $("#addnew_finish_date").val();    
        var currency            = $("#addnew_currency").val();

        if(contact_person_name == ""){
            $("#alertAddnewDeal").removeClass('hiden').html('<span class="alert alert-error" >Please check box Contact person name!</span>');            
            return false;
        }      

        if(title == ""){
            $("#alertAddnewDeal").removeClass('hiden').html('<span class="alert alert-error" >Please check box Deal title!</span>');            
            return false;
        }    
        
        jQuery.ajax({
            type:"POST",
            url:"<?php echo CController::createUrl('Opportunity/AddnewDealOpportunity')?>",
            data:{               
                contact_person_name : contact_person_name,
                organization_name   : organization_name,
                deal_value          : deal_value,
                title               : title,
                stage               : stage,
                finish_date         : finish_date,
                currency            : currency
            },
            beforeSend: function() {
                $('#idwaiting_convert_product').html('<i class="fa-li fa fa-spinner fa-spin"></i>');
            },
            success:function(data){               
                if(data == '1'){
                    AjaxSearchDealTable(data);                    
                    $("#modalAddNewDeal").modal('hide');                    
                }               
                else{                  
                    $("#alertAddnewDeal").removeClass('hiden').html('<span class="alert alert-error" >Error ! Please check back value.</span>')
                }       
                      
            },
            error: function(data){ 
                $('#idwaiting_convert_product').html('');
                alert("Error occured.Please try again!");
            },
        });
    } 

    $(document).ready(function(){
        $("#modal_add_new_deal").click(function(){
            $("#alertAddnewDeal").html('');     
            $("#addnew_contact_person_name").val('');
            $("#addnew_organization_name").val('');
            $("#addnew_deal_value").val('');
            $("#addnew_title").val('');
            $("#addnew_finish_date").val('');
            $("#console_checkcontactpersonname").html('');
            $("#console_checkorganizationname").html('');
        });
    });  
    
    
    function runScript(e) {
        if (e.keyCode == 13) {
            AjaxSearchDealTable('1');
        }
    }
</script>