<style type="text/css">
	p{
		font-size: 14px;
	}
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 3px;
    vertical-align: top;
    padding: 10px 15px !important;
    text-align: center;
	}
	.form-horizontal .control-label {
    padding-top: 7px;
    margin-bottom: 0; 
    text-align: left;
    padding-right: 0px;
	}
	.progress {
	height: 15px;
	position: relative;
	}
	.progress-bar {
    float: left;
    width: 0;
    height: 100%;
    font-size: 12px;
    line-height: 20px;
    color: #ccc;
    text-align: right;
    background-color: #f5f5f5;
	   
	}
</style>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/autoNumeric.js"></script> 
<div style="margin: 30px 0px;">
<?php 

$cus_member = CustomerMember::model()->findByAttributes(array('id_customer'=>$id_customer));
$point = $cus_member['point']; 
?>
	<form class="form-horizontal" id="" action="" method="post">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="col-md-3 control-label">Mã thẻ:</label>
					<div class="col-md-8">
						<input type="text"  readonly  id="code_member" name="code_member" value="<?php echo $cus_member['code_member'];?>" class="form-control">
					</div>				
				</div>		   					
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label class="col-md-4 control-label">Ngày tham gia:</label>
					<div class="col-md-7">
						<input type="text" readonly  id="create_date" name="create_date" value="<?php echo date_format(date_create($cus_member['create_date']),'d-m-Y'); ?>" class="form-control">
						<input type="text" style="display: none;" id="id_customer" name="id_customer" value="<?php echo $id_customer;?>" class="form-control">

						<input type="text" style="display: none;" id="id" name="id" value="<?php echo $cus_member['id'];?>" class="form-control">
					</div>				
				</div>		   					
			</div>
			<div class="col-md-3 ">
				<div class="form-group" style="">
					<label class="col-md-3 control-label">Hạng:</label>
					<div class="col-md-9">
						<?php $id_member = $cus_member['id_member']; 
							  $member =  Member::model()->findByAttributes(array('id'=>$id_member));?>
						<input type="text" readonly  value="<?php echo $member['name']; ?>" class="form-control">
					</div>				
				</div>		   					
			</div>
			
		</div>
	</form>
	<div class="" style="position: relative;margin-top: 40px;">
	<?php
		$p_1 = Member::model()->findByAttributes(array('id'=>'1'));
		$min_1= $p_1['point_min'];
		$max_1= $p_1['point_max'];
		$p_2 = Member::model()->findByAttributes(array('id'=>'2'));
		$min_2= $p_2['point_min'];
		$max_2= $p_2['point_max'];
		$p_3 = Member::model()->findByAttributes(array('id'=>'3'));
		$min_3= $p_3['point_min'];
		$max_3= $p_3['point_max'];

		$width_1 = (($max_1-$min_1)/$max_3)*100;
		$width_2 = (($max_2-$min_2)/$max_3)*100;
		$width_3 =(($max_3-$min_3)/$max_3)*100;
		$width_p1 = ($point/$max_3)*100;
		$width_p2 = (($point/$max_3)*100)-$width_1-1;
		$width_p3 = (($point/$max_3)*100)-$width_1- $width_2-1;
		$width_p4 = ($point/$max_3)*100;
	?>
			<div style="width: 1%"></div>
			<div style="width:<?php echo $width_1;?>%; float: left;">
				<span style="font-size: 16px; color: #5e5e5e;">50</span>
			</div>
			<div style="width:<?php echo $width_2;?>%; float: left;">
				<span style="font-size: 16px; color: #5e5e5e;">300</span>
			</div>
			<div style="width: <?php echo $width_3;?>%; float: left;">
				<span style="font-size: 16px; color: #5e5e5e;">1000</span>
			</div>
			<div class="progress" style="width: 100%; ">
				<div class=" progress-bar" role="progressbar" style=" background: #E8C44F;width:1%;">
		    	</div>
	    	<?php if($point>=$min_1 && $point <$max_1){?>
	    		<div class=" progress-bar" role="progressbar" style=" background: #E8C44F;width:<?php echo $width_p1;?>%">
	    		</div>

	    	<?php }elseif($point>=$min_2 && $point <$max_2){?>
	    		<div class=" progress-bar" role="progressbar" style="width:<?php echo $width_1;?>%;background:#E8C44F;">
		    	</div>
		    	<div class=" progress-bar" role="progressbar" style=" background: #ED863A;width:<?php echo $width_p2;?>%">
	    		</div>	    	
	    	<?php }elseif($point>=$min_3 && $point <= $max_3){?>
	    		<div class=" progress-bar" role="progressbar" style="width:<?php echo $width_1;?>%;background:#E8C44F;">
		    	</div>
		    	<div class=" progress-bar" role="progressbar" style="width:<?php echo $width_2;?>%;background:#ED863A;">
		    	</div>
		    	<div class=" progress-bar" role="progressbar" style=" background: #E54242;width:<?php echo $width_p3;?>%">
		    	</div>
	    	<?php }elseif($point>$max_3 ){?>
	    		<div class=" progress-bar" role="progressbar" style="width:<?php echo $width_1;?>%;background:#E8C44F;">
		    	</div>
		    	<div class=" progress-bar" role="progressbar" style="width:<?php echo $width_2;?>%;background:#ED863A;">
		    	</div>
		    	<div class=" progress-bar" role="progressbar" style=" background: #E54242;width:<?php echo $width_3;?>%">
		    	</div>
	    	<?php }?>
	    		
		</div>
		<?php if($point>=$min_1 && $point <= $max_3){?>
			<p style="position: absolute;top:-20px;font-size: 18px; color:#46c649; left:<?php echo ($width_p4 -1);?>%; text-align: center; "><?php echo $point; ?></p>
			<div style="top: 14px;background: #fff;height: 29px;width: 29px;border-radius: 100%;left:<?php echo ($width_p4 -1);?>%;position: absolute;border:1px solid #ccc;padding: 5px;">
				<div style=" background: #46c649 ;height: 17px;width: 17px;border-radius: 100%;">
				</div>
			</div>		
		<?php }elseif($point>$max_3){?> 
			<p style="position: absolute;top:-20px;font-size: 18px; color:#46c649; left:97%; text-align: center; "><?php echo $point; ?></p>
			<div style="top: 14px;background: #fff;height: 29px;width: 29px;border-radius: 100%;left:98%;position: absolute;border:1px solid #ccc;padding: 5px;">
				<div style=" background: #46c649 ;height: 17px;width: 17px;border-radius: 100%;">
				</div>
			</div>
		<?php }elseif($point<$min_1 ){ ?>
			<p style="position: absolute;top:-20px;font-size: 18px; color:#46c649; left:<?php echo ($width_p4);?>%; text-align: center; "><?php echo $point; ?></p>
		<?php }?>	
	</div>
	
	
	<!-- ưu đãi-->
	<div class=" row" style="margin-bottom: 40px;margin-top: 20px;">
		<div class="col-md-4">
			<p><strong>Ưu đãi thẻ bạc:</strong> </p>
			<p><span style="color: #46c649;">&#9679;</span> <span style="font-size: 14px"> Ưu đãi quà tặng theo từng chương trình khuyến mãi</p>
			
		</div>
		<div class="col-md-4">
			<p><strong>Ưu đãi thẻ vàng:</strong> </p>
			<p><span style="color: #46c649;">&#9679;</span> Giảm giá 5% </p>
			<p><span style="color: #46c649;">&#9679;</span> Ưu đãi quà tặng theo từng chương trình khuyến mãi</p>
			

		</div>
		<div class="col-md-4">
			<p><strong>Ưu đãi thẻ kim cương:</strong> </p>
			<p><span style="color: #46c649;">&#9679;</span> Giảm giá 10% </p>
			<p><span style="color: #46c649;">&#9679;</span> Ưu đãi quà tặng theo từng chương trình khuyến mãi</p>
			
		</div>
		
	</div>
	<!-- lịch sử giao dịch-->
	<div style="margin-top:40px;height: 520px;	overflow: auto;overflow-x: hidden;">
		<h3 class="h3_member">Lịch sử giao dịch</h3>		
		<p style="color: #828282; margin:0px 15px;font-style: italic; text-align: right;"> * Cách tính điểm xếp hạng: 50.000đ tặng 1 điểm thưởng</p>
		<div class="clearfix"></div>
	  <table class="table table-member" style="margin-top:15px;">
	    <thead>
	      <tr>
	        <th>Ngày giao dịch</th>
	        <th>Số tiền giao dịch</th>
	        <th>Nội dung giao dịch</th>
	        <th>Điểm tích lũy</th>
	        <th>Quà tặng</th>
	      </tr>
	    </thead>
	    <tbody>
		    <?php $receipt = VReceipt::model()->findAllByAttributes(array('id_customer'=>$id_customer));

		    if(!$receipt){ ?>
		    	<tr><td colspan="5" >Chưa có giao dịch nào!</td></tr>
		   	<?php }else{
			   	foreach ($receipt as $key => $value) { ?>
			   	 	
				<tr>
					<td><?php echo $value['pay_date']; ?></td>
					<td><?php echo number_format($value['pay_amount'],0,",","."); ?></td>
					<td>Thanh toán cho đơn hàng <?php echo $value['code'];?>
					</td>
					<td><?php echo $value['point']; ?></td>
					<td>1 lần khám răng miễn phí</td>
				</tr>
			<?php  
				} 
			}?>     
	    </tbody>
	  </table>
  	</div>
	
</div>


<script type="text/javascript">
	  $(function () {
            $('#create_date1').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            });

    }); 
	  function insertMember(id,id_customer){
	  	
	  	code_member =	$('#code_member').val();
		create_date =	$('#create_date').val();
		id_customer =	$('#id_customer').val();
		id          =	$('#id').val();
		id_member   =	$('#member').val();
		$('.cal-loading').fadeIn('fast');
		$.ajax({
		    type:'POST',
		    url: baseUrl+'/itemsCustomers/Accounts/insertMember',	
		    data: {
		    	"id":id,
		    	"id_customer":id_customer,
		    	"code_member":code_member,
		    	"create_date":create_date,
		    	"id_member":id_member
		    },   
		    success:function(data){		    	
		    	//alert(data);
				$('.cal-loading').fadeOut('fast');
		    },
		    error: function(data){
		    console.log("error");
		    console.log(data);
		    }
	    });	
	  }

	
	$(function(){
   		 var numberOptions = {aSep: ' ', aDec: ',', mDec: 3, aPad: false, dGroup: 4};
   		 $('#code_member').autoNumeric('init',numberOptions);
	});

</script>