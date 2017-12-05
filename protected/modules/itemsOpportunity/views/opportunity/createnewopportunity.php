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
    MyTab::getTab('searchopportunity', 'Search Opportunity', 'opportunity/searchopportunity');
    MyTab::getTab('createnewopportunity', 'Create Opportunity', 'opportunity/createnewopportunity','active');
    MyTab::getTab('dealopportunity', 'Deal Opportunity', 'opportunity/dealopportunity');    
?>
</ul>
		<div id="description" class="contentk">
			<div class="bg_popup"  style="padding: 5px; overflow: auto; padding-bottom: 10px;" >
                <div style="float: left; width:700px">
					<div style="float: left;margin-right: 10px;">
						<div class="new_account_row">
							<span class="account_label">Phone Number:</span>
							<span><input  type="text" value="<?php if(isset($_REQUEST['phone_new']))echo $_REQUEST['phone_new'];?>" id="search_phone" name="search_phone" />
							<input  type="hidden" value="<?php if(isset($_REQUEST['id']))echo $_REQUEST['id'];?>" id="search_idclient" name="search_idclient"/>
							<input  type="hidden" value="" id="search_phone2" name="search_phone2"/>
							<input  type="hidden" value="<?php // echo $idlead;?>" id="id_leadopp" name="id_leadopp"/>
							</span>
						</div>
					</div>
				</div>
				<div style="margin-top: 10px;float: right;margin-right:18px; width: 200px; text-align: right;">
					<span style="margin-left: 1px;">
					<input type="hidden" value="asc" id="id_sort" />
					<button style="margin-right: 20px;" class="button_izi" onclick="search_opp('1')" >Search</button>
					<div id="idwaiting_search" style="position: absolute;margin-left: 260px;margin-top:-18px"></div>
					</span>
				</div>
				
			</div>
			
			<div style="clear: both;"></div>
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
				<div id="id_view_cusinfo" style="margin-top:40px">
					
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
    </div>

<script>
function search_opp(page)
{
	jQuery("#idwaiting_search").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/vtbusy.gif" alt="waiting....." />');
    var flag=1;id_view_cusinfo
	jQuery("#id_view_cusinfo").slideUp();
	jQuery("#id_viewcontent").slideUp();
    $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
    var search_phone=$("#search_phone").val();
    jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('opportunity/ajax_searchopp1')?>&search_phone="+search_phone+"&page="+page+"&flag="+flag,
                    success:function(html){
                            if(html!='-1')
                            {
                                $('#idwaiting_main').html('');
                                $('#id_viewcontent').html(html);
								jQuery("#id_viewcontent").slideDown();
								jQuery("#idwaiting_search").html('');
                            }
                            else{
                                jQuery("#idwaiting_main").html('');
                                jAlert('Data not found','Notice');
                            }
                        }
                        
                      });
    
}
function view_information_lead(id_lead)
{
    jQuery("#id_view_cusinfo").slideUp();
    $('.row_info').css({'background-color': '#FFEEFB'});
    $('.row_info2').css({'background-color': 'yellow'});
    $('#id_row_info_'+id_lead).css({'background-color': '#ECFBD4'});
     $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
     jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('opportunity/information')?>&id_lead="+id_lead,
                    success:function(html){
                         jQuery("#id_view_cusinfo").html(html);
                         $('#idwaiting_main').html('');
                    }
                      });
	jQuery("#id_view_cusinfo").slideDown();
}
</script>
