<style>
	#bk_step {position: relative;}
	#pf_img {background: #e9e8e7; border-radius: 10px;text-align: center;position: relative;margin-top: 50px;padding-bottom: 20px;}
	#pf_img img {width: 80%; height: auto; border-radius: 100%; background: #989898;margin-top: -20px;}
	#pf_img p:nth-child(2) {margin-top: 20px; color: #3d3e3e; font-weight: bold;}
	#pf_img p:nth-child(3) {color: #e29a26; font-weight: bold;}
	#pf_img p:last-child {background: #5e5e5e; color: white; width: 80%; margin: auto; border-radius: 5px;}
	#pf_tab .tab-content h4 {color: #94c640; font-weight: bold; padding: 30px 0 10px 0;}
	#pf_rs {font-weight: bold;}
	#pf_qh_tt {text-align: right;}
	#pf_tab .tab-content th, #pf_tab .tab-content td {text-align: center; color: black;}
	#pf_treat hr{border: 1px dashed #ddd;}
	#pf_cir {width: 13px;
	    height: 13px;
	    border-radius: 100%;
	    background: #76b042;
	    position: absolute;
	    top: -5px;
	    right: 0;}
	#pf_bill {margin: 20px auto; background: #f4f3f3;}
/*HO SO BENH AN*/
#pf_medi{font-size: 14px;}
.btn-apply{background: #00AADC;color: #ffffff;border-radius: 4px !important;padding: 5px 12px;}
.btn-apply:hover{background: rgba(0, 170, 220, 0.5);color: #ffffff;}
.btn-completed{background: #00AADC;color: #ffffff;border-radius: 4px !important;padding: 2px 10px;}
.btn-completed:hover{background: rgba(0, 170, 220, 0.5);color: #ffffff;}
.td-apply1{min-width: 520px;}
.td-apply{text-align: right !important;}
.text-align-right{text-align: right;}
.margin-bottom-15{margin-bottom:15px;}
.margin-top-15{margin-top:15px;}
.margin-top-50{margin-top:50px;}
.margin-bottom-50{margin-bottom:50px;}
.margin-bottom-30{margin-bottom:30px;}
.margin-top-20{margin-top:20px;}
.margin-top-30{margin-top:30px;}
.padding-left-15{padding-left:15px;}
.padding-right-15{padding-right:15px;}
.table-treatment thead tr th{color:#fff !important;padding: 20px;}
#pf_medi h4{font-size: 20px;}
#table-diagnosis td{padding: 7px 10px;}
/*ĐỢT ĐIỀU TRỊ 4*/
#treatment_4 tr:nth-child(even){background-color: #f2f2f2}
.trash,.pencil{cursor: pointer;}
.trash:hover,.pencil:hover{color: #92C350;}
.treatment {
	position: absolute;
  display: none;
  z-index: 10;
  width: 100%;
}
.formholder {
  background: #FFFFFF;
  width: 100%;
  box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2);
}
.formholder input[type="submit"] {
  background: #9CC34D;
  padding: 0px;
  font-size: 13px; 
  border: none;
  color: #fff;
      margin-top: 10px;
    margin-bottom: 10px
}
/*END ĐỢT ĐIỀU TRỊ 4*/
.file-dinh-kem{	
	margin-bottom: 15px;
    cursor: pointer;
    text-indent: 30px;
    line-height: 20px;
	width: 100%;
    background: url(images/medical_record/more_icon/file-dinh-kem-def.png);
    background-size: 15%;
    background-repeat: no-repeat;
    	
}
.file-dinh-kem:hover{
	background: url(images/medical_record/more_icon/file-dinh-kem-act.png);
    background-size: 15%;
    background-repeat: no-repeat;
	color: #92C350;		
}
 
.file-chup{	
	margin-bottom: 15px;
    cursor: pointer;
    text-indent: 30px;
    line-height: 20px;
	width: 100%;
    background: url(images/medical_record/more_icon/film-chup-def.png);
    background-size: 15%;
    background-repeat: no-repeat;
    	
}
.file-chup:hover{
	background: url(images/medical_record/more_icon/film-chup-act.png);
    background-size: 15%;
    background-repeat: no-repeat;
	color: #92C350;		
}
.them{	
	margin-bottom: 15px;
    cursor: pointer;
    text-indent: 30px;
    line-height: 20px;
	width: 100%;
    background: url(images/medical_record/more_icon/them-def.png);
    background-size: 15%;
    background-repeat: no-repeat;
    	
}
.them:hover{
	background: url(images/medical_record/more_icon/them-act.png);
    background-size: 15%;
    background-repeat: no-repeat;
	color: #92C350;		
}
.xoa{	
	margin-bottom: 15px;
    cursor: pointer;
    text-indent: 30px;
    line-height: 20px;
	width: 100%;
    background: url(images/medical_record/more_icon/xoa-def.png);
    background-size: 15%;
    background-repeat: no-repeat;
    	
}
.xoa:hover{
	background: url(images/medical_record/more_icon/xoa-act.png);
    background-size: 15%;
    background-repeat: no-repeat;
	color: #92C350;		
}
.nhac-nho{	
	margin-bottom: 15px;
    cursor: pointer;
    text-indent: 30px;
    line-height: 20px;
	width: 100%;
    background: url(images/medical_record/more_icon/nhac-nho-def.png);
    background-size: 15%;
    background-repeat: no-repeat;
    	
}
.nhac-nho:hover{
	background: url(images/medical_record/more_icon/nhac-nho-act.png);
    background-size: 15%;
    background-repeat: no-repeat;
	color: #92C350;		
}
.ghi-chu{	
	margin-bottom: 15px;
    cursor: pointer;
    text-indent: 30px;
    line-height: 20px;
	width: 100%;
    background: url(images/medical_record/more_icon/ghi-chu-def.png);
    background-size: 15%;
    background-repeat: no-repeat;
    	
}
.ghi-chu:hover{
	background: url(images/medical_record/more_icon/ghi-chu-act.png);
    background-size: 15%;
    background-repeat: no-repeat;
	color: #92C350;		
}
.d_kem{	
    background: url(images/medical_record/more_icon/file-dinh-kem-def.png);
    background-size: 35% 100%;
    background-repeat: no-repeat;
    width: 100%;
    height: 25px;
    background-position: 25px 0px;   
} 
.d_kem:hover{
    background: url(images/medical_record/more_icon/file-dinh-kem-act.png);
    background-size: 35% 100%;
    background-repeat: no-repeat; 
    width: 100%;
    height: 25px;
    background-position: 25px 0px;   
} 
#draw{	
    background: url(images/medical_record/more_icon/draw-def.png);
    background-size: 100%;
    background-repeat: no-repeat;
    padding: 15px;
} 
#draw:hover{
    background: url(images/medical_record/more_icon/draw-act.png);
    background-size: 100%;
    background-repeat: no-repeat; 
    padding: 15px;  
} 
#toggle-dental{
	box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2);
	display:none;
	position:absolute;
	z-index: 10;
	width:150px;
	background-color: #fff;
	height: 150px;
	top: 6%;
	right: -9%;
	padding-top: 15px;
	padding-left: 15px;

}
#toggle-dental>div{
	padding: 2px 5px;	
}
#toggle-dental>div:hover{
	background-color: #00A9DC;
	color: #fff;	
}
.toggle-dental-content{	
	padding: 15px 5px;
	top: 30%;
    left: 101%;
	 display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 333px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}
.toggle-dental-content a {
    color: black;
    padding: 12px 20px;
    text-decoration: none;    
}
.sick:hover .toggle-dental-content {
    display: block;
}
a.hide { display:none;}
</style>
<div id="pf">
	<div id="bk_step">
		<h2>HỒ SƠ CÁ NHÂN</h2>
	</div>
	<div class="container" id="pf_tab">
		<div class="row">
			<div class="col-sm-12">
				<ul class="nav nav-tabs">
				 	<li class="active"><a data-toggle="tab" href="#pf_info">THÔNG TIN CÁ NHÂN</a></li>

                    <?php 
                    $treatment = Customer::model()->checkTreatment($model->id);
                    if($treatment) { ?>     

				  	<li><a data-toggle="tab" href="#pf_medi">HỒ SƠ BỆNH ÁN</a></li>

                    <?php } ?>
				  <!-- 	<li><a data-toggle="tab" href="#pf_treat">LỊCH SỬ ĐIỀU TRỊ</a></li>
				  	<li><a data-toggle="tab" href="#pf_ins">THÔNG TIN BẢO HIỂM</a></li> -->

                  
				</ul>
				
				<div class="tab-content col-xs-12">					
					<div id="pf_info" class="tab-pane fade in active">
						<?php include("personal_information.php");?>
					</div>
         
                    <?php 
                    $treatment = Customer::model()->checkTreatment($model->id);
                    if($treatment) { ?>  

				  	<div id="pf_medi" class="tab-pane fade"> 
						<?php include("medical_record.php");?>                       
					</div>	

                    <?php } ?>
					<!-- <div id="pf_treat" class="tab-pane fade">
					  	<?php /* include("treatment_history.php"); */ ?>  
					</div>
					<div id="pf_ins" class="tab-pane fade">
					    <?php /* include("insurance_information.php"); */ ?>
					</div> -->
                   
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$('#table_treatment').click(function(){ 	
	$('#col-md-3').removeClass('col-md-3 col-lg-4').addClass('col-md-4 col-lg-5');
	$('#triangle').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-top');
  	$('.treatment').fadeToggle('fast');
});

$(document).mouseup(function (e)
{
    var container = $(".treatment");
    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {    
    	$('#col-md-3').removeClass('col-md-4 col-lg-5').addClass('col-md-3 col-lg-4');
    	$('#triangle').removeClass('glyphicon-triangle-top').addClass('glyphicon-triangle-bottom');    
        container.hide();        
    }
     
});

$('#more1').click(function (e) { 
	 
	$('#toggle_more1').fadeToggle('fast');
});
$(document).mouseup(function (e)
{
    var container = $("#toggle_more1");
    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {   
    	
        container.hide();        
    }
     
});

$('#dental').contextmenu(function (e) {
    e.preventDefault();
    $('#toggle-dental').fadeToggle('fast');
});
$(document).mouseup(function (e)
{
    var container = $("#toggle-dental");
    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {   
    	
        container.hide();        
    }
     
});
$('.sick').click(function (e) {
    
    $('.toggle-dental-content').fadeToggle('fast');
});
$(document).mouseup(function (e)
{
    var container = $(".toggle-dental-content");
    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {   
    	
        container.hide();        
    }
     
});

$(document).ready(function(){
   $('.fancybox').fancybox(); 
});


$('#edit_info').click(function (e) { 
	$("#edit_info").css("display", "none");
	$("#save_info").css("display", "block");
	$("#image").css("display", "block");
	$("#fullname").attr("disabled", false); 
	$("#gender").attr("disabled", false);
	$("#birthdate").attr("disabled", false);
	$("#identity_card_number").attr("disabled", false);
	$("#id_country").attr("disabled", false);
	$("#phone").attr("disabled", false);
	$("#email").attr("disabled", false);
	$("#address").attr("disabled", false);
	$("#id_job").attr("disabled", false);
	$("#position").attr("disabled", false);
	$("#organization").attr("disabled", false);
	$("#note").attr("disabled", false);
});



</script>