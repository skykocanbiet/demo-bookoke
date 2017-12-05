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

.tableList thead tr th{
  background: rgba(115, 149, 158, 0.80);
  color     : #fff;
}
.tableList tbody tr td {
  background: #f1f5f6;
}
.tableQuote tbody .form-group {
  margin: -9px 0 5px;
}
.tableQuote tbody input {
  background: #f1f5f6;
}

.tableList tr[aria-expanded="true"] {
  background: #c4e2c7 !important;
}

#profileSideNav ul li a i{
    font-size:2em;  
}
.itemsPromotions li {
    line-height: 24px;
}
.btn_aQuote {
  padding    : 0;
  line-height: 28px;
  width      : 30px;
}

body {overflow-y: hidden;}

.no_pay {background: #c8c8c8 !important; color: black !important; cursor: not-allowed}


#rightsidebar {padding: 0;}
#profileSideNav ul li a i{ font-size:2em;}
#oSrchBar{background: white; padding: 15px;}

.form-group {margin-right: 10px;}
.hiddenRow { padding: 1px !important; background: #fff !important;}
.hiddenRow:hover {background: white;}
.hiddenRow td{background: white !important;}
tr.accordion-toggle {cursor: pointer;}
td.hiddenRow {border: 0 !important;}

.oView {padding: 10px 0;}
.oViewB {
  padding                   : 0; 
  margin                    : 0 0 15px;
  border-top                : 0;
  border                    : 1px solid #ccc;
  border-bottom-right-radius: 10px;
  border-bottom-left-radius : 10px;
}

.oViewB thead tr th {background: #C0BFBF;}

.oViewB tbody tr.deta td:nth-child(1),
.oViewB thead tr th:nth-child(1) {
  width: 16%;
}
.oViewB tbody tr.deta td:nth-child(2),
.oViewB thead tr th:nth-child(2) {
  width: 38%;
}

.oViewB .sum td{border: 0;}

.oViewDetail p {margin-bottom: 5px;}

.oBtnG {background: #c8c8c8}
.oBtnDel {background: #5e5e5f; color: white;}
.oBtnOr {background: #f49333;}
.sVal {padding-top: 7px;}
.owe {color: red;}
.oBtnAdd {background: #0eb1dc;}

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

.tableList{padding: 10px 15px;}

.tableList>.table>thead, .tableList>.table>tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;
}
.tableList thead {
    color: #fff;
    background-color: rgba(115, 149, 158, 0.80);
}
.tableList>.table>tbody {
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
#oInfo table th, #oInfo table td{padding: 5px;}
#pBtn {padding: 15px;}
#oInfo {padding-bottom: 5px;}
#btnReport {color: black;}

</style>

<div class="row full-height">
   <div  id="profileSideNav"  class="span1 primary-navbar col-sm-2 col-md-1">
       <ul class="nav nav-tab nav-stacked" id="myTab">

           <li id="profile_preview_nav" <?php if($controller == 'dealselitedental') echo "class='active'"; ?> >
               <a href="<?php echo $baseUrl; ?>/itemsSales/Dealselitedental/View" >
                   <img src="<?php echo $baseUrl;?>/images/icon_sb_left/5_Kinh_doanh/khuyen_mai_def.png" /> <br>
                   Khuyến Mãi
               </a>
           </li>
 
           <li id="profile_configure_nav" <?php if($controller == 'quotations') echo "class='active'"; ?>>
               <a href="<?php echo $baseUrl; ?>/itemsSales/quotations/view">
                   <img src="<?php echo $baseUrl;?>/images/icon_sb_left/5_Kinh_doanh/bao_gia_def.png" /> <br>
                   Báo giá
               </a>
           </li>
           
           <li id="profile_embed_nav" <?php if($controller == 'order') echo "class='active'"; ?>>
               <a href="<?php echo $baseUrl; ?>/itemsSales/order/View" >
                   <img src="<?php echo $baseUrl;?>/images/icon_sb_left/5_Kinh_doanh/don_hang_def.png" /> <br>
                    Điều trị
               </a>
           </li>
           <li id="profile_embed_nav" <?php if($controller == 'invoices') echo "class='active'"; ?>>
               <a href="<?php echo $baseUrl; ?>/itemsSales/invoices/View">
                   <img src="<?php echo $baseUrl;?>/images/icon_sb_left/5_Kinh_doanh/hoa_don_def.png" /> <br>
                    Hóa đơn
               </a>
           </li>
           <!-- <li id="profile_embed_nav">
               <a href="#embed/website">
                   <i class="fa fa-truck" aria-hidden="true"></i><br>
                    Giao nhận
               </a>
           </li> -->
       </ul>
   </div>
    
    <div  id="rightsidebar" class="col-sm-10 col-md-11">
        <?php echo $content; ?>
    </div>

    <!-- modal báo giá-->
<div id="quote_modal" class="modal fade">

</div>

<script type="text/javascript">

    
$( document ).ready(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();

    $('#profileSideNav').height(windowHeight-header);
    $('.customerListContainer').height(windowHeight-header);
    $('#detailCustomer').height(windowHeight-header);
});
</script>
<?php $this->endContent(); ?>