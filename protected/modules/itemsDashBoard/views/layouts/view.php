<?php $baseUrl = Yii::app()->getBaseUrl(); ?>
<?php $this->beginContent('//layouts/layouts_menu'); ?>

<?php 

    $controller = Yii::app()->getController()->getAction()->controller->id;
    $action     = Yii::app()->getController()->getAction()->controller->action->id;
?>


<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/jqtransform.css" />
<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/setting.css" />
<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/customers_new.css" />

<!-- PAINT -->
<link rel="Stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/js/paint/wPaint.min.css" />
<!-- END PAINT -->

<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>

<style type="text/css">
#profileSideNav ul li a i{
    font-size:2em;  
}
.itemsPromotions li {
    line-height: 24px;
} 

body {overflow-y: hidden;}

.no_pay {background: #c8c8c8 !important; color: black !important; cursor: not-allowed}

.btn{color: white;}
input {border-radius: 0;}
a {color: black}
#rightsidebar {padding: 0;}
#profileSideNav ul li a i{ font-size:2em;}
#oSrchBar{background: #f1f5f7;padding: 15px;}

.form-group {margin-right: 15px;}
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

#oInfo table tr{display: inherit;}

#pBtn {padding: 10px;}
#oInfo {padding-bottom: 5px;}
#btnReport {color: black;}

</style>

<div class="row wrapper tab-content full-height">

<div  id="profileSideNav"  class="span1 primary-navbar col-sm-2 col-md-1">
    <ul class="nav nav-tab nav-stacked" id="myTab">

        <li id="profile_preview_nav" class="active">
            <a href="/itemsDashBoard/DashBoardBusiness/index" data-toggle="tab">
                <img src="<?php echo $baseUrl;?>/images/icon_sb_left/1_tong_quan/kinh_doanh_<?php if($controller == 'dashBoardBusiness'){ echo "act"; }else{ echo 'def'; } ?>.png" /> <br>
                Kinh Doanh
            </a>
        </li>

   <!--      <li id="profile_configure_nav">
            <a href="#configure/company_details" data-toggle="tab">
                <img src="<?php echo $baseUrl;?>/images/icon_sb_left/1_tong_quan/nhan_vien_<?php if($controller == 'nhanvien'){ echo "act"; }else{ echo 'def'; } ?>.png" /> <br>
                Nhân viên
            </a>
        </li>
        
        <li id="profile_embed_nav">
            <a href="#embed/website" data-toggle="tab">
                <img src="<?php echo $baseUrl;?>/images/icon_sb_left/1_tong_quan/hoat_dong_<?php if($controller == 'hoatdong'){ echo "act"; }else{ echo 'def'; } ?>.png" /> <br>
                Hoạt động
            </a>
        </li>
 -->
    </ul>
</div>

    <div  id="rightsidebar" class="col-sm-10 col-md-11">
            <?php echo $content; ?>
    </div>

</div>
  

<?php $this->endContent(); ?>

<?php  include_once('_js.php'); ?>