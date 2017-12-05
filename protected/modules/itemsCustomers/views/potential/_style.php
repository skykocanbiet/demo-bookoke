<style>
.error{
        border: 1px solid red !important;
        background-color: #ccc !important;
    }
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
/*lmv*/

    .search_deals{
        float: right;
        width: 70%;
        margin-right: 10px;
        
    }
    .ss{
        margin-top: 20px;
        margin-bottom: 10px;
    }
    .add_deals{
            border-radius: 3px;
            font-weight: bold;
            font-size: 20px;
            line-height: 28px;
            height: 30px;
            width: 30px;
            padding: 0px;
            float: right;
            border: solid 1px #D7D7D7;
            background: #4e9a7b;
            text-decoration: none;
            color: #FFF;
            text-indent: 0px;
            text-align: center;
    }
    .head th{
        text-align: left;
        margin-top: 10px;
    }
     #tbhead{
        color: #fff;
        background: rgba(115, 149, 158, 0.80);
    }
    .dealstbl{
        margin-top: 10px;

    }
    #add_deals .modal-content{
        border-radius: 0px;
    }
    #add_deals .modal-dialog {
        width: 900px;
        margin: 40px auto;
    }
    #edit_deals .modal-dialog {
        width: 900px;
        margin: 40px auto;
    }
    
    #add_deals .add{
        text-align: left;
    }
    #add_deals .abc{
            width: 80%;
            float: right;
    }
    #add_deals label{
        margin: 8px 0px;
    }
    #editdeals label{
        margin: 8px 0px;
    }
    .detail label{
        font-family:;
        font-weight: normal;

    }
    .detail{
        margin:5px 0px;
    }
    .trdetail{
        background-color: #f1f5f7;
    }
    #image-holder img{
        width: 100%;
    }
    tbody{
        
        height: 50px;
        overflow-y: auto;
    }
        .sp{
     border-left: 5px solid #22baa0;
    }
    .runding{

    border-left: 5px solid #21ba45;
    }
    .pause{
    border-left: 5px solid #fbbd08;
    
    }
    .endsed{
    border-left: 5px solid #767676;

    }
    .remove{
    border-left: 5px solid #db2828;
    }
    .ghichu li{
        display: inline-block;
        padding: 0px 6px;
    }
    .sp1{
    width: 0.5em;
    height: 0.5em;
    background-color: #22baa0;
    display: block;
    float: left;
    margin-top: 5px;
    margin-right: 5px;
   }
    .runding2{
    width: 0.5em;
    height: 0.5em;
    background-color: #21ba45;
    display: block;
    float: left;
    margin-top: 5px;
    margin-right: 5px;
   
    }
    .pause3{
    width: 0.5em;
    height: 0.5em;
    background-color: #fbbd08;
    display: block;
    float: left;
    margin-top: 5px;
    margin-right: 5px;
    }
    .endsed4{
    width: 0.5em;
    height: 0.5em;
    background-color: #767676;
    display: block;
    float: left;
    margin-top: 5px;
    margin-right: 5px;
    }
    .remove5{
    width: 0.5em;
    height: 0.5em;
    background-color: #db2828;
    display: block;
    float: left;
    margin-top: 5px;
    margin-right: 5px;
    }
    #add th{
            text-align: left;
            background: #8ca7ae;
            border-right: 1px solid #fff;
            color: #fff;
            font-weight: 300;
    }
    #add tfoot td{
        text-align: left;
    }
    #add tbody td{
        background-color: #f1f5f6;
    }
    #giamtheogiatri{
        margin-top: 20px;
    }
    #giamtheogiatri th{
            text-align: left;
            background: #8ca7ae;
            border-right: 1px solid #fff;
            color: #fff;
            font-weight: 300;
    }
    #giamtheogiatri tfoot td{
        text-align: left;
    }
    #giamtheogiatri tbody td{
        background-color: #f1f5f6;
    }
    
    #editservice th{
            text-align: left;
            background: #8ca7ae;
            border-right: 1px solid #fff;
            color: #fff;
            font-weight: 300;
    }
    #editservice tfoot td{
        text-align: left;
    }
    #editservice tbody td{
        background-color: #f1f5f6;
    }
    .error{
        border: 1px solid red;
        background-color: #ccc;
    }
#profileSideNav ul li a i{
    font-size:2em;  
}
.itemsPromotions li {
    line-height: 24px;
}  
/*#tbl_deal .tbody {
    display:block;
    height:50px;
    overflow:auto;
}*/
#tbl_deal .tbhead, .tbody, .sss  {
   
    display:table;
    width:100%;
    table-layout:fixed;/* even columns width , fix width of table too*/
}
#tbl_deal .tbhead {
    width: calc( 100% - 1em )/ scrollbar is average 1em/16px width, remove it from thead width /
}
#tbl_deal tbody tr td{
        text-align: center;
    background-color: #f1f5f6;
    border-bottom: 2px solid #fff !important;
    color: #464646;
    vertical-align: bottom;
}
#tbl_deal  thead th{
    text-align: center;
}
#tbl_deal tbody tr{
        border-bottom: 1px solid #ecebeb;
}
.deals_tbl .tbhead{
    color: #fff;
    background-color: rgba(115, 149, 158, 0.80);
}  
.btn1{
    border-radius: 0px;
    background-color: #7ccaac;
    border-color: #7ccaac;
    width: 19%;

}
.btn1:focus, .btn1:hover {
        background-color: #46c649;
    border:0px solid ;
    border-color: #46c649;
} 
.add-schedules{
    border-radius: 4px;
    border:1px solid #ccc;
    margin-top: 20px;
    padding: 10px 15px;

}
.in1{
    height:34px; border-radius:4px; border:1px solid #ccc;
}
.hed{
    background-color: #ccc;
    margin-top: -10px;
    height: 37px;
}
/*end*/
</style>