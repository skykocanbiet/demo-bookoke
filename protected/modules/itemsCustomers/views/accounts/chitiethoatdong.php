<style type="text/css">
	.quantrong td{
		background-color: #fdc4c9 !important;
	}
	.sss td a{
		display: none;
	}
	.sss:hover td a{
		display: block;
	}
</style>
<div id="editnote" class="modal fade" role="dialog">
</div>
<?php
/*print_r($model);
exit(); */
//$id = $model->id;
$data = CustomerNote::model()->findAllByAttributes(array("id_customer"=>$data));
 if(!empty($data))
        { 

foreach($data as $k=> $value){
          ?>
<tr class="sss <?php if($value['important'] == 1){echo 'quantrong';} ?>" >
					
					<td style="width:15%;"> 
						<?php echo $value['create_date'] ?>
					</td>
					
					<td style="width:50%;">
						
	                     <?php if($value['flag']==0)
	                     { 
	                     	echo "<b>Ghi chú:</b> ";
	                     }
	                     elseif ($value['flag']==1) 
	                     { 
	                     	echo "<b>lịch hẹn:</b> ";
	                     	# code...
	                     } 
	                     elseif ($value['flag']==2) 
	                     { echo "<b>Báo giá:</b> ";
	                     	# code...
	                     }
	                     elseif ($value['flag']==3) 
	                     { 
	                     	echo "<b>Điều trị:</b> ";
	                     	# code...
	                     }
	                      elseif ($value['flag']==4) 
	                     { 
	                     	echo "<b>Phàn nàn:</b> ";
	                     	# code...
	                     }
	                     elseif ($value['flag']==5) 
	                     { 
	                     	echo "<b>Tiềm năng:</b> ";
	                     	# code...
	                     } echo $value['note'] ?>
	                  
					</td>
					
					
					<td style="width:15%;"> 
						<?php $name = CsLeadActivity::model()->getname($value['id_user']); echo $name['name'] ;?>
					</td>
					<td style="width: 15%;">
						<?php 
							if($value['status']==1)
		                     { 
		                     	echo "Ghi nhận";
		                     }
		                     elseif ($value['status']==2) 
		                     { 
		                     	echo "Đang giải quyết ";
		                     	# code...
		                     } 
		                     elseif ($value['status']==3) 
		                     { echo "Hoàn tất ";
		                     	# code...
		                     }
		                     elseif ($value['status']==-1) 
		                     { echo "Hủy ";
		                     	# code...
		                     }
	                     ?>
					</td>
					<td style="width:5%;">
						<a href="#" onclick="editnote(<?php echo $value['id'] ?>)">
							<img src="<?php echo yii::app()->request->baseUrl; ?>/images/icon_sb_left/edit_cam.png" style="width:18px; height: 18px;">
						</a>
					</td>
					 	
					
</tr>
<?php }
}else{
	?>
<tr>
	<td colspan="4" style="text-align: center;">
		Không có dữ liệu hiển thị!
	</td>
</tr>
<?php 
}

 ?>
 
 	
 </div>
 <script type="text/javascript">
 	function editnote(id){
 		$.ajax({
            type:'POST',
            url: baseUrl+'/itemsCustomers/Accounts/editnote',   
            data: {"id":id},   

            success:function(data){ 

                  
                    $('#editnote').html(data);
                    $("#editnote").modal();
                    /*$(function(){
					    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
					    $('.num').autoNumeric('init',numberOptions);
					});*/
                         
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
 	}
 </script>
 