<style>
.xoay_img3{
       transform: rotate(-180deg);
-ms-transform: rotate(-180deg); /* IE 9 */
-webkit-transform: rotate(-180deg); /* Safari and Chrome */
-o-transform: rotate(-180deg); /* Opera */
-moz-transform: rotate(-180deg); /* Firefox */ 
}
</style>
<?php

$this->breadcrumbs=array(
	'Opportunities manager'=>'#',
	'Search opportunity',
);


?>
<?php if(isset($this->breadcrumbs))?>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	))?><!-- breadcrumbs -->
    <div id="content" style="padding-right: 0;">
		<ul id="menuk" class="menuk">
		<?php
			include_once(Yii::app()->theme->basePath.'/views/layouts/tab.php');
            MyTab::getTab('searchopportunity', 'Search Opportunity', 'opportunity/searchopportunity','active');
			MyTab::getTab('createnewopportunity', 'Create Opportunity', 'opportunity/createnewopportunity');
			MyTab::getTab('dealopportunity', 'Deal Opportunity', 'opportunity/dealopportunity');
			//MyTab::getTab('specialopportunity', 'Special opportunity', 'opportunity/specialopportunity');
			//MyTab::getTab('filteropportunity', 'Filter opportunity', 'opportunity/filteropportunity');
			//MyTab::getTab('reportopportunity', 'Reports opportunity', 'opportunity/reportopportunity');
			?>

		</ul>
		<div id="description" class="contentk">
			<div class="bg_popup"  style="padding: 5px;" >
                <div style="float: left; width:700px">
					<div style="float: left;margin-right: 10px;">
						<div class="new_account_row">
							<span class="account_label">First Name:</span>
							<span>
							<input  type="text" value="" id="search_firstname" name="search_firstname" />
							<input  type="hidden" value="" id="search_firstname2" name="search_firstname2"/>
							</span>
						</div>
						<div class="new_account_row">
							<span class="account_label">Phone Number:</span>
							<span><input  type="text" value="<?php if(isset($_REQUEST['phone_new']))echo $_REQUEST['phone_new'];?>" id="search_phone" name="search_phone" />
							<input  type="hidden" value="<?php if(isset($_REQUEST['id']))echo $_REQUEST['id'];?>" id="search_idclient" name="search_idclient"/>
							<input  type="hidden" value="" id="search_phone2" name="search_phone2"/>
							<input  type="hidden" value="<?php echo $idlead;?>" id="id_leadopp" name="id_leadopp"/>
							</span>
						</div>
					</div>
					<div style="float: left;">
						<div class="new_account_row">
							<span class="account_label">Type:</span>
							<span>
							<select id="id_type">
								<option value="0">Opportunity</option>
								<option value="">All</option>
								<option value="1">Order</option>
								<option value="2">Finish</option>
							</select>
							</span>
						</div>
					</div>
					<div style="clear: both;"></div>
				</div>
				<div style="margin-top: 10px;float: right;margin-right:18px; width: 200px; text-align: right;">
					<span style="margin-left: 1px;">
					<input type="hidden" value="asc" id="id_sort" />
					<button style="margin-right: 20px;" class="button_izi" onclick="search_opp('1')" >Search</button>
					<div id="idwaiting_search" style="position: absolute;margin-left: 260px;margin-top:-18px"></div>
					</span>
				</div>
            </div>
			<div style="clear:both"></div>
            <br />
			<div style="padding: 3px;background-color: #f9f3ff;" >
				<div id="id_viewcontent">
    				<table bgcolor="#98aec0" cellpadding="2" cellspacing="1" width="100%"  style="border-spacing: 1px;"  >
    				<tbody >
    				<tr style="background-color: #bca8d2;color: #5c2b95;" class="table_title" >
    					<td ><strong>No.</strong></td>
    					<td ><strong>First name</strong></td>
    					<td ><strong>Last name</strong></td>
    					<td ><strong>Phone number</strong></td>
    					<td ><strong>Scheduled date</strong></td>
    					<td ><strong>Potential Rating</strong></td>
    					<td ><strong>Trial Balance</strong></td>
    					<td ><strong>Referred by</strong></td>
    			
    				</tr>
    				</tbody>
    				</table>
				</div>
			</div>
        	<div id="id_view_cusinfo" style="margin-top:40px">
				
			</div>
        </div>
    </div>
<script>
function search_opp(page)
{
	jQuery("#idwaiting_search").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/vtbusy.gif" alt="waiting....." />');
	jQuery("#id_view_cusinfo").slideUp();
	jQuery("#id_viewcontent").slideUp();
    var flag=1;
    var type=$("#id_type").val();
    var sort=$("#id_sort").val();
    $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
    var search_phone=$("#search_phone").val();
    var search_firstname=$("#search_firstname").val();
    var search_state=$("#search_state").val();
    jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('opportunity/ajax_searchopp')?>&search_phone="+search_phone+"&search_firstname="+search_firstname+"&page="+page+"&flag="+flag+"&type="+type+"&sort="+sort+"&search_state="+search_state,
                    success:function(html){
                            if(html!='-1')
                            {
                                $('#idwaiting_main').html('');
                                $('#id_viewcontent').html(html);
								jQuery("#id_viewcontent").slideDown();
								jQuery("#idwaiting_search").html('');
                                if(sort=='asc')
                                {
                                    //$("#id_sort").val('desc');
                                    $("#sort_img").html('<img  src="images/activate.gif" />');
                                }
                                else{
                                    //$("#id_sort").val('asc');
                                    $("#sort_img").html('<img class="xoay_img3"src="images/activate.gif" />');
                                }
                            }
                            else
                            {
                                jQuery("#idwaiting_main").html('');
                                jAlert('Data not found','Notice');

                            }
                        }
                        
                      });
	
    
}
function search_opp_detail(page,idlead)
{
	jQuery("#id_hist").slideUp();
    $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
	
    jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('opportunity/ajax_searchopp_detail')?>&idlead="+idlead+"&page="+page,
                    success:function(html){
                            if(html!='-1')
                            {
                                $('#idwaiting_main').html('');
                                $('#id_hist').html(html);
								jQuery("#id_hist").slideDown();
                            }
                            else
                            {
                                jQuery("#idwaiting_main").html('');
                                jAlert('Data not found','Notice');

                            }
                        }
                        
                      });
	jQuery("#id_hist").slideDown();
}
function runScript(e) 
{
    if (e.keyCode == 13) 
    {
        var page_1=$('#id_text_page').val();
        if(page_1)
            search_opp(page_1);
        else
            search_opp('1');
    }
}

function view_information_lead(id_lead)
{
    jQuery("#id_view_cusinfo").slideDown();
    $('.row_info').css({'background-color': '#FFEEFB'});
    //$('.row_info2').css({'background-color': 'yellow'});
    $('#id_row_info_'+id_lead).css({'background-color': '#ECFBD4'});
     $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
     jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('opportunity/detail')?>&id_lead="+id_lead,
                    success:function(html){
                         jQuery("#id_view_cusinfo").html(html);
                         $('#idwaiting_main').html('');
                    }
                      });
}
search_opp('1');
$(function() {
        var id_leadopp=$('#id_leadopp').val();
        if(id_leadopp)
        {
            view_information_lead(id_leadopp);
        }
            
});

</script>
