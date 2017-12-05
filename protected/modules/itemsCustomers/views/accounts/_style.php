<style>
#customer-grid{
    margin-top: 30px;
}
#tab1,#tab2,#tab3,#tab4{
    padding: 50px !important;
}
.margin_10px_0{
	margin: 10px 0;
}
.profile-left{
	border-radius: 5%;	
	padding:20px;
	background-color:#E8E7E7;
	position:relative;
	width: 90%;
	margin: 0px auto;
}
#profile-image{
	width: 70%;
    background-color: #979798;
    position: absolute;
    top: -10%;
    right: 14%;
    border-radius: 50%;
    overflow: hidden;
}
.note_medical_history{ 
    color:#10b1dd;
    cursor: pointer;
    margin-left: 20px;
}
.note_medicalHistory{
    font-style: italic;
    color:#10b1dd;  
}
#profile-image img{
	height: auto;
	width: 100%;
}
#profile-name {
    width: 100%;
    text-align: center;
    font-size: 20px; 
    font-weight: 700;
    padding-top: 70%;
}
#profile-code {
    width: 100%;
    text-align: center;
    font-size: 18px;  
    font-weight: 700;
    color: #E49737;
}
#code {       
  	margin: 0px auto;
    width: 150px;
    height: 40px;
    background-color: #5D5D5E;
 
}
#code div{ 
	text-align: center;
    padding: 7px;
    color: #fff;
    font-size: 18px;
}
.row h4{
	color: #6ec4a1;
	margin: 25px 0px;
    font-size: 21px;
}
.yiiTab ul.tabs a.active{
	color: #00A9DD !important;
	border-top: 3px solid #088eb3 !important;
}
.yiiTab ul.tabs a{
	color: #000000 !important;
}

.yiiTab ul.tabs li a {
    padding: 7px 21px !important;
}

@media only screen and (min-device-width : 320px) and (max-device-width : 768px) {
	#tab1{
		padding:15px 15px !important;
	}
	#tab2{
		padding:15px 15px !important;
	}
	#tab3{
		padding:15px 15px !important;
	}
	#tab4{
		padding:15px 15px !important;
	}
    #tabcontent{
        padding: 10px 10px 5px 10px;
    }

}
#tabcontent{
    padding: 30px 30px 10px 30px;
}

.text-align-right{
	text-align: right;
}
.text-align-center{
    text-align: center !important;
}
.margin-top-10{
	margin-top: 10px;
}
.margin-top-15{
	margin-top: 15px;
}
.margin-top-20{
	margin-top: 20px;
}
.margin-top-25{
	margin-top: 25px;
}
.margin-top-50{
	margin-top: 50px;
}
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
.table-treatment>thead{
    color: #fff;  
}
.table-treatment {
    border-bottom:0px !important;
}
.table-treatment>thead>tr th, .table>tbody tr td {
    border: 0px !important;
    text-align: center;
}
.at{
    background-color: #c4e2c7 !important;
}
#pf_medi h4{font-size: 20px;}
#table-diagnosis td{padding: 7px 10px;}
	/*ĐỢT ĐIỀU TRỊ 4*/
#treatment_4 tr:nth-child(even){background-color: #f2f2f2}
.trash,.pencil{cursor: pointer;}
/*.trash:hover,.pencil:hover{color: #92C350;}*/
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
    background: url(../../images/medical_record/more_icon/file-dinh-kem-def.png);
    background-size: 15%;
    background-repeat: no-repeat;
    	
}
.file-dinh-kem:hover{
	background: url(../../images/medical_record/more_icon/file-dinh-kem-act.png);
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
    background: url(../../images/medical_record/more_icon/film-chup-def.png);
    background-size: 15%;
    background-repeat: no-repeat;
    	
}
.file-chup:hover{
	background: url(../../images/medical_record/more_icon/film-chup-act.png);
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
    background: url(../../images/medical_record/more_icon/them-def.png);
    background-size: 15%;
    background-repeat: no-repeat;
    	
}
.them:hover{
	background: url(../../images/medical_record/more_icon/them-act.png);
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
    background: url(../../images/medical_record/more_icon/xoa-def.png);
    background-size: 15%;
    background-repeat: no-repeat;
    	
}
.xoa:hover{
	background: url(../../images/medical_record/more_icon/xoa-act.png);
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
    background: url(../../images/medical_record/more_icon/nhac-nho-def.png);
    background-size: 15%;
    background-repeat: no-repeat;
    	
}
.nhac-nho:hover{
	background: url(../../images/medical_record/more_icon/nhac-nho-act.png);
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
    background: url(../../images/medical_record/more_icon/ghi-chu-def.png);
    background-size: 15%;
    background-repeat: no-repeat;
    	
}
.ghi-chu:hover{
	background: url(../../images/medical_record/more_icon/ghi-chu-act.png);
    background-size: 15%;
    background-repeat: no-repeat;
	color: #92C350;		
}
.d_kem{	
    background: url(../../images/medical_record/more_icon/file-dinh-kem-def.png);
    background-size: 35% 100%;
    background-repeat: no-repeat;
    width: 100%;
    height: 25px;
    background-position: 25px 0px;   
} 
.d_kem:hover{
    background: url(../../images/medical_record/more_icon/file-dinh-kem-act.png);
    background-size: 35% 100%;
    background-repeat: no-repeat; 
    width: 100%;
    height: 25px;
    background-position: 25px 0px;   
} 
#draw{	
    background: url(../../images/medical_record/more_icon/draw_1.png);
    background-size: 100%;
    background-repeat: no-repeat;
    padding: 20px;
} 
#draw:hover{
    background: url(../../images/medical_record/more_icon/draw_3.png);
    background-size: 100%;
    background-repeat: no-repeat; 
    padding: 20px;  
} 
#save{  
    background: url(../../images/medical_record/more_icon/sale_1.png);
    background-size: 100%;
    background-repeat: no-repeat;
    padding: 20px;
} 
#save:hover{
    background: url(../../images/medical_record/more_icon/sale_3.png);
    background-size: 100%;
    background-repeat: no-repeat; 
    padding: 20px;  
} 
#note{  
    background: url(../../images/medical_record/more_icon/note_def.png);
    background-size: 100%;
    background-repeat: no-repeat;
    padding: 20px;
} 
#note:hover{  
    background: url(../../images/medical_record/more_icon/note_act.png);
    background-size: 100%;
    background-repeat: no-repeat;
    padding: 20px;
} 
#ic_close{  
    background: url(../../images/medical_record/more_icon/ic_close.png);
    background-size: 100%;
    background-repeat: no-repeat;
    padding: 10px;
} 
.ic_close_white{  
    background: url(../../images/medical_record/more_icon/ic_close_white.png);
    background-size: 100%;
    background-repeat: no-repeat;
    padding: 10px;
} 
#toggle-dental{
	box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2);
	display:none;
	position:absolute;
	z-index: 10;
	width:170px;
	background-color: #fff;
	height: 170px;
}
#toggle-dental>div{
	padding-left: 15px;
    line-height: 30px;
    font-size: 12px;	
    cursor: pointer;
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
.toggle-dental-content div {
    color: black;
    padding: 7px 15px;
    text-decoration: none;    
}
.sick:hover .toggle-dental-content {
    display: block;
}
.text-align-left{
    text-align: left !important;
}
a.hide { display:none;}  
#addnewMedicalHistoryPopup{
    padding:15px;position: fixed;top: 2%;right: 0;left: 0;width: 800px;height: auto;margin: 0 auto;background: #ffffff;border-radius: 3px;z-index: 999;
}
.blur{
    display: none;position: fixed;top: 0;right: 0;width: 100%;height: 100%;z-index: 999;background: rgba(0,0,0,0.8);
}
#plupload-master-container{
    padding:15px;position: fixed;top: 5%;right: 0;left: 0;width: 800px;height: auto;margin: 0 auto;background: #ffffff;border-radius: 3px;z-index: 999;
}
.sHeader{
    background: #e6e6e5;
    color: #5a5a5a;
    padding: 8px 30px;
    font-size: 18px;
}
#newPlan {
    border-radius: 3px;
    font-weight: bold;
    font-size: 20px;
    line-height: 28px;
    height: 30px;
    width: 30px;
    padding: 0px;
    float: right;
    border: solid 1px #D7D7D7;
    background: #10b1dd;
    text-decoration: none;
    color: #FFF;
    text-indent: 0px;
    text-align: center;
} 
/*END HO SO BENH AN*/
/*N*/
	#bk_step {position: relative;}
	#pf_img {background: #e9e8e7; border-radius: 10px;text-align: center;position: relative;margin-top: 50px;padding-bottom: 20px;}
	#pf_img img {width: 80%; height: auto; border-radius: 100%; background: #989898;margin-top: -20px;}
	#pf_img p:nth-child(2) {margin-top: 20px; color: #3d3e3e; font-weight: bold;}
	#pf_img p:nth-child(3) {color: #e29a26; font-weight: bold;}
	#pf_img p:last-child {background: #5e5e5e; color: white; width: 80%; margin: auto; border-radius: 5px;}
	#pf_tab .tab-content h4 {color: #94c640; font-weight: bold; padding: 30px 0 10px 0;}
	.h4_insurance_information {color: #94c640; font-weight: bold; padding: 30px 0 10px 0;}
	#pf_rs {font-weight: bold;}
	#pf_qh_tt {text-align: right;}
	#pf_tab .tab-content th, #pf_tab .tab-content td {text-align: center; color: black;}
	.table_insurance_information th,.table_insurance_information td {text-align: center; color: black !important;}
	#pf_treat hr{border: 1px dashed #ddd;}
	#pf_cir {width: 13px;
	    height: 13px;
	    border-radius: 100%;
	    background: #76b042;
	    position: absolute;
	    top: -5px;
	    right: 0;}
	#pf_bill {margin: 20px auto; background: #f4f3f3;}
/*END N*/
/*HOI VIEN*/
.bonus_score {
	border-radius: 3px;
	font-weight: bold;
	font-size: 20px;
	line-height: 28px;
	height: 30px;
	width: 30px;
	padding: 3px 8px;
	border: solid 1px #D7D7D7;
	background: #6ec4a1;
	text-decoration: none;
	color: #FFF;
	text-indent: 0px;
	text-align: center;
}

#voucher{
	border-radius: 3px;
	font-weight: bold;
	font-size: 20px;
	line-height: 28px;
	height: 30px;
	width: 30px;
	padding: 3px 8px;
	border: solid 1px #D7D7D7;
	background: #10b1dd;
	text-decoration: none;
	color: #FFF;
	text-indent: 0px;
	text-align: center;
}

.h3_member{
    float: left;
    width: 170px;
    line-height: 27px;
    font-size: 22px;
    color: #455862;
    font-weight: 400;
    margin: 0px;
}
/*END HOI VIEN*/

/*Sidenav*/
.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #fff;
    overflow-x: hidden;
    transition: 0.5s;
    /*padding-top: 60px;*/
    position: absolute;
}

.sidenav a {
    padding: 8px 8px 5px 32px;
    text-decoration: none;
    font-size: 18px;
    color: #5a5a5a;
    display: block;
    transition: 0.3s
}

.sidenav a:hover, .offcanvas a:focus{    
    background-color: #f1f5f7;
}

.sidenav .closebtn {
    position: absolute;
    top: 21px;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

.sidenav .closebtn:hover {
    background-color: #6ec4a1;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.list-group-item{
    background-color: #fff !important;
    color: #818181 !important;
}
/*End Sidenav*/
.table{
    display: table;     
}
.cell{    
    display:table-cell;
    vertical-align: middle;
 }
.opacity-0{
    opacity: 0;
}
#oAdds{
    border-radius: 5px;
    font-weight: normal;
    font-size: 14px;
    line-height: 28px;   
    padding: 5px 10px;
    float: right;
    border: solid 1px #D7D7D7;
    background: #7cc9ac;
    text-decoration: none;
    color: #FFF;
    text-indent: 0px;
    text-align: center;
    display: inline-block;
    margin: 15px;
}
.oUpdates{
    border-radius: 5px;
    font-weight: normal;
    font-size: 14px;
    line-height: 28px;   
    padding: 5px 10px;
    float: right;
    border: solid 1px #D7D7D7;
    background: #7cc9ac;
    text-decoration: none !important;
    color: #FFF;
    text-indent: 0px;
    text-align: center;
    display: inline-block;
    margin: 15px;
}
#action-prescription{
    cursor: pointer;
    border-radius: 3px;
    font-weight: normal;
    font-size: 14px;
    line-height: 28px;       
    float: left;
    border: solid 1px #D7D7D7; 
    text-decoration: none !important;
    color: #FFF;
    text-indent: 0px;
    text-align: center;
    display: inline-block;
    width: 195px;
    margin: 0px 15px;
}
#action-lab{
    cursor: pointer;
    border-radius: 3px;
    font-weight: normal;
    font-size: 14px;
    line-height: 28px;       
    float: left;
    border: solid 1px #D7D7D7; 
    text-decoration: none !important;
    color: #FFF;
    text-indent: 0px;
    text-align: center;
    display: inline-block;
    width: 195px;
    margin: 0px 15px;
}
.ipt-dots{
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: 1px dotted #0e0e0e;
    border-radius: 0;
    box-shadow: none;
    padding: 15px 12px 0px 0px;
    background-color: #fff;
}
.ipt-dots:focus{
    box-shadow: none;
}
.spn-dots{
    border: none;
    background: #fff;
     padding: 15px 0px 0px 0px;
}
.actionMedicalHistory{
    border-radius: 3px;
    font-weight: normal;
    font-size: 14px;
    line-height: 28px;   
    padding: 5px 10px;
    float: right;
    border: solid 1px #D7D7D7;
    background: #6ec4a1;
    text-decoration: none !important;
    color: #FFF;
    text-indent: 0px;
    text-align: center;
    display: inline-block;
    margin: 15px;
}
.oUpdates:hover{    
    color: #FFF;    
}
/*calendarModal*/
#calendarModal .modal-content{width: 60%;}
#calendarModal .modal-header {background: #0eb1dc; color: white; padding: 7px 25px; font-weight: bold; }
#calendarModal .modal-header h3 {font-size: 22px; line-height: 1.5em;}
#calendarModal .modal-body {padding: 0 15px 10px;}
#calendarModal .modal-header .close {font-size: 36px; color: white; opacity: 1; font-weight: lighter;}
#calendarModal table {margin-top: 5px;}
#calendarModal table tr td {border: 0;}
.btn_new {background: #969696;}
.btn_book {background: #93c541; font-weight: bold;}
.oView {    
    padding: 0 25px 25px 25px;
    margin: 10px 0;    
}
.oViewB {background: #f4f7f7; padding: 0 0 15px; margin: 0 0 15px;}
.oViewB .sum td{border: 0;}
.oViewB table.table {background: #f4f7f7;}
.oViewB table.table thead{background: #e1e7eb; color: black;}
.oViewB table tr td, .oViewB table tr th{border: 1px solid white;}
.hiddenRow {padding: 0 !important;background-color: #f1f5f7;}
.btn-fw {
    width: 125px;
    box-sizing: border-box;
}
.btn-success {
    color: #fff;
    background-color: #94c63f;
    border-color: #94c63f;
}
.txt_treat {
    padding: 25px 0 0;
}
.action {
    cursor:pointer;
}
.delete_btn{    
    color: #fff !important;
    display: block !important;
}
.status_2{ 
    background-color:rgb(100,190,100) !important;
    border-color: rgb(100,190,100) !important;
}
.status_3{ 
    background-color:rgb(110,200,190) !important;
    border-color: rgb(110,200,190) !important;
}
.status_4{ 
    background-color:rgb(219, 207, 66) !important;
    border-color: rgb(219, 207, 66) !important;
}
.background-9CC34D{
    background:#9CC34D !important;
}
.background-666{
    background:#666 !important;
}
.print,.print_lab{
    float: left;
}

#table-insurrance tbody tr td{
    border: 1px solid #fff !important;
}
#table-insurrance thead tr th{
    color: #fff !important;
}

.table-member thead tr th{
    text-align: center;
    border: 1px solid #fff !important;
}
.table-member thead tr{
    background-color: #8ca7ae;
}
.table-member tbody tr td{
    border: 1px solid #fff !important;
}
.table-member thead tr th{
    color: #fff !important;
}
.table-member tbody {
    background-color: #f1f5f6;
}
#frm-lab .control-label{
    text-align: left;
}
.sbtnAdd {
    padding: 1px 11px;
}
.select2-dropdown {
    z-index: 9999;
}
.select2-container {
    margin-bottom: 10px;
}
a.disabled {
   pointer-events: none;
   cursor: default;
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
.daterangepicker .prev, .daterangepicker .next{
    visibility: hidden;
}

/*** searchCustomerPopup ***/
#searchCustomerPopup .popover-content {
    width: 225px;
}
#searchCustomerPopup input {
    margin-bottom:10px;
}
#searchCustomerPopup button{
    width: 100%;
    background-color: #6ec4a1;
}
/*** end searchCustomerPopup ***/
#customerList li:hover .hide{
  display: block !important;
}
</style>