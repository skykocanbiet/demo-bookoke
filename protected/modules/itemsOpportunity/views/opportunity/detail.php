<?php 
$list_detail=$info;
?>
<div class="content_child" style="width:98%; border: none; margin: 0px auto;" >
    <div class="bg_popup" style="min-height:470px;font-size: 10pt;">
        <!-- VIEW LEAD DETAIL -->  
        <div><hr style="background-color: #5C2B95  ;opacity:0.5;"  /></div>
        <div style="position: relative; line-height: 27px;" >
            <input type="hidden" value="1" id="lenxuong0" />
            <span style="margin-left: 5px;" id="id_up0"><img src="images/down.png" height="10px" width="15px" /></span>
            <span onclick="toogle_leaddetail('id_leaddetail','0')" style="font-size: 11pt;font-weight: bold;color: #5C2B95;cursor: pointer;">Lead detail</span>
        </div>          
        <div id="id_leaddetail" style="margin-top: 10px;">
            <!-- View Buttom Edit/Save -->
            <div style="position:absolute;top:200px;left:300px" id="idhold_lead"></div>
            <div style="position:absolute;top:23px;right:0px;" >
                <div id="id_editinfo" style="display: block;"><button onclick="vieweditlead()" class="button_izi">Edit</button></div>
                <div id="id_saveeditinfo" style="display: none;">
                    <span style="margin-right: 5px;" id="id_loading_edit"></span>
                    <span style="margin-right: 10px;" onclick="save_edit_infolead('<?php echo $idlead?>')"><button class="button_izi">Save</button></span>
                    <span><button onclick="hideeditlead()" class="button_delete">Cancel</button></span>
                </div>
            </div>
            <!-- End Buttom Edit/Save --> 
            <div style="float: left; border-right: solid 1px #B29BCD;width:330px;margin-right: 10px;text-align: left; width: 50%;">
                <div style="margin-top: 30px;">
                    <div style="height:25px; padding-bottom: 10px;">
            			<span style="margin-right: 30px;text-align: right;width:107px;float:left" >First Name:</span>
            			<span>
            			<input type="hidden" value="<?php echo $list_detail['flag']?>" id="txt_idflag" />
            			<input type="hidden" value="<?php echo $idlead?>" id="txt_idlead" />
            			<input type="text" value="<?php echo $list_detail['firstname']?>" id="id_firstname_lead"  disabled="" onkeyup="changeCase(this.id,this.value,1);"/></span>
                    </div>
                    <div style="height:25px; padding-bottom: 10px;">
            			<span style="margin-right: 30px;text-align: right;width:107px;float:left">Last Name:</span>
            			<span>
            			<input type="hidden" value="<?php echo $id_user?>" id="id_userid"/>
            			<input type="text" value="<?php echo $list_detail['lastname']?>" id="id_lastname_lead" disabled="" onkeyup="changeCase(this.id,this.value,1);"/></span>
                    </div>
                    
                    <div style="height:25px; padding-bottom: 10px;">
            			<span style="margin-right: 30px;text-align: right;width:107px;float:left">Gender:</span>
            			<span>
            			<select id="id_gender_lead"  style="width: 160px;" disabled="">
            				<option value="<?php echo $list_detail['gender']?>"><?php if($list_detail['gender']) echo $list_detail['gender']; else echo 'Undefined';?></option>
            				<option value="Ms"> Ms. </option>
            				<option value="Mr"> Mr. </option>
            				<option value=""> Undefined </option>
            			</select>
            		
            			</span>
                    </div>
                    <div style="height:25px; padding-bottom: 10px;">
            			<span style="margin-right: 30px;text-align: right;width:107px;float:left">Company:</span>
            			<span>
            			<input type="text" value="<?php echo $list_detail['company']?>" id="id_company_lead" disabled=""/>
            			</span>
                    </div>
                    <div style="height:25px; padding-bottom: 10px;">
            			<span style="margin-right: 30px;text-align: right;width:107px;float:left">Source:</span>
            			<?php 
            			$group_no = Yii::app()->user->getState('group_no');
            			if($group_no=='admin'||$group_no=='manager'||$group_no=='superadmin')
            			{
            			   ?>
            			   <span>
            			
            			
            				<select id="id_birthday_lead"  style="width: 160px;" disabled="">
            							<?php
            							
            							$name_source=$model->get_source_name($list_detail['source']);
            							if($name_source)
            							{
            								?>
            								<option value="<?php echo $list_detail['source']?>"> <?php echo $name_source;?> </option>
            								<?
            							}
            							else
            							{
            								?>
            								<option value=""> <?php echo 'N/A';?> </option>
            								<?
            							}
            							?>
            							
            							 <?php 
            								$list_source=$model->show_list_source();
            								foreach($list_source as $row)
            								{
            									?>
            									<option value="<?php echo $row['id']?>"> <?php echo $row['name']?> </option>
            									<?
            								}
            								?>
            
            				</select>
            				
            				</span>
            			   <? 
            			}
            			else
            			{
            				?>
            				<span>
            				<input type="text" value="<?php echo 'N/A';?>" id="tttttt" disabled=""/>
            				</span>
            				<?
            			}
            			?>
                    
                    </div>
                    <div style="height:25px; padding-bottom: 10px;">
            			<span style="margin-right: 30px;text-align: right;width:107px;float:left">Campaign:</span>
            			<span><input type="text" value="<?php echo $list_detail['campaign']?>" id="id_title_lead" disabled=""/></span>
                    </div>
                    <div style="height:25px; padding-bottom: 10px;">
            			<span style="margin-right: 30px;text-align: right;width:107px;float:left">Referred by:</span>
            			<span>
            			<input type="text" value="<?php echo $list_detail['referredby']?>" id="id_referredby_lead"disabled="" />
            			</span>
                    </div>
                    <div style="height:25px; padding-bottom: 10px;">
            			<span style="margin-right: 30px;text-align: right;width:107px;float:left;">Account Manager:</span>
            			<span>
            			 <?php 
                         $one_user = User::model()->findByAttributes(array('id'=>$list_detail['userid']));
                         $group_no = Yii::app()->user->getState('group_no');
                            if(($group_no=='admin'||$group_no=='superadmin' || $group_no=='manager')){?>
                               
                                <?php 
                                    $list = array();
                                    $list[''] = "N/A";
                                    $list_user_cs =  User::model()->findAll();
                                    foreach($list_user_cs as $temp){
                                        if($temp['group_id'] > 0){
                                            $list[$temp['id']] =  $temp['name'];
                                        }
                                    }
                                    echo CHtml::dropDownList('edit_cus_am_user','',$list,array("disabled"=>"disabled",'options'=>array($one_user['id']=>array('selected'=>true)))); 
                                ?>
                                <span style="" id="box_edit_account_manager_cs"><a id="edit_account_manager_cs" onclick="edit_account_manager_cs();" style="cursor: pointer;">Edit</a></span>
                                <span style="display: none;" id="box_save_account_manager_cs"><a id="save_account_manager_cs" onclick="save_account_manager_cs(<?php echo $list_detail['idlead'];?>);" style="cursor: pointer;">Save</a></span>
                            <? }else{ ?>
                                <input style="width: 204px;" size="40"class="izi_input" readonly="" type="text" value="<?php if($one_user){echo $one_user['name'];}else{echo "N/A";} ?>" id="edit_cus_am_user" name="edit_cus_am_user"/>
                            <? } ?>
            			</span>
                    </div>
                </div>
            </div>
            <div style="height: 220px;float: left; width:48%;">
                <div style="margin-top: 30px;">
                    <div style="position:absolute;margin-top:-30px;margin-left:0px">
                        <?php 
                            if($list_detail['status']=='1')
                            {
                                ?>
                                    <span style="border:solid 1px gray; color:green;padding:3px 7px 3px 7px">T</span>
                                <?php
                            }
                         ?>
                        
                        <span style="border:solid 1px gray; color:blue;padding:3px">C<span id="id_numbercall"><?php echo $numcall;?></span></span>
                        <span style="border:solid 1px gray; color:red;padding:3px"><span id="id_ratting"><?php if($list_detail['potential_rating'] == ""){ echo "N/A";} else{echo $list_detail['potential_rating'];}?></span></span>
                        <input type="hidden" id="id_number_call" value="<?php echo $list_detail['number_call']?>"/>
                        <input type="hidden" id="id_number_conversation" value="<?php echo $list_detail['number_conversation']?>"/>
                        <input type="hidden" id="id_potential_rating" value="<?php echo $list_detail['potential_rating']?>"/>
                        <input type="hidden" id="id_number_voicemail" value="<?php echo $list_detail['number_voicemail']?>"/>
                    </div>
                    <div style="height:25px; padding-bottom: 10px;">
            			<span style="margin-right: 30px;text-align: right;width:100px;float:left">Phone:</span>
            			<span >
            			<input type="text" value="<?php echo $list_detail['phone']?>" id="id_phone_lead" disabled="" />
            			</span>
                    </div>
                    <div style="height:25px; padding-bottom: 10px;">
                        <span style="margin-right: 30px;text-align: right;width:100px;float:left;">Address:</span>
                        <span >
                        <input type="text" value="<?php echo $list_detail['address']?>" id="id_lane_lead" disabled="" />
                         </span>
                    </div>
            		<div style="height:25px; padding-bottom: 10px;">
            			<span style="margin-right: 30px;text-align: right;width:100px;float:left">Country:</span>
            			<span>
            				<?php 
            					$list = array();
            					$list[''] = "Select Country";
                                
                                $conditionArr = array(
                                                'condition' => 'fg = 1',
                                                'order'=>'country ASC');
                                $listcountry = VCountryPrefix::model()->findAll($conditionArr);   
            					foreach($listcountry as $temp){
            						$list[$temp['id_country']] = $temp['country'].' ( '.$temp['id_country'].' )';
            					}
            					echo CHtml::dropDownList('id_country_lead',$list_detail['country'],$list,array('disabled'=>true,'onChange'=>"changecountry();",'style'=>'width: 205px;'));
            				?>
            			</span>
                    </div>
                    <div style="height:25px; padding-bottom: 10px;">
            			<span style="margin-right: 30px;text-align: right;width:100px;float:left">City:</span>
            			<span>
            				<?php 
            				$list = array();
            				$list[''] = "Select City";
            				$liststate = CsCity::model()->findAllByAttributes(array('id_country'=>$list_detail['country']));
            				foreach($liststate as $temp){
            					$list[$temp['name_short']] = $temp['name_long'];
            				}
            				echo CHtml::dropDownList('id_city_lead',$list_detail['city'],$list,array('disabled'=>true,'style'=>'width: 205px;'));
            				?>
            				<span id="idwaiting_city_edit_lead"></span>
            			</span>
                    </div>
                    <div style="height:25px; padding-bottom: 10px;">
            			<span style="margin-right: 30px;text-align: right;width:100px;float:left">State:</span>
            			<span>
            				<?php 
            				$list = array();
            				$list[''] = "Select State";
            				$liststate = CsState::model()->findAllByAttributes(array('id_country'=>$list_detail['country']));
            				foreach($liststate as $temp){
            					$list[$temp['name_short']] = $temp['name_long'];
            				}
            				echo CHtml::dropDownList('id_state_lead',$list_detail['state'],$list,array('disabled'=>true,'style'=>'width: 205px;'));
            				?>
            				<span id="idwaiting_state_edit_lead"></span>
            			</span>
                    </div>
                    <div style="height:25px; padding-bottom: 10px;">
            			<span style="margin-right: 30px;text-align: right;width:100px;float:left">Email:</span>
            			<span>
            			<input type="text" value="<?php echo $list_detail['email']?>" id="id_email_lead" disabled="" />
            			</span>
                    </div>
                    <div style="height:25px; padding-bottom: 10px;">
            			<span style="margin-right: 30px;text-align: right;width:100px;float:left">Current use:</span>
            			<span>
                              <span id="box_current_use">
                    			  <input type="text" value="<?php if($v_current_use) { echo $v_current_use['description'] ; } ?>" id="id_others_lead" disabled=""/>
                              </span>
                              <span>
                                  <a id="btn_edit_current_use"  onclick="edit_current_use(<?php echo $idlead; ?>);" >Edit</a>
                                  <a id="btn_save_current_use" hidden="" onclick="save_current_use(<?php echo $idlead; ?>);" >Save</a> 
                              </span>
            			</span>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <!-- END LEAD DETAIL -->
        <!-- OPPORTUNITY -->
        <div><hr style="background-color: gray  ;opacity:0.5;"  /></div>
        <div>
            <input type="hidden" value="1" id="lenxuong2" />
            <span style="margin-left: 5px;" id="id_up2"><img src="images/down.png" height="10px" width="15px" /></span>
            <span onclick="toogle_leaddetail('id_hist','2')" style="font-size: 11pt;font-weight: bold;color: #5C2B95;cursor: pointer;">Opportunity</span>
        </div>
        <div id="id_hist" style="overflow:auto;margin-top: 10px;margin-right:5px;margin-bottom: 10px;">
            <table bgcolor="#98aec0" cellpadding="2" cellspacing="1" width="100%"  style="border-spacing: 1px;"  >
                <tbody >
                    <tr style="background-color: #bca8d2;color: #5c2b95;" class="table_title" >
                        <td style="text-align: center;"><strong>No.</strong></td>
                        <td style="text-align: center;"><strong>Product Type</strong></td>
                        <td style="text-align: center;"><strong>Product</strong></td>
                        <td style="text-align: center;"><strong>Opportunity</strong></td>
                        <td style="text-align: center;"><strong>Action</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="clear"></div>
        <hr style="background-color: gray  ;opacity:0.5;" />
        <!-- END OPPORTUNITY -->
        <!-- ACTION -->
        <div>
            <input type="hidden" value="1" id="lenxuong3" />
            <span style="margin-left: 5px;" id="id_up3"><img src="images/down.png" height="10px" width="15px" /></span>
            <span onclick="toogle_leaddetail('id_action','3')" style="font-size: 11pt;font-weight: bold;color: #5C2B95;cursor: pointer;">Action</span>
        </div>
        <div id="id_action" >
            <?php if($list_detail['status']==0){ ?>
            <div style="display: block;" id="box_action" >
                <div style="margin-top:-5px;margin-left:0px">
                    <input  type="checkbox" id="id_checkcall" onclick="check_conver()" checked="" name="checkcall"/>Check if this is a Call out
                </div>
                <div style="margin-top:5px;margin-left:0px">
                    <span>Status:</span> 
                    <select id="id_checkconversation" name="checkconversation">
            			<option value="0" selected>Answer</option>
            			<option value="1" >No Answer</option>
            			<option value="2" >Voicemail</option>
            			<option value="3" >Wrong Number</option>
            			<option value="4" >Answer But No Talk</option>
              		</select>
                </div>
                <div style="margin-left: 10px;margin-top:5px;">
                    <span><button id="btn_convertaccount" onclick="Update_numbercall();action_convertaccount('<?php echo $idlead?>')">Convert to Account</button></span>
                    <span><button id="btn_addschedule"onclick="view_action_addschedule()">Add Schedules</button></span>
                    <span><button id="btn_holdlead" onclick="view_action_holdlead()">Add to Hold Lead</button></span>
                    <span><button id="btn_reportsmanager" onclick="view_action_report()">Report to Manager</button></span>
                    <span><button id="btn_del_request" onclick="view_action_del_request()">Sent Delete Request</button></span>
                </div>
                <div style="margin-top:5px;display: none;" class="list_referto" id="id_addschedule"></div>
                <div style="margin-top:5px;display: none;" class="list_referto" id="id_holdlead"></div>
                <div style="margin-top:5px;display: none;" class="list_referto" id="id_reportsmanager"></div>
                <div style="margin-top:5px;display: none;" class="list_referto" id="id_del_request"></div>
            </div>
            <? }else if($list_detail['status']==1){ ?>
            <div style="display: block;" >
                <div style="margin-top:-5px;margin-left:0px">
                    <input type="checkbox" id="id_checkcall" onclick="check_conver()" checked="" name="checkcall"/>Check if this is a Call out
                </div>
                <div style="margin-top:5px;margin-left:0px">
                    <input type="checkbox" id="id_checkconversation" name="checkconversation"/>Check if this is a conversation
                </div>
                <div style="margin-left: 10px;margin-top:5px;">
                    <span><button id="btn_convertaccount" onclick="Update_numbercall();action_refillaccount()">Refill Account</button></span>
                    <span><button id="btn_addschedule"onclick="view_action_addschedule()">Add Schedules</button></span>
                    
                    <span><button id="btn_holdlead" onclick="view_action_holdlead()">Add to Hold Lead</button></span>
                    <span><button id="btn_reportsmanager" onclick="view_action_report()">Report to Manager</button></span>
                    <span><button id="btn_del_request" onclick="view_action_del_request()">Sent Delete Request</button></span>
                </div>
                <div style="margin-top:5px;display: none;" class="list_referto" id="id_addschedule"></div>
                <div style="margin-top:5px;display: none;" class="list_referto" id="id_holdlead"></div>
                <div style="margin-top:5px;display: none;" class="list_referto" id="id_reportsmanager"></div>
                <div style="margin-top:5px;display: none;" class="list_referto" id="id_del_request"></div>
            </div>
            <? } else if($list_detail['status']==2){$info_holdlead=$model->get_info_actionlead($idlead,'2');?>
            <div class="list_referto" style="padding: 10px 10px 10px 30px;width:93%;" >
                <div style="height:25px">
                    <span style="margin-right: 30px;text-align: right;width:100px;float:left">Move by : </span> 
                    <span><input type="text" value="<?php echo $info_holdlead['username']?>" readonly="" /></span>
                </div>
                <div style="height:25px">
                    <span style="margin-right: 30px;text-align: right;width:100px;float:left">Moved date : </span> 
                    <span><input type="text" value="<?php echo $info_holdlead['move_date']?>" readonly="" /></span>
                </div>
                <div id="id_returndate_real" style="height:25px">
                    <span style="margin-right: 30px;text-align: right;width:100px;float:left">Returned day : </span>
                    <span onmouseover="$('#id_edit_returndate').css({display: 'block'});" onmouseout="$('#id_edit_returndate').css({display: 'none'});">
                        <input type="text" value="<?php echo $info_holdlead['return_date']?>" readonly="" id="id_k_returndate" />
                        <div id="id_edit_returndate" class="edit_style">
                            <a onclick="$('#id_returndate_real').css({display: 'none'});$('#id_returndate_virtual').css({display: 'block'});" href="javascript:" >Edit</a>
                        </div>
                    </span>
                </div>
                <div id="id_returndate_virtual"  style="height: 50px;display: none;">
                    <span style="margin-right: 30px;text-align: right;width:100px;float:left">Returned day : </span>
                    <span>
                        <input readonly="" type="text" value="<?php echo $info_holdlead['return_date']?>" id="edit_returndate" name="edit_returndate"/><br />
                        <span style="margin-left: 155px;">
                            <button class="button_save" onclick="update_returndate('<?php echo $idlead?>')">save</button> or
                            <a onclick="$('#id_returndate_real').css({display: 'block'});$('#id_returndate_virtual').css({display: 'none'});" href="javascript:">Cancel</a>
                        </span>
                    </span>
                </div>
                <div style="margin-top: 10px;">
                    <span style="margin-left: 190px;"><button id="btn_returnnow"onclick="return_rawlead('<?php echo $idlead?>')">Returned now</button></span> 
                    <span><button id="btn_backtolead" onclick="view_action_assigntoagent()">Assign to Agent</button></span>
                </div>
                <div style="margin-top:5px;display: none;" class="list_referto" id="id_assigntoagent"></div>
            </div>
            <? }else if($list_detail['status']==3){?>
            <div>
                <div style="margin-top:-5px;margin-left:0px;display: none;">
                    <input type="checkbox" id="id_checkcall" disabled="" name="checkcall"/>Check if this is a Call out
                </div>
                <div style="margin-left: 10px;margin-top:5px;">
                    <span><button id="btn_approverequest" onclick="approve_request('<?php echo $idlead?>')">Approve Request</button></span>
                    <span><button id="btn_holdlead" onclick="view_action_holdlead();">To Hold Lead</button></span>
                    <span><button id="btn_backtolead" onclick="view_action_assigntoagent()">Assign to Agent</button></span>
                </div>
                <div style="margin-top:5px;display: none;" class="list_referto" id="id_holdlead"></div>
                <div style="margin-top:5px;display: none;" class="list_referto" id="id_assigntoagent"></div>
            </div>
            <? } else if($list_detail['status']==4){ ?>
            <div>
                <div style="margin-left: 10px;margin-top:5px;">
                    <span><button id="btn_backtolead" onclick="view_action_backtolead()">Return back to Agent</button></span>
                    <span><button id="btn_backtolead" onclick="view_action_assigntoagent()">Assign to Agent</button></span>
                    <span><button id="btn_holdlead" onclick="view_action_holdlead();">To Hold Lead</button></span>
                    <span><button id="btn_approverequest" onclick="approve_request('<?php echo $idlead?>')">Delete Directly</button></span>
                </div>
                <div style="margin-top:5px;display: none;" class="list_referto" id="id_backtolead"></div>
                <div style="margin-top:5px;display: none;" class="list_referto" id="id_assigntoagent"></div>
                <div style="margin-top:5px;display: none;" class="list_referto" id="id_holdlead"></div>
            </div>
            <? } ?>
        </div>
        <!-- END ACTION -->
    </div>
</div>
<script>
search_opp_detail(1,<?php echo $idlead?>);
$(function() {
		$( "#edit_returndate" ).datepicker({
			changeMonth: true,
			changeYear: true,
            dateFormat: 'yy-mm-dd'

		});
	});/**/
 function check_conver()
 {
    if($('input[name=checkcall]').is(':checked'))
    {
        $('#id_checkconversation').removeAttr('disabled');
    }
    else{
        $('#id_checkconversation').removeAttr('checked');
        $('#id_checkconversation').attr('disabled','true');
    }
 }
 function changecountry(){
	var country = $("#id_country_lead").val();
	jQuery("#idwaiting_city_edit_lead").html("<img src='<?php echo Yii::app()->request->baseUrl.'/images/vtbusy.gif';?>' alt='waiting.....' />");
	jQuery("#idwaiting_state_edit_lead").html("<img src='<?php echo Yii::app()->request->baseUrl.'/images/vtbusy.gif';?>' alt='waiting.....' />");
	jQuery.ajax({ type:"POST",
                    url:"<?php echo CController::createUrl('lead/ajax_state1');?>&idcountry=" + country,
                    success:function(html){
                         jQuery("#id_state_lead").html(html);
						 jQuery("#idwaiting_state_edit_lead").html("");
                    }
                      });
	jQuery.ajax({ type:"POST",
                    url:"<?php echo CController::createUrl('pinless/ajax_city');?>&idcountry=" + country,
                    success:function(html){
                         jQuery("#id_city_lead").html(html);
						 jQuery("#idwaiting_city_edit_lead").html("");
                    }
                      });
 }
function vieweditlead()
{
    jQuery("#id_editinfo").css({'display':'none'});
    jQuery("#id_saveeditinfo").css({'display':'block'});
    jQuery("#id_company_lead").removeAttr('disabled');
    jQuery("#id_firstname_lead").removeAttr('disabled');
    jQuery("#id_lastname_lead").removeAttr('disabled');
    jQuery("#id_birthday_lead").removeAttr('disabled');
    jQuery("#id_gender_lead").removeAttr('disabled');
    jQuery("#id_title_lead").removeAttr('disabled');
    jQuery("#id_referredby_lead").removeAttr('disabled');
    //jQuery("#id_phone_lead").removeAttr('disabled');
    jQuery("#id_lane_lead").removeAttr('disabled');
    jQuery("#id_city_lead").removeAttr('disabled');
    jQuery("#id_state_lead").removeAttr('disabled');
    jQuery("#id_country_lead").removeAttr('disabled');
    jQuery("#id_email_lead").removeAttr('disabled');
    jQuery("#btn_convertaccount").attr('disabled',true);
    jQuery("#btn_addschedule").attr('disabled',true);
    jQuery("#btn_del_request").attr('disabled',true);
    jQuery("#btn_holdlead").attr('disabled',true);
    jQuery("#btn_reportsmanager").attr('disabled',true);
    //jQuery("#id_others_lead").removeAttr('disabled');
    
    
}
function hideeditlead()
{
    jQuery("#id_editinfo").css({'display':'block'});
    jQuery("#id_saveeditinfo").css({'display':'none'});
    jQuery("#id_company_lead").attr('disabled','true');
    jQuery("#id_firstname_lead").attr('disabled','true');
    jQuery("#id_lastname_lead").attr('disabled','true');
    jQuery("#id_birthday_lead").attr('disabled','true');
    jQuery("#id_gender_lead").attr('disabled','true');
    jQuery("#id_title_lead").attr('disabled','true');
    jQuery("#id_referredby_lead").attr('disabled','true');
    //jQuery("#id_phone_lead").attr('disabled','true');
    jQuery("#id_lane_lead").attr('disabled','true');
    jQuery("#id_city_lead").attr('disabled','true');
    jQuery("#id_state_lead").attr('disabled','true');
    jQuery("#id_country_lead").attr('disabled','true');
    jQuery("#id_email_lead").attr('disabled','true');
    jQuery("#btn_convertaccount").removeAttr('disabled');
    jQuery("#btn_holdlead").removeAttr('disabled');
    jQuery("#btn_reportsmanager").removeAttr('disabled');
    jQuery("#btn_del_request").removeAttr('disabled');
    jQuery("#btn_addschedule").removeAttr('disabled');
    //jQuery("#id_others_lead").attr('disabled','true');
    
}
function Update_numbercall()//insert hist_callout, update number_call
{
    var leadid = jQuery("#txt_idlead").val();
    //var number_call=$('#id_number_call').val();
    var number_conversation=$('#id_number_conversation').val();
	var status = $('#id_checkconversation').val();
	var call_tyle=0;
    if($('input[name=checkcall]').is(':checked'))
    {
        call_tyle = 1;
    }   
        
	jQuery.ajax({ type:"POST",
                url:" <?php echo CController::createUrl('lead/update_numbercall')?>&leadid="+leadid+
                                                                                "&call_tyle="+call_tyle+
                                                                                "&status="+status,
                success:function(html){
                    
                }
                  });
}
function view_action_addschedule()
{
    var leadid = jQuery("#txt_idlead").val();
    var flag = jQuery("#txt_idflag").val();
    var number_call=$('#id_number_call').val();
    var number_conversation=$('#id_number_conversation').val();
    var number_voicemail=$('#id_number_voicemail').val();
    var dis_voimail=0;
    $('#id_checkconversation').attr('disabled','true');
    $('#id_checkcall').attr('disabled','true');
    var hist_number_call=0;
    var hist_number_conversation=0;
    if($('input[name=checkcall]').is(':checked'))
    {
        number_call=parseInt(number_call)+1;
        dis_voimail=1;
        hist_number_call=1;
        
    }
    if($('input[name=checkconversation]').is(':checked'))
    {
        dis_voimail=0;
        number_conversation=parseInt(number_conversation)+1;
        hist_number_conversation=1;
        
    }
    jQuery("#id_addschedule").slideDown();
    jQuery("#btn_convertaccount").attr('disabled',true);
    jQuery("#btn_holdlead").attr('disabled',true);
    jQuery("#btn_reportsmanager").attr('disabled',true);
    jQuery("#btn_del_request").attr('disabled',true);

    
     jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('lead/addschedule')?>&id_lead="+leadid+"&number_call="+number_call+"&flag="+flag+
                                                                                "&dis_voimail="+dis_voimail+
                                                                                "&number_voicemail="+number_voicemail+
                                                                                "&hist_number_call="+hist_number_call+
                                                                                "&hist_number_conversation="+hist_number_conversation+
                                                                                "&number_conversation="+number_conversation,
                    success:function(html){
                         jQuery("#id_addschedule").html(html);
                         if(dis_voimail==0)
                            $('#chk_voicemail').attr('disabled','true');
                         else
                            jQuery("#chk_voicemail").removeAttr('disabled');
                    }
                      });

}
function view_action_holdlead()
{
    var leadid = jQuery("#txt_idlead").val();
    var number_call=$('#id_number_call').val();
    $('#id_checkcall').attr('disabled','true');
    $('#id_checkconversation').attr('disabled','true');
    var hist_number_call=0;
    var hist_number_conversation=0;
    if($('input[name=checkcall]').is(':checked'))
    {
        number_call=parseInt(number_call)+1;
        hist_number_call=1;
    }
    var number_conversation=$('#id_number_conversation').val();
    if($('input[name=checkconversation]').is(':checked'))
    {
        number_conversation=parseInt(number_conversation)+1;
        hist_number_conversation=1;
    }
        
    jQuery("#id_holdlead").slideDown();
    jQuery("#btn_convertaccount").attr('disabled',true);
    jQuery("#btn_addschedule").attr('disabled',true);
    jQuery("#btn_reportsmanager").attr('disabled',true);
    jQuery("#btn_del_request").attr('disabled',true);
    jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('lead/addholdlead')?>&id_lead="+leadid+
                                                                            "&number_call="+number_call+
                                                                            "&hist_number_call="+hist_number_call+
                                                                            "&hist_number_conversation="+hist_number_conversation+
                                                                            "&number_conversation="+number_conversation,
                    success:function(html){
                         jQuery("#id_holdlead").html(html);
                    }
                      });
}
function view_action_del_request()
{
    var leadid = jQuery("#txt_idlead").val();
    var number_call=$('#id_number_call').val();
    $('#id_checkcall').attr('disabled','true');
    $('#id_checkconversation').attr('disabled','true');
    
        
    jQuery("#id_del_request").slideDown();
    jQuery("#btn_convertaccount").attr('disabled',true);
    jQuery("#btn_holdlead").attr('disabled',true);
    jQuery("#btn_reportsmanager").attr('disabled',true);
    jQuery("#btn_addschedule").attr('disabled',true);
    //jQuery("#btn_del_request").attr('disabled',true);
        jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('lead/addrequestlead')?>&id_lead="+leadid+
                                                                                    "&number_call="+number_call,
                    success:function(html){
                         jQuery("#id_del_request").html(html);
                    }
                      });
}
function action_convertaccount(idlead)
{
    var firstname_lead = jQuery("#id_firstname_lead").val();
    var lastname_lead = jQuery("#id_lastname_lead").val();
    var phone_lead = jQuery("#id_phone_lead").val();
    var lane_lead = jQuery("#id_lane_lead").val();
    var city_lead = jQuery("#id_city_lead").val();
    var state_lead = jQuery("#id_state_lead").val();
    var country_lead = jQuery("#id_country_lead").val();
    var email_lead = jQuery("#id_email_lead").val();
    var source =jQuery("#id_birthday_lead").val();
    if(!source) source=10;
    //jAlert(phone_lead);
    //return ;
    jQuery('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="waiting....." />');
    var url_r="<?php echo CController::createUrl('pinless/newaccount')?>&edit_lead_phone="+phone_lead+
                                                                                    "&edit_lead_lastname="+lastname_lead+
                                                                                    "&edit_lead_firstname="+firstname_lead+
                                                                                    "&edit_lead_address="+lane_lead+
                                                                                    "&edit_lead_city="+city_lead+
                                                                                    "&edit_lead_state="+state_lead+
                                                                                    "&edit_lead_country="+country_lead+
                                                                                    "&edit_lead_email="+email_lead+
                                                                                    "&edit_lead_source="+source+
                                                                                    "&idlead="+idlead;
   
   //var url_r="<?php echo CController::createUrl('pinless/newaccount')?>";
    //jAlert(url);
    //return;
   changecolor('newaccount');
   //jAlert('https://crm.iziring.com/'+url_r);
   //return;
  
   jQuery.ajax({ type:"POST",
                    url:url_r,
                    success:function(data){
                         jQuery('#content_body').html(data);
                         jQuery('#idwaiting_main').html('');
                    }
                      });
					  
					  
					  
   /*
   jQuery.ajax({'beforeSend':function( request ) 
                {                                                
                       jQuery('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="waiting....." />');
                  }
                  ,'success':function( data )
                  {
                       jQuery('#content_body').html(data);
                       jQuery('#idwaiting_main').html('');
                                                                            
                  },'url':"<?php echo CController::createUrl('pinless/newaccount')?>&edit_lead_firstname="+firstname_lead+
                                                                                    "&edit_lead_lastname="+lastname_lead+
                                                                                    "&edit_lead_phone="+phone_lead+
                                                                                    "&edit_lead_address="+lane_lead+
                                                                                    "&edit_lead_city="+city_lead+
                                                                                    "&edit_lead_state="+state_lead+
                                                                                    "&edit_lead_country="+country_lead+
                                                                                    "&edit_lead_email="+email_lead+
                                                                                    "&edit_lead_source="+source+
                                                                                    "&idlead="+idlead
                  ,'cache':false
              });return false;
              /**/
}
function action_refillaccount()
{
    var phone_lead = jQuery("#id_phone_lead").val();
   changecolor('searchcustomer');
   jQuery.ajax({'beforeSend':function( request ) 
                {                                                
                       jQuery('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="waiting....." />');
                  }
                  ,'success':function( data )
                  {
                       jQuery('#content_body').html(data);
                       jQuery('#idwaiting_main').html('');
                                                                            
                  },'url':"<?php echo CController::createUrl('pinless/searchcustomer')?>&phone_new="+phone_lead
                  ,'cache':false
              });return false;
}/**/
function action_cancel()
{
    jQuery("#btn_convertaccount").removeAttr('disabled');
    jQuery("#btn_holdlead").removeAttr('disabled');
    jQuery("#btn_reportsmanager").removeAttr('disabled');
    jQuery("#btn_del_request").removeAttr('disabled');
    jQuery("#btn_addschedule").removeAttr('disabled');
    /*jQuery("#id_addschedule").css({"display":"none"});
    jQuery("#id_holdlead").css({"display":"none"});
    jQuery("#id_reportsmanager").css({"display":"none"});
    jQuery("#id_del_request").css({"display":"none"});*/
    jQuery("#id_addschedule").slideUp();
    jQuery("#id_holdlead").slideUp();
    jQuery("#id_reportsmanager").slideUp();
    jQuery("#id_del_request").slideUp();
    $('#id_checkcall').removeAttr('disabled');
    $('#id_checkconversation').removeAttr('disabled');
    
}
function action_cancel2()
{
   jQuery("#id_backtolead").slideUp(); 
   jQuery("#id_assigntoagent").slideUp();
}
function save_edit_infolead(idlead)
{
    jQuery('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="waiting....." />');
    var company_lead = jQuery("#id_company_lead").val();
    var firstname_lead = jQuery("#id_firstname_lead").val();
    var lastname_lead = jQuery("#id_lastname_lead").val();
    var birthday_lead = jQuery("#id_birthday_lead").val();
    var gender_lead = jQuery("#id_gender_lead").val();
    var title_lead = jQuery("#id_title_lead").val();
    var referredby_lead = jQuery("#id_referredby_lead").val();
    var phone_lead = jQuery("#id_phone_lead").val();
    var lane_lead = jQuery("#id_lane_lead").val();
    var city_lead = jQuery("#id_city_lead").val();
    var state_lead = jQuery("#id_state_lead").val();
    var country_lead = jQuery("#id_country_lead").val();
    var email_lead = jQuery("#id_email_lead").val();
    var others_lead = jQuery("#id_others_lead").val();
    var urlt="<?php echo CController::createUrl('lead/editinformation_lead')?>"+
                                                                "&idlead="+idlead+
                                                                "&edit_lead_firstname="+firstname_lead+
                                                                "&edit_lead_lastname="+lastname_lead+
                                                                "&edit_lead_birthday="+birthday_lead+
                                                                "&edit_lead_gender="+gender_lead+
                                                                "&edit_lead_company="+company_lead+
                                                                "&edit_lead_title="+title_lead+
                                                                "&edit_lead_referredby="+referredby_lead+
                                                                "&edit_lead_phone="+phone_lead+
                                                                "&edit_lead_address="+lane_lead+
                                                                "&edit_lead_city="+city_lead+
                                                                "&edit_lead_state="+state_lead+
                                                                "&edit_lead_country="+country_lead+
                                                                "&edit_lead_email="+email_lead+
                                                                "&edit_lead_others="+others_lead+"&idlead="+idlead;                                                
    jQuery.ajax({ type:"POST",
                url:urlt,
                success:function(html){
                     jQuery("#idwaiting_main").html("");
                      var arr_list = html.split("|");
					  if(arr_list[0] == ""){
						jQuery("#id_firstname_row_"+idlead).html("<a href='javascript:void(0)' onclick=\"view_information_lead('"+idlead+"')\">N/A</a>");
					}
					else{
						jQuery("#id_firstname_row_"+idlead).html("<a href='javascript:void(0)' onclick=\"view_information_lead('"+arr_list[0]+"')\">N/A</a>");
					}
                     jQuery("#id_lastname_row_"+idlead).html(arr_list[1]);
                     jQuery("#id_phone_row_"+idlead).html(arr_list[4]);
                     if(arr_list[5])
                        jQuery("#id_referredby_row_"+idlead).html(arr_list[5]);
                     else jQuery("#id_referredby_row_"+idlead).html('N/A');
                     view_information_lead(idlead);
                }
                  });
}
function update_returndate(idlead)
{
    var return_date=$('#edit_returndate').val();
    jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('lead/update_returndate')?>&idlead="+idlead+"&return_date="+return_date,
                    success:function(html){
                        $('#id_returndate_virtual').css({display: 'none'});
                        jQuery("#id_k_returndate").val(html);
                        $('#id_returndate_real').css({display: 'block'});
                    }
                      });
}
function return_rawlead(idlead)
{
    jConfirm('Are you sure to Return this lead now?', 'Notification', function(r)
   {
        if(r)
        {
            jQuery.ajax({ type:"POST",
                                url:"<?php echo CController::createUrl('lead/return_rawlead')?>&idlead="+idlead,
                                success:function(html){
                                    jQuery("#id_view_cusinfo").slideUp();
                                    $('#id_row_info1_'+idlead).remove();
                                }
                                  });
        }
   });

}
function view_action_backtolead()
{
    var leadid = jQuery("#txt_idlead").val();
    jQuery("#id_backtolead").slideDown();
    jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('lead/backtolead')?>&idlead="+leadid,
                    success:function(html){
                         jQuery("#id_backtolead").html(html);
                    }
                });
}
function view_action_assigntoagent()
{
    var leadid = jQuery("#txt_idlead").val();
    jQuery("#id_assigntoagent").slideDown();
    jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('lead/assigntoagent')?>&idlead="+leadid,
                    success:function(html){
                         jQuery("#id_assigntoagent").html(html);
                    }
                });
}
function view_action_report()
{
    
    var leadid = jQuery("#txt_idlead").val();
    var number_call=$('#id_number_call').val();
    $('#id_checkcall').attr('disabled','true');
    $('#id_checkconversation').attr('disabled','true');
    var status = $('#id_checkconversation').val();
	var call_type=0;
    if($('input[name=checkcall]').is(':checked'))
    {
        call_type=1;
    }
    
        
    jQuery("#btn_holdlead").attr('disabled',true);
    //jQuery("#id_holdlead").attr('disabled',true);
    jQuery("#id_reportsmanager").slideDown();
    jQuery("#btn_convertaccount").attr('disabled',true);
    jQuery("#btn_addschedule").attr('disabled',true);
    jQuery("#btn_del_request").attr('disabled',true);
    jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('lead/reporttomanager')?>&leadid="+leadid+
                                                                                    "&number_call="+number_call,
                    success:function(html){
                         jQuery("#id_reportsmanager").html(html);
                    }
                });
}

function toogle_leaddetail(id,index)
{
    $("#"+id).slideToggle('slow',function () {
        if($("#lenxuong"+index).val()=='1')
        {
            jQuery("#id_up"+index).html("<img class='xoay_img2' src='images/down.png' height='10px' width='15px' />");
            $("#lenxuong"+index).val(0);
        }     
        else
        {
            jQuery("#id_up"+index).html("<img  src='images/down.png' height='10px' width='15px' />");
            $("#lenxuong"+index).val(1);
        }
    });
}

function approve_request(idlead)
{
    jConfirm('Are you sure ?', 'Notification', function(r)
   {
        if(r)
        {
            jQuery.ajax({ type:"POST",
                            url:" <?php echo CController::createUrl('lead/approve_request')?>&idlead="+idlead,
                            success:function(html){
                                 jQuery("#id_view_cusinfo").slideUp();
                                    $('#id_row_info1_'+idlead).remove();
                            }
                        });
   }
   });
}
</script>