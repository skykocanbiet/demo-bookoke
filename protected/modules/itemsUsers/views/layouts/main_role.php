<?php $baseUrl = Yii::app()->getBaseUrl(); ?>
<?php $this->beginContent('//layouts/layouts_menu'); ?>

<?php
    $controller = Yii::app()->getController()->getAction()->controller->id;
    $action     = Yii::app()->getController()->getAction()->controller->action->id;
?>


<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/jqtransform.css" />
<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/setting.css" />
<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/customers_new.css" />

<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>

<style type="text/css">
#profileSideNav ul li a i{
    font-size:2em;  
}
.itemsPromotions li {
    line-height: 24px;
}
#profileSideNav ul li{ margin-top: 0px; }

body {overflow-y: hidden;}

.no_pay {background: #c8c8c8 !important; color: black !important; cursor: not-allowed}

.btn{color: white;}
input {border-radius: 0;}
a {color: black}

#profileSideNav ul li a i{ 
    font-size:2em; display: block;
}

#oSrchBar{background: #f1f5f7;padding: 20px;}

.form-group {margin-right: 10px;}
.hiddenRow { padding: 0 !important; }
.hiddenRow:hover {background: white;}
tr.accordion-toggle {cursor: pointer;}
td.hiddenRow {border: 0 !important;}

.oView {padding: 10px 0;}
.oViewB {background: #f4f7f7; padding: 0 0 15px; margin: 0 0 15px;}
.oViewB .sum td{border: 0;}
.oViewB table.table {background: #f4f7f7;}
.oViewB table.table thead{background: #e1e7eb; color: black;}
.oViewB table tr td, .oViewB table tr th{border: 1px solid white;}

.oViewDetail p {margin-bottom: 5px;}

.oBtnG {background: #c8c8c8}
.oBtnDel {background: #5e5e5f; color: white;}
.oBtnOr {background: #f49333;}
.oBtnDetail {background: #94c63f;}
.oBtnDetail:hover {background: #c8c8c8}
.sVal {padding-top: 7px;}
.owe {color: red;}
.oBtnAdd {background: #0eb1dc;}
.Submit{background: #94c63f}

.table>thead>tr>th,
.table>tbody>tr>th,
.table>tfoot>tr>th,
.table>thead>tr>td,
.table>tbody>tr>td,
.table>tfoot>tr>td {
    padding: 8px;
    vertical-align: top;
    border-top: 0
}

table th, table td {
    text-align: center;
}

.tableList{padding: 30px;}

.tableList>.table>thead, .tableList>.table>tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;
}
.tableList thead {
    color: #fff;
    background-color: rgba(115, 149, 158, 0.80);
}
.tableList .table>tbody {
  display: block;
  overflow: auto;
  max-height: 625px;
}

.w1{width: 10%}
.w2{width: 15%}
.w3{width: 10%}
.w4{width: 10%}
.w5{width: 10%}
.w6{width: 10%}
.w7{width: 10%}

.qc3{width: 8.5%}
.qc5{width: 8%}
/* .qc1{width: 30%}
.qc2{width: 12%}
.qc4{width: 13.5%}
.qc6{width: 13.5%}
.qc8{width: 10%} */

.tr_col {background: #F2F2F2;}
.accordion-toggle[aria-expanded='true'] {background: #c4e2c7 !important}

.div_trang {
    width: 30px;
    padding: 5px 10px 5px 10px;
    text-align: center;
    margin: 2px;
}

.fix_bottom {
    position: fixed;
    bottom: 2%;
    right: 40%;
}

.txt_treat {
  padding: 25px 0 0;
}

.line {border-top: 2px solid #ddd;}

#order_pay_modal .alert{margin-bottom: 0px;}
.alert h3{margin-top: 0px;}

.input-group-addon {cursor: pointer;}

#oInfo table tr{display: inherit;}

#pBtn {padding: 10px;}
#oInfo {padding-bottom: 5px;}
#btnReport {color: black;}

</style>

<div class="row wrapper tab-content full-height">

   <div  id="profileSideNav"  class="span1 primary-navbar col-sm-2 col-md-1">
       <ul class="nav nav-tab nav-stacked" id="myTab">

            <li id="profile_preview_nav" class="<?php if($controller == 'company') echo "active"; ?>">
                <a href="<?php echo $baseUrl; ?>/itemsSetting/Company/view" >
                    <img src="<?php echo $baseUrl;?>/images/icon_sb_left/10_thiet_lap/doanh-nghiep_<?php if($controller == 'company'){ echo "act"; }else{ echo 'def'; } ?>.png" /> <br>
                    Doanh nghiệp
                </a>
            </li>

            <li id="profile_preview_nav" class="<?php if($controller == 'settingLocations') echo "active"; ?>">
                <a href="<?php echo $baseUrl; ?>/itemsSetting/SettingLocations/View">
                    <img src="<?php echo $baseUrl;?>/images/icon_sb_left/10_thiet_lap/location_<?php if($controller == 'settingLocations'){ echo "act"; }else{ echo 'def'; } ?>.png" /> <br>
                    Chi Nhánh
                </a>
            </li>

            <li id="profile_configure_nav">
                <a href="#configure/company_details" data-toggle="tab">
                    <img src="<?php echo $baseUrl;?>/images/icon_sb_left/10_thiet_lap/tong_dai_<?php if($controller == 'settingTongdai'){ echo "act"; }else{ echo 'def'; } ?>.png" /> <br>
                    Tổng đài
                </a>
            </li>
            
            <li id="profile_embed_nav">
                <a href="#embed/website" data-toggle="tab">
                    <img src="<?php echo $baseUrl;?>/images/icon_sb_left/10_thiet_lap/website_<?php if($controller == 'settingWebsite'){ echo "act"; }else{ echo 'def'; } ?>.png" /> <br>
                     Website
                </a>
            </li>

            <li id="profile_embed_nav">
                <a href="#embed/website" data-toggle="tab">
                    <img src="<?php echo $baseUrl;?>/images/icon_sb_left/10_thiet_lap/tin_nhan_<?php if($controller == 'settingWebsite'){ echo "act"; }else{ echo 'def'; } ?>.png" /> <br>
                     Tin nhắn
                </a>
            </li>

            <li id="profile_embed_nav">
                <a href="#embed/website" data-toggle="tab">
                    <img src="<?php echo $baseUrl;?>/images/icon_sb_left/10_thiet_lap/thong_bao_<?php if($controller == 'settingThongBao'){ echo "act"; }else{ echo 'def'; } ?>.png" /> <br>
                     Thông báo
                </a>
            </li>

            <li id="profile_embed_nav">
                <a href="#embed/website" data-toggle="tab">
                    <img src="<?php echo $baseUrl;?>/images/icon_sb_left/10_thiet_lap/mxh_<?php if($controller == 'settingMxh'){ echo "act"; }else{ echo 'def'; } ?>.png" /> <br>
                     Mạng xã hội
                </a>
            </li>

            <li id="profile_embed_nav">
                <a href="<?php echo $baseUrl; ?>/itemsDashBoard/CsTarget/View" >
                    <img src="<?php echo $baseUrl;?>/images/icon_sb_left/7_tai_chinh/dogn_tien_def.png" /> <br>
                     Chỉ Tiêu
                </a>
            </li>

             <li id="profile_embed_nav" class="active">
                <a href="<?php echo $baseUrl; ?>/itemsUsers/Role/Manager" >
                    <i class="fa fa-user-secret" aria-hidden="true"></i>
                     Phân quyền
                </a>
            </li>

       </ul>
   </div>
    
   
    <div  id="rightsidebar" class="col-sm-10 col-md-11">
        <?php echo $content; ?>
    </div>

</div>

<script type="text/javascript">
    
$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();

    $('#profileSideNav').height(windowHeight-header);
    $('.customerListContainer').height(windowHeight-header);
    $('#detailCustomer').height(windowHeight-header);

    $('.cal-loading').fadeOut('slow');

});


$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();

    $('#profileSideNav').height(windowHeight-header);
    $('.customerListContainer').height(windowHeight-header);
    $('#detailCustomer').height(windowHeight-header);

});
</script>

<?php $this->endContent(); ?>