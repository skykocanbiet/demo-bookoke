<?php $baseUrl = Yii::app()->baseUrl;?>
<style type="text/css">
.sHeader {
    background: #e6e6e5;
    color: #5a5a5a;
    padding: 10px 15px 5px 15px;
    font-size: 18px;
    text-transform: uppercase;
}
#return_popup_content{
    padding: 25px;
}
#return_content{
    margin-top: 5px;
    overflow-y: auto;
}
.headertable{
	background-color: #ddd;
}
.title-report{
	word-wrap: break-word;
    white-space: pre-wrap;
    padding-left: 0pt;
    padding-top: 0pt;
    padding-right: 0pt;
    padding-bottom: 0pt;
    border: 1pt none Black;
    background-color: Transparent;
    font-style: normal;
    font-family: Arial;
    font-size: 20pt;
    font-weight: 700;
    text-decoration: none;
    unicode-bidi: normal;
    color: Black;
    direction: ltr;
    layout-flow: horizontal;
    writing-mode: lr-tb;
    vertical-align: top;
    text-align: left;
}
.customer-name{
	word-wrap: break-word;
    white-space: pre-wrap;
    padding-left: 0pt;
    padding-top: 0pt;
    padding-right: 0pt;
    padding-bottom: 0pt;
    border: 1pt none Black;
    background-color: Transparent;
    font-style: normal;
    font-family: Arial;
    font-size: 15pt;
    font-weight: 700;
    text-decoration: none;
    unicode-bidi: normal;
    color: DimGray;
    direction: ltr;
    layout-flow: horizontal;
    writing-mode: lr-tb;
    vertical-align: top;
    text-align: left;
}
.id-report{
	font-family: Arial;
    font-size: 8pt;
    font-weight: 400;
    font-style: normal;
    text-decoration: underline;
    color: Blue;
}
.total-customer{
	word-wrap: break-word;
    white-space: pre-wrap;
    font-style: normal;
    font-family: Arial;
    font-size: 8pt;
    font-weight: 700;
    text-decoration: none;
    unicode-bidi: normal;
    color: Black;
    direction: ltr;
    layout-flow: horizontal;
    writing-mode: lr-tb;
    vertical-align: top;
    text-align: left;
}
#return_content .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{ padding: 3px;vertical-align: bottom; }
.text-align-center{
	text-align: center;
}
.sort-field td{
	font-size: 11px;
}
.border-left{
	border-left: 2px solid #ddd;
}
.border-right{
	border-right: 2px solid #ddd;
}
#return_content hr{
    border: 1px solid #484848;
}
.table-responsive {
    min-height: .01%;
    overflow-x: hidden;
}
.ss{
    overflow-y: auto;
    height: 200px;
}
</style>
<div id="oSrchBar" class="col-md-12">
    <?php include_once('_frmSearch_1.php') ?>
</div>
<div class="col-md-12 margin-top-20 ss" id="return_content">	
	
</div>
<script type="text/javascript">
    $( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var head = $('#oSrchBar').height();
   
    $('#return_content').height(windowHeight-header-head-37);
   
   
     detailreport(0);
});
</script>