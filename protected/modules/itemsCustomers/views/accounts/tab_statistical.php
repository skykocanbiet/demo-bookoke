<style>
	.statistical input {
    background: #F1F5F7;
    border: none;
    box-shadow: 0px 0px 3px #fff;
    border: 1px solid #fff;
	}
	.form-horizontal .control-label {
    padding-top: 7px;
    margin-bottom: 0;
    text-align: right;
    padding-right: 0px;
	}
</style>
<?php 
$lst_cus = Customer::model()->findByAttributes(array('id'=>$id_customer));
$schedule = Customer::model()->getCustomerSchedule($id_customer);
$schedule_date = $schedule['data'];
$member_model = Customer::model()->getCustomerMember($id_customer);
$member = $member_model['member'];
$point= $member_model['data'];
?>
<div class="customerProfileHolder" style="display: block;margin:0px auto;margin: 30px 0px;">
	<div class="row" >
		<div class="col-md-6 statistical" >
			<form class="form-horizontal">
			  	<div class="form-group">
				    <label for="" class="col-sm-4 control-label">Ngày đăng kí:</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" readonly value="<?php echo date_format(date_create($lst_cus->createdate),'d-m-Y'); ?>">
				    </div>
			  	</div>
			  	<div class="form-group">
				    <label for="" class="col-sm-4 control-label">Được giới thiệu:</label>
				    <div class="col-sm-5">
				      <input type="" class="form-control" readonly placeholder="" value="Bookoke" >
				    </div>
			  	</div>
			  	<div class="form-group">
				    <label for="" class="col-sm-4 control-label">Lần cuối tham gia:</label>
				    <div class="col-sm-5">
				      <input type="" class="form-control" readonly placeholder="" value="<?php echo date_format(date_create($schedule_date['create_date']),'d-m-Y'); ?>">
				    </div>
			  	</div>
			  	<div class="form-group">
				    <label for="" class="col-sm-4 control-label">Hội viên:</label>
				    <div class="col-sm-5">
				      <input type="" class="form-control" readonly value="<?php echo $member['name'];?>">
				    </div>
			  	</div>
			  	<div class="form-group">
				    <label for="" class="col-sm-4 control-label">Số điểm thưởng:</label>
				    <div class="col-sm-5">
				      <input type="" class="form-control" readonly value="<?php if($point['point']){echo $point['point'];}else { echo "0" ;}?>">
				    </div>
			  	</div>
			</form>
		</div>
		<div class="col-md-6 statistical">
			<form class="form-horizontal">
			  	<div class="form-group">
				    <label for="" class="col-sm-5 control-label">Tổng số chi tiêu:</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control " readonly value ="<?php echo number_format(Customer::model()->getCustomerInvoice($id_customer),0,",","."); ?> VND">
				    </div>
			  	</div>
			  	<div class="form-group">
				    <label for="" class="col-sm-5 control-label">Bình quân giao dịch:</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" readonly value ="<?php echo number_format(Customer::model()->getCustomerReceipt($id_customer),0,",","."); ?> VND">
				    </div>
			  	</div>
			  	<div class="form-group">
				    <label for="" class="col-sm-5 control-label">Tổng số lịch hẹn:</label>
				    <div class="col-sm-5">
				      <input type="" class="form-control" readonly placeholder="" value="<?php if($schedule['count']){echo $schedule['count']; }else{ echo "0"; }?>">
				    </div> 
			  	</div>
			  	<div class="form-group">
				    <label for="" class="col-sm-5 control-label">Hủy hẹn:</label>
				    <div class="col-sm-5">
				      <input type="" class="form-control" readonly placeholder="" value="<?php if( $schedule['schedule_cancel']){echo $schedule['schedule_cancel'];} else{ echo "0";} ?>">
				    </div>
			  	</div>
			  	<div class="form-group">
				    <label for="" class="col-sm-5 control-label">Bỏ hẹn:</label>
				    <div class="col-sm-5">
				      <input type="" class="form-control" readonly placeholder="" value="<?php if( $schedule['schedule_noshow']){echo $schedule['schedule_noshow'];}else{ echo "0";} ?>">
				    </div>
			  	</div>
			</form>
		</div>
	</div>
</div>
