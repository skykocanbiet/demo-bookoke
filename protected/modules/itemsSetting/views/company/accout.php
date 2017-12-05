<?php 
	$value = GpUsers::model()->findAllByAttributes(array("id"=>"2"));
	
	$v = $value[0];

	
 ?>
<div class="customerProfileContainer">

	<div id="accout" class="customerProfileHolder" style="display: block;margin:30px auto;">
		<div class="row">
		<ul id="customerDetailFormList">
			 <div class="ct"><label class="detail_lable1">1. Chi tiết tài khoản</label></div> 
			<div class="col-sm-6">

				<li>
					 <div class="colunm1">
						<label class="fl" style="width: 100px;">Tài khoản: </label>
					</div>
					<div class="colunm2">
							<input type="text" placeholder="Tài khoản" name="username" id="username" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $v['username']; ?>">   
					</div> 
					<div class="clearfix"></div>       
                </li>
                <li>
				  <div class="colunm1">
					<label class="fl" style="width: 100px;">Mật khẩu :</label>
					</div>
					<div class="colunm2">
						<input type="password" placeholder="Tài khoản" name="username" id="username" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $v['password']; ?>" style="width:50% !important;">
						<a href="#" id="apass" class="btn btn-primary modal-open">
            			<i class="fa fa-key"></i>&nbsp;Đổi mật khẩu</a>
					</div>        
                </li>
			</div>
			<div class="col-sm-6">

				<li>
				  <div class="colunm1">
					<label class="fl" style="width: 100px;">Điện thoại :</label>
					</div>
					<div class="colunm2">
						<input type="text" placeholder="Điện thoại" name="phone" id="phone" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $v['phone'] ?>">
					</div>
					<div class="clearfix"></div>        
                </li>
                <li>
				  <div class="colunm1">
					<label class="fl" style="width: 100px;">Email :</label>
					</div>
					<div class="colunm2">
						<input type="email" placeholder="Email" name="mail" id="mail" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $v['email']; ?>">
					</div>        
                </li>
			</div>
			<div class="clearfix"></div>
			<hr style="" style="display:inline-block;">
			<div class="ct" ><label class="detail_lable1">2. Thiết lặp lịch</label></div>
			<div class="col-sm-6">
				<li>
					 <div class="colunm1">
					<label class="fl" style="width: 100px;">Lịch mặc định:</label>
					</div>
					<div class="colunm2">
						<select class="custProfileInput yellow_hover blue_focus fl">
							<option>Lịch theo ngày</option>
							<option>Lịch theo tuần</option>
							<option>Lịch theo tháng</option>
						</select>
					</div>
					<div class="clearfix"></div> 
				</li>
			</div>
			<div class="clearfix"></div>
			<hr style="" style="display:inline-block;">
			<div ><label class="detail_lable1">3. Thiết lập thời gian</label></div>
			<div class="col-sm-6">

				<li>
				  <div class="colunm1">
					<label class="fl" style="width: 100px;">Ngày bắt đầu tuần:</label>
					</div>
					<div class="colunm2">
						<select class="custProfileInput yellow_hover blue_focus fl">
							<option>Thứ hai</option>
							<option>Thứ ba</option>
							<option>Thứ tư</option>
							<option>Thứ năm</option>
							<option>Thứ sáu</option>
							<option>Thứ bảy</option>
							<option>Chủ nhật</option>
						</select>
					</div>
					<div class="clearfix"></div>        
                </li>
                <li>
				  <div class="colunm1">
					<label class="fl" style="width: 100px;">Thời gian khách hàng:</label>
					</div>
					<div class="colunm2">
						<select class="custProfileInput yellow_hover blue_focus fl">
							<option>5 min</option>
							<option>15 min</option>
							<option>30 min</option>
							<option>60 min</option>
							
						</select>
					</div> 
					<div class="clearfix"></div>         
                </li>
                <li>
				  <div class="colunm1">
					<label class="fl" style="width: 100px;">Giờ bắt đầu:</label>
					</div>
					<div class="colunm2">
						<select class="custProfileInput yellow_hover blue_focus fl">
							<option>6 am</option>
							<option>7 am</option>
							<option>8 am</option>
							<option>9 am</option>
							<option>10 am</option>
							<option>11 am</option>
							<option>12 am</option>
							<option>1 pm</option>
							<option>2 pm</option>
							<option>3 pm</option>
							<option>4 pm</option>
							<option>5 pm</option>
							
						</select>
					</div> 
					<div class="clearfix"></div>        
                </li>
			</div>
			<div class="clearfix"></div>
			<hr style="" style="display:inline-block;">
			<div class="ct" ><label class="detail_lable1">4. Hiển thị lịch làm việc theo nhân sự</label></div>
			<div class="col-sm-6">

				<li>
					 <div class="colunm1">
						<label class="fl" style="width: 100px;">
							<div onclick="change_store()" id="slider_holder" class="slider_holder staffhours sliderdone" style="margin-left: 25px;">
						
							<input type="hidden" value="1">
							<span  id="off_store" class="slider_off Off sliders"> TẮT </span>
							<span  id="on_store" class="slider_on On sliders"> BẶT </span>
							<span  id="switch_store" class="slider_switch Switch"></span>
						</div> 
						
						</label>
					</div>
					<div class="colunm2">
							<i>Tắt/Bật lịch hẹn theo nhân sự.</i>  
					</div> 
					<div class="clearfix"></div>       
                </li>
                
			</div>
			<div class="clearfix"></div>
			<hr style="" style="display:inline-block;">
			<div class="ct"><label class="detail_lable1">5. Thiết lập ngôn ngữ</label></div>
			<div class="col-sm-6">

				<li>
					 <div class="colunm1">
						<label class="fl" style="width: 140px;">
							Ngôn ngữ
						</label>
					</div>
					<div class="colunm2">
							<select class="custProfileInput yellow_hover blue_focus fl">
							<option>English</option>
							<option>Tiếng việt</option>
							
						</select>  
					</div> 
					<div class="clearfix"></div>       
                </li>
                
			</div>

			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
	function change_store()
    {
    	  $("#on_store").toggleClass("On");
    	  $("#off_store").toggleClass("Off");
    	  $('#switch_store').toggleClass("Switch");
       	  $('#store1').toggleClass('input_value'); 
    	  

    }
</script>

<style type="text/css">
	.f2{
		width: 100%;
		font-size: 13px !important;
	    color: #000000;
	    font-weight: 600 !important;
	    border: solid 1px #ffffff;
	    text-indent: 5px;
	    font-weight: normal;
	    height: 30px !important;
	    line-height: 30px !important;
	}
	#pass .btn-primary {
    color: #fff;
    background-color: #00b3f0;;
    border-color: #00a0d7;
}
#apass{
	border: none !important;
    margin: 0px !important;
    color: #f5f5f5 !important;
    font-size: 14px !important;
    text-transform: uppercase;
    padding: 5px 5px !important;
    margin-left: 10px !important;
}
.sliders {
        line-height: 23px;
        float: left;
        width: 60px;
        position: absolute;
        color: #ffffff !important;
        font-size: 11px !important;
        font-weight: 800 !important;
    }
    .slider_off {
    background: url('../../images/switch-bg.png') -57px 0px no-repeat;
    left: 60px;
    text-indent: 26px;
    color: #ffffff !important;
    padding-right: 9px;
    }
    .slider_on {
    background: url('../../images/switch-bg.png') 0px 0px no-repeat;
    text-indent: 10px;
    left: 2px;
    text-align: left;
    }
    .slider_switch {
    background: url('../../images/switch-btn.png') left top no-repeat;
    height: 24px;
    left: 38px;
    position: absolute;
    width: 25px;
    }
    .Off{
        left: 1px;
    }
    .On{
        left: -57px;
    }
    .Switch{
        left: 1px;
    }
    .detail_lable1{
    	font-size: 15px !important;
    	color: #32c12b;
    }
    .colunm1 > label{
    	width: 140px !important;
    }
    .ct{
    	margin-bottom: 7px;
    }
</style>