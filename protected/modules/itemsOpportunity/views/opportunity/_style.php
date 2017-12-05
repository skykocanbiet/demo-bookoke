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
	color: #92C350;
	margin: 25px 0px;
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
    background: url(../../images/medical_record/more_icon/draw-def.png);
    background-size: 100%;
    background-repeat: no-repeat;
    padding: 15px;
} 
#draw:hover{
    background: url(../../images/medical_record/more_icon/draw-act.png);
    background-size: 100%;
    background-repeat: no-repeat; 
    padding: 15px;  
} 
#save{  
    background: url(../../images/medical_record/images/icon-save-def.png);
    background-size: 100%;
    background-repeat: no-repeat;
    padding: 20px;
} 
#save:hover{
    background: url(../../images/medical_record/images/icon-save-act.png);
    background-size: 100%;
    background-repeat: no-repeat; 
    padding: 20px;  
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
    padding:15px;position: fixed;top: 5%;right: 0;left: 0;width: 750px;height: auto;margin: 0 auto;background: #ffffff;border-radius: 3px;z-index: 999;
}
.blur{
    display: none;position: fixed;top: 0;right: 0;width: 100%;height: 100%;z-index: 999;background: rgba(0,0,0,0.8);
}
/*.sHeader{
    background: #0eb1dc;
    color: white;
    padding: 7px 30px;
    font-size: 18px;
    margin-left: -15px;
    margin-top: -15px;
    margin-right: -15px;
}*/
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
#bonus_score {
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
    background-color: #10b1dd;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
    position: absolute;
}

.sidenav a {
    padding: 8px 8px 5px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #fff;
    display: block;
    transition: 0.3s
}

.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
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
.opacity_0{
    opacity: 0;
}
#oAdds{
    border-radius: 3px;
    font-weight: normal;
    font-size: 14px;
    line-height: 28px;   
    padding: 5px 10px;
    float: right;
    border: solid 1px #D7D7D7;
    background: #10b1dd;
    text-decoration: none;
    color: #FFF;
    text-indent: 0px;
    text-align: center;
    display: inline-block;
    margin: 15px;
}
.oUpdates{
    border-radius: 3px;
    font-weight: normal;
    font-size: 14px;
    line-height: 28px;   
    padding: 5px 10px;
    float: right;
    border: solid 1px #D7D7D7;
    background: #10b1dd;
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
/*opportunity.css*/
ul{
    margin: 0 ;
    padding: 0;
}
[draggable] {
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    -khtml-user-drag: element;
    -webkit-user-drag: element;
}

table {
    border-collapse: collapse;
    border-spacing: 0;
}

#application {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    position: absolute;
    top: 0;
    left: 0;
}

#pipelineCanvas {
    height: 100%;
    overflow: hidden;
    -webkit-transition: background-image 0s linear 5.5s;
    -moz-transition: background-image 0s linear 5.5s;
    -ms-transition: background-image 0s linear 5.5s;
    -o-transition: background-image 0s linear 5.5s;
    transition: background-image 0s linear 5.5s;
}
.icon_opption{
    cursor: pointer;
    font-size: 14px;
}

.icon_opp_user{
    font-size: 20px;
    color: #10b1dd;
    cursor: pointer;
    margin: 0px;
    width: 30px;
    display: inline-block;
    text-align: center;
}
.icon_opp_user i{
    color: #0072f4;
}
.front .name_deal{
    font-size: 14px;
}
.pipelineSwitch  a {
    padding: 6px 9px;
    background: #ffffff;
    /* border: 1px solid #c2c8cd; */
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -ms-box-sizing: border-box;
    -o-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-box-shadow: 1px 1px 2px rgba(38, 41, 44, 0.3);
    -moz-box-shadow: 1px 1px 2px rgba(38, 41, 44, 0.3);
    box-shadow: 1px 1px 2px rgba(38, 41, 44, 0.3);
    cursor: pointer;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.timelineSwitch a:first-child {
      margin-left: 0;
      -webkit-border-radius: 3px 0 0 3px;
      -moz-border-radius: 3px 0 0 3px;
      border-radius: 3px 0 0 3px; }
    .pipelineSwitch a:last-child,
    .timelineSwitch a:last-child {
      border-right: 1px solid #c2c8cd;
      -webkit-border-radius: 0 3px 3px 0;
      -moz-border-radius: 0 3px 3px 0;
      border-radius: 0 3px 3px 0; }
      .pipelineSwitch a:last-child:first-child,
      .timelineSwitch a:last-child:first-child {
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px; }
    .pipelineSwitch a:hover,
    .timelineSwitch a:hover {
      background: #f3f5f6; }
    .pipelineSwitch a.selected,
    .timelineSwitch a.selected {
      color: #ffffff;
      background: #43c35e;
      border: 1px solid #43c35e; }
      .pipelineSwitch a.selected [class^='icon-']::before,
      .pipelineSwitch a.selected [class*=' icon-']::before,
      .timelineSwitch a.selected [class^='icon-']::before,
      .timelineSwitch a.selected [class*=' icon-']::before {
        color: #ffffff; }
    .pipelineSwitch a:active, .pipelineSwitch a.active,
    .timelineSwitch a:active,
    .timelineSwitch a.active {
      background: #7cc9ac;
      -webkit-box-shadow: inset 0 1px 2px rgba(38, 41, 44, 0.1);
      -moz-box-shadow: inset 0 1px 2px rgba(38, 41, 44, 0.1);
      box-shadow: inset 0 1px 2px rgba(38, 41, 44, 0.1); 
      color: #fff;
      
      }
    .pipelineSwitch a.disabled, .pipelineSwitch a.active.disabled, .pipelineSwitch a.disabled:active,
    .timelineSwitch a.disabled,
    .timelineSwitch a.active.disabled,
    .timelineSwitch a.disabled:active {
      opacity: 0.6;
      cursor: default; }
    .pipelineSwitch a.listBeta .icon-list,
    .timelineSwitch a.listBeta .icon-list {
      position: relative; }
      .pipelineSwitch a.listBeta .icon-list::after,
      .timelineSwitch a.listBeta .icon-list::after {
        content: 'B';
        position: absolute;
        bottom: 2px;
        right: -2px;
        padding: 0 0 0 1px;
        line-height: 9px;
        font-size: 9px;
        font-weight: 700;
        text-indent: 0;
        color: #000000;
        background-color: #f3f5f6;
        border-radius: 1px; }
    .pipelineSwitch a.listBeta.active .icon-list::after,
    .timelineSwitch a.listBeta.active .icon-list::after {
      background-color: #e0e4e7; }


.timelineActions {
    position: relative;
}
.pipelineActions {
    display: inline-block;
}
.timelineSwitch {
    display: inline-block;
    position: absolute;
    bottom:15px;
    left: 10px;
    width: 120px;
}
.pipelineSwitch {
    display: inline-block;   
    width: 120px;
}
.pipelineSwitch a:active, .pipelineSwitch a.active, .timelineSwitch a:active, .timelineSwitch a.active {
    -webkit-box-shadow: inset 0 1px 2px rgba(38, 41, 44, 0.1);
    -moz-box-shadow: inset 0 1px 2px rgba(38, 41, 44, 0.1);
    box-shadow: inset 0 1px 2px rgba(38, 41, 44, 0.1);
}
.pipelineSwitch a [class^='icon-'].icon-size-normal, .pipelineSwitch a [class*=' icon-'].icon-size-normal, .timelineSwitch a [class^='icon-'].icon-size-normal, .timelineSwitch a [class*=' icon-'].icon-size-normal {
    display: inline-block;
    padding-top: 1px;
}
.pipelineActions .button, .timelineActions .button {
    margin: 10px 10px 10px 0;
    vertical-align: top;
}

.pipelineActions .changePipeline, .pipelineActions .changeFilter, .timelineActions .changePipeline, .timelineActions .changeFilter {
    float: right;
    margin: 11px 14px 11px 0;
    max-width: 180px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.activityIndicator {
    float: right;
    position: relative;
    display: inline-block;
    vertical-align: top;
    margin: 10px 0 10px;
    height: 21px;
    width: 21px;
    padding: 5px;
}
.pipelineActions .activityIndicator, .timelineActions .activityIndicator {
    margin-right: 14px;
}

#pipelineContainer {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 100;
    padding: 30px;
    -webkit-transform: translateY(0);
    transform: translateY(0);
    -webkit-transition: -webkit-transform 0.2s ease-out, opacity 0.1s ease-in, background 0s linear 1s;
    -moz-transition: -webkit-transform 0.2s ease-out, opacity 0.1s ease-in, background 0s linear 1s;
    -ms-transition: -webkit-transform 0.2s ease-out, opacity 0.1s ease-in, background 0s linear 1s;
    -o-transition: -webkit-transform 0.2s ease-out, opacity 0.1s ease-in, background 0s linear 1s;
    transition: -webkit-transform 0.2s ease-out, opacity 0.1s ease-in, background 0s linear 1s;
}

#pipelineCanvas #pipelineContainer .pipeline {
    width: 100%;
    height: 91.2%;
    background-color: #f3f5f6 ;
}

#pipelineCanvas #pipelineContainer .pipeline table {
    width: 100%;
    height: 100%;
}

#pipelineCanvas #pipelineContainer .pipeline .stages {
    position: relative;
    padding: 0 0 0 0;
    border-top: 1px #c2c8cd solid;
    border-bottom: 1px #c2c8cd solid;
    overflow: visible;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    cursor: default;
}

    #pipelineCanvas #pipelineContainer .pipeline .stages.ready ul {
        -webkit-transition: opacity 0.14s ease-in;
        -moz-transition: opacity 0.14s ease-in;
        -ms-transition: opacity 0.14s ease-in;
        -o-transition: opacity 0.14s ease-in;
        transition: opacity 0.14s ease-in;
        opacity: 1;
    }
    
    #pipelineCanvas #pipelineContainer .pipeline .stages ul {
        width: 100%;
        display: table;
        border-collapse: collapse;
        table-layout: fixed;
        height: 60px;
        opacity: 0;
        -webkit-transition: opacity 0.07s linear;
        -moz-transition: opacity 0.07s linear;
        -ms-transition: opacity 0.07s linear;
        -o-transition: opacity 0.07s linear;
        transition: opacity 0.07s linear;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -ms-box-sizing: border-box;
        -o-box-sizing: border-box;
        box-sizing: border-box;
    }
    
    #pipelineCanvas #pipelineContainer .pipeline .stages ul li {
        display: table-cell;
        text-align: left;
        color: #fff;
        padding: 10px 25px 6px 12px;
        background-color: rgba(115, 149, 158, 0.80);
        /*background: url(../../images/stage-arrow.png) no-repeat 100% 0, linear-gradient(#ffffff, #f3f5f6);*/
        background-size: 20px 100%, 100% 100%;
        line-height: 1.3em;
        overflow: visible;
        vertical-align: middle;
        border-right: 1px #c2c8cd solid;
        position: relative;
    }
    #pipelineCanvas #pipelineContainer .pipeline .stages ul li:last-child{
        border-right: none;
    }
    #pipelineCanvas #pipelineContainer .pipeline .stages ul li .goalsWrapper {
        position: absolute;
        top: 50%;
        width: 200px;
        margin-top: -16px;
    }
    
        #pipelineCanvas #pipelineContainer .pipeline .stages ul li .goalsWrapper .goals {
            position: absolute;
            right: -35px;
            width: 32px;
            height: 32px;
        }
        
            #pipelineCanvas #pipelineContainer .pipeline .stages ul li .goalsWrapper .goals .goalSummary {
                display: block;
                position: absolute;
                top: -10000px;
                right: -10000px;
                width: 180px;
                padding: 10px;
                background-color: #3d4145;
                opacity: 0;
                z-index: 200;
                -webkit-border-radius: 6px;
                -moz-border-radius: 6px;
                border-radius: 6px;
                -webkit-transition: opacity 0.15s ease-in-out, top 0.01s linear 0.2s, right 0.01s linear 0.2s;
                -moz-transition: opacity 0.15s ease-in-out, top 0.01s linear 0.2s, right 0.01s linear 0.2s;
                -ms-transition: opacity 0.15s ease-in-out, top 0.01s linear 0.2s, right 0.01s linear 0.2s;
                -o-transition: opacity 0.15s ease-in-out, top 0.01s linear 0.2s, right 0.01s linear 0.2s;
                transition: opacity 0.15s ease-in-out, top 0.01s linear 0.2s, right 0.01s linear 0.2s;
            }
            
                #pipelineCanvas #pipelineContainer .pipeline .stages ul li .goalsWrapper .goals .goalSummary .chart {
                    position: absolute;
                    top: 10px;
                    right: 10px;
                }
                #pipelineCanvas #pipelineContainer .pipeline .stages ul li .goalsWrapper .goals .goalSummary span.title {
                    display: block;
                    min-height: 30px;
                    padding-right: 40px;
                    padding-bottom: 10px;
                    color: #ffffff;
                    font-size: 12px;
                    font-weight: bold;
                }
                #pipelineCanvas #pipelineContainer .pipeline table {
                    width: 100%;
                    height: 100%;
                }
                #pipelineCanvas #pipelineContainer .pipeline .stages ul li .goalsWrapper .goals .goalSummary span.smallTitle {
                    display: block;
                    margin-top: 10px;
                    padding-top: 6px;
                    border-top: 1px solid #3d4145;
                    font-size: 12px;
                    color: #c2c8cd;
                    font-weight: bold;
                }
                
    
    #pipelineCanvas #pipelineContainer .pipeline .stages ul li .stagename {
        text-align: center;
        font-size: 16px;
        line-height: 21px;
        width: 100%;
        display: inline-block;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        font-weight: bold;
        margin-bottom: 15px;
    }
    
    #pipelineCanvas #pipelineContainer .pipeline .stages ul li .stagevalue {
        position: absolute;
/*    right: 20px;*/
    bottom: -2px;
/*    text-align: right;*/
/*    width: 145px;*/
    width: 94%;
    display: block;
    height: 20px;
    line-height: 20px;
    }
    
        #pipelineCanvas #pipelineContainer .pipeline .stages ul li .stagevalue .value {
            opacity: 1;
            -webkit-transition: opacity 0.1s ease-in 0.05s;
            -moz-transition: opacity 0.1s ease-in 0.05s;
            -ms-transition: opacity 0.1s ease-in 0.05s;
            -o-transition: opacity 0.1s ease-in 0.05s;
            transition: opacity 0.1s ease-in 0.05s;
        }

#pipelineContainer .pipeline .deals.ready {
    opacity: 1;
    -webkit-transition: opacity 0.2s ease-in;
    -moz-transition: opacity 0.2s ease-in;
    -ms-transition: opacity 0.2s ease-in;
    -o-transition: opacity 0.2s ease-in;
    transition: opacity 0.2s ease-in;
}

#pipelineCanvas #pipelineContainer .pipeline .deals {
    height: 100%;
    -webkit-transition: opacity 0.07s ease-out;
    -moz-transition: opacity 0.07s ease-out;
    -ms-transition: opacity 0.07s ease-out;
    -o-transition: opacity 0.07s ease-out;
    transition: opacity 0.07s ease-out;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

#pipelineCanvas #pipelineContainer .pipeline .deals.hasScrollbar {
    overflow-y: scroll;
}

.dealsTable {
    width: 100%;
    height: 100%;
    display: table;
    border-collapse: collapse;
    table-layout: fixed;
}

.stage{
    display: table-cell;
    border-right: 1px solid transparent;
    border-color: #e0e4e7;
    
    text-align: left;
    background-color: #ffffff;
    -webkit-transition: background-color 0.05s ease-in-out;
    -moz-transition: background-color 0.05s ease-in-out;
    -ms-transition: background-color 0.05s ease-in-out;
    -o-transition: background-color 0.05s ease-in-out;
    transition: background-color 0.05s ease-in-out;
    position: relative;
}

#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li {
    position: relative;
    padding: 0px 0px;
    background-color: #F2F3F7;
    list-style: none;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border-bottom:1px solid #e0e4e7;
    
}
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .note{
    margin: 7px;
    display: block;
    max-height: 50px;
    padding: 6px 8px;
    font-size: 12px;
    line-height: 17px;
    color: #3d4145;
    background-color: #ffffdd;
    border: 1px solid rgba(0, 0, 0, 0.16);
    overflow-y: auto;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    text-align: left;
}
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li.over {
    border: 2px dashed #000;
}
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage.dragOver {
    background-color: #e0e4e7;
}
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage.dragOver li {
    -webkit-transition: opacity 0.05s ease-in-out;
    -moz-transition: opacity 0.05s ease-in-out;
    -ms-transition: opacity 0.05s ease-in-out;
    -o-transition: opacity 0.05s ease-in-out;
    transition: opacity 0.05s ease-in-out;
    opacity: 0.6;
}
li.warning.status-open {
    border-bottom: none;
}

#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .block {
    display: table-cell;
    width: 100%;
    position: relative;
    min-height: 50px;
    margin: 0;
    border: none;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .block .front {
    display: block;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    padding:10px 15px 6px 10px;
    /* white-space: nowrap;
    text-overflow: ellipsis; */
    overflow: hidden;
    text-decoration: none;
    color: #26292c;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -ms-box-sizing: border-box;
    -o-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    -o-backface-visibility: hidden;
    backface-visibility: hidden; }
    #pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .block .front small {
        font-size: 12px;
        line-height: 16px;
        padding: 3px 0px;
        color: #888e94;
        text-overflow: ellipsis;
        display: block;
        -webkit-transition: color 0.1s ease-in-out;
        -moz-transition: color 0.1s ease-in-out;
        -ms-transition: color 0.1s ease-in-out;
        -o-transition: color 0.1s ease-in-out;
        transition: color 0.1s ease-in-out; }
    #pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .block .front strong {
        font-weight: normal;
        display: block;
        /* text-overflow: ellipsis;
        white-space: nowrap; */
        overflow: hidden;
        cursor: pointer;
        padding: 1px 0;
        font-size: 14px;
        line-height: 18px;
        -webkit-transition: color 0.1s ease-in-out;
        -moz-transition: color 0.1s ease-in-out;
        -ms-transition: color 0.1s ease-in-out;
        -o-transition: color 0.1s ease-in-out;
        transition: color 0.1s ease-in-out; }
        #pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .block .front strong img {
            height: 16px;
            margin: 1px 5px 0 0;
            vertical-align: top; }
    #pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .block .front .detail {
        margin-right: 5px !important; }
    #pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .block .front {
        word-break: break-word;
        word-wrap: break-word;
        -webkit-transform: rotateX(0deg);
        -moz-transform: rotateX(0deg);
        -ms-transform: rotateX(0deg);
        -o-transform: rotateX(0deg);
        transform: rotateX(0deg);
        -webkit-transition: -webkit-transform 0.4s ease-in-out;
        -moz-transition: -moz-transform 0.4s ease-in-out;
        -o-transition: -o-transform 0.4s ease-in-out;
        transition: transform 0.4s ease-in-out;
    /* &:active {
        background-color: rgba(0,0,0,.2);
    } */ }
    #pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .block .front:hover {
      color: #26292c; }
      #pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .block .front:hover small {
        color: #3d4145; }
    #pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .block .front .style {
      display: none; }
  #pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .block a {
    outline: none; }
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .labels {
  display: table-cell;
  vertical-align: middle;
  min-width: 1px; }
  
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .icon {
    position: absolute;
    top: 50%;
    right: 0;
    width: 17px;
    height: 17px;
    margin: -9px 5px 0 0;
    cursor: pointer;
    cursor: hand;
    z-index: 51;
    text-align: center;
    font-size: 17px;
}

#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li .icon::after {
    position: absolute;
    top: 0;
    left: 0;
    width: 18px;
    height: 16px;
    content: '';
    background-image: url("../images/icons/activity-states.png");
    background-size: 127px 16px;
}

#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li.warning .icon::after {
  background-position: -72px 0; }
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li.overdue .icon::after {
  background-position: -54px 0; }
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li.today .icon::after {
  background-position: -36px 0; }
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li.future .icon::after {
  background-position: -18px 0; }
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li.rotten .icon:not(.active)::after, #pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li.status-won .icon:not(.active)::after {
  background-position: 0 0; }
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li.warning.rotten .icon:not(.active)::after, #pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li.warning.status-won .icon:not(.active)::after {
  background-position: -90px 0; }
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li.spinning .icon::after {
  background-image: none !important; }
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li.spinning .spinner {
  display: block; }
  
#pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li.status-open, #pipelineCanvas #pipelineContainer .pipeline .deals .dealsTable .stage ul li.status-deleted {
    border-bottom-color: #e0e4e7;
}

/* Modal Add Pipeline */
.form-add-deal label{
    display: block;
    padding: 0 0 2px;
    line-height: 19px;
    font-size: 14px;
    color: rgba(38, 41, 44, 0.64);
    font-weight: normal;
}

.form-add-deal i{
    color: #000;
}

.stageOptionWrapper{
    display: block;
    position: relative;
    min-height: 32px;
}

.stageOptionWrapper .options {
    display: table;
    width: 100%;
    overflow: hidden;
    margin-bottom: 4px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    table-layout: fixed;
}

.stageOptionWrapper label.active {
    background: #43c35e;
}

.stageOptionWrapper label {
    height: 28px;
    cursor: pointer;
    display: table-cell;
    text-align: center;
    padding: 0;
    font-size: 12px;
    font-weight: bold;
    color: #ffffff;
    background: #43c35e;
    position: relative;
}

.stageOptionWrapper label.active::before {
    background: #43c35e;
}

.stageOptionWrapper label::before {
    width: 20px;
    height: 24px;
    position: absolute;
    right: -11px;
    top: 2px;
    border-top: 3px solid #ffffff;
    border-right: 3px solid #ffffff;
    -webkit-transform: scaleX(0.3) rotate(45deg);
    -moz-transform: scaleX(0.3) rotate(45deg);
    -ms-transform: scaleX(0.3) rotate(45deg);
    -o-transform: scaleX(0.3) rotate(45deg);
    transform: scaleX(0.3) rotate(45deg);
    content: " ";
    background: #43c35e;
    cursor: pointer;
    z-index: 1;
}

.stageOptionWrapper label input {
    width: auto;
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.stageOptionWrapper label.active ~ label {
    background: #e0e4e7;
}
.stageOptionWrapper label.active ~ label::before {
    background: #e0e4e7;
}
#modalAddNewDeal{
    padding: 0px !important;
    height: 511px;
}
#modalAddnewScheduleActivity{
    padding: 0px !important;
    height: 630px;
}
#tabcontent ul li {
    margin: 0px;
}
#tabcontent ul li a {
    padding: 0px;
}
.hiden {
    display: none !important;
}
.popover-title{
    background-color: #fff;
}
.popover {
    background-color: #fff;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1010;
    display: none;
    width: 300px;
    text-align: left;
    white-space: normal; 
    border: 1px solid rgba(0, 0, 0, 0.16);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 4px 8px rgba(0, 0, 0, 0.16);
    -moz-box-shadow: 0 4px 8px rgba(0, 0, 0, 0.16);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.16);
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.popover-content {
    border-bottom-left-radius: 2px;
    border-bottom-right-radius: 2px;
    min-height: 20px;
    line-height: 20px;
    font-size: 14px;
    text-align: center;
    padding: 0px;
}
/*end opportunity.css*/
#oSrchBar {
    background: #f1f5f7;
    padding: 15px;
}
.oBtnAdd {
    background: #4e9a7b;
}
.btn {
    display: inline-block;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
}
.statsTabContent {
    padding: 0px 1px 0px 0px;    
}
.statsTabContent:hover {
    overflow-y: hidden;
}
.customerProfileHolder{
    margin: 0px;
}
.form-group {
    margin-right: 15px;
}
.ui-autocomplete {
    max-height: 300px;
    overflow-y: auto;
    overflow-x: hidden;
}

.well {
    margin: 5px 0;
}

.m-top-50 {
    margin-top: 50px;
}

.m-top-15 {
    margin-top: 15px;
}
a {
    color: #4e9a7b;
    text-decoration: none;
}
.pointer-events-none{
    pointer-events: none;
}
.ui-menu.ui-widget.ui-widget-content.ui-autocomplete.ui-front{
    z-index: 1051;
}
</style>