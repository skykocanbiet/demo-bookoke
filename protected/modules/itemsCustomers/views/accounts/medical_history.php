<tr style="display:none;">
	<td id="check_change_status_process">
		<?php echo $model->checkChangeStatusProcess($model->id);?>
	</td>
	<td id="check_add_new_treatment">
		<?php echo $model->checkAddNewTreatment($model->id);?>
	</td>	
</tr>

<?php
$listTreatmentProcess = $model->getListTreatmentProcessOfCustomer($id_mhg);
if(count($listTreatmentProcess)){	
	$sum = count($listTreatmentProcess);
	foreach($listTreatmentProcess as $k => $v){
	$turn = $sum-$k;		
	?>
	<tr data-toggle="collapse" data-target="#TreatmentProcess<?php echo $k+1;?>" class="accordion-toggle" style="cursor:pointer;background-color: <?php if(($k+1) % 2 == 1){ echo "#fff";} else{ echo "#F2F2F2";}?>;">
	    <td><?php echo $turn;?></td>
	    <td>BS. <?php echo $v['gp_users_name'];?></td>
	    <td><?php echo $v['name'];?></td>	
	    <td><?php echo $v['description'];?></td>    
	    <td><?php if($v['id_prescription']) echo '<i class="fa fa-file-text-o" onclick="viewPrescriptionAndLab('.$v['id'].',1);"></i>'; else echo '<i class="fa fa-file-o"></i>';?></td>
	    <td><?php if($v['id_labo']) echo '<i class="fa fa-file-text-o" onclick="viewPrescriptionAndLab('.$v['id'].',2);"></i>'; else echo '<i class="fa fa-file-o"></i>';?></td>
	    <td><?php echo date('d/m/Y',strtotime($v['createdate']));?></td>	
	    <td>
            <span class="action glyphicon glyphicon-pencil pencil pencilTreatment" onclick="view_frm_treatment(<?php echo $v['id'];?>);"></span>
        </td>  
        <td>
            <span class="action trash" onclick="deleteMedicalHistory(<?php echo $v['id'];?>);"><img src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;"></span>            
        </td>  
	</tr>	
	<tr>
	    <td colspan="9" class="hiddenRow" style="text-align: left;line-height:2;">
	        <div class="accordian-body collapse oView col-md-12" id="TreatmentProcess<?php echo $k+1;?>">	       
		        <div class="oViewDetail col-md-12">
			
				      	<?php include("detail_medical_history.php");?>
			    
		        </div>
	        </div>
	    </td>
    </tr>
<?php 
	}
} ?>

<?php 
if (isset($status_success) && $status_success==1) {
	echo 	"<script>
				
				// $('li#c".$model->id." code').replaceWith('<code class=\"delete_btn status_4\">Hoàn tất</code>');

				$('li#c".$model->id." code').remove();				

				$('#appointmentList li select').each(function(){
				    if ($(this).val() == '3') {
				        $(this).val('4')
				    }
				});

		  	</script>";
}
?>
<script>
$('.accordion-toggle').click(function(){
    
    $( ".accordion-toggle" ).each(function( index ) {  
        $(this).removeClass("at");  
    });

    var st =  $(this).attr("aria-expanded");   

    if(st == 'false' || st == undefined){        
        $(this).addClass("at");
    }else if(st == 'true'){

        $(this).removeClass("at");
    } 
});

$('.collapse').on('show.bs.collapse', function () {    
    $('.collapse.in').collapse('hide');
});
</script>







