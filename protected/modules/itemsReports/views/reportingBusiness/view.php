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
}
.headertable{
	background-color: #8ca7ae;
}
.headertable td{
    color: #fff;
    font-family: helveticaneuelight;
    letter-spacing: 2px;
}
.title-report{font-size: 17px;}
#return_content .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{ padding: 8px;vertical-align: bottom;font-size: 15px; }

.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th
{
    border:1px solid #fff;
}
.executive tbody td, .monthly tbody td,.customerspend tbody td,.servicevenue tbody td{
    background-color: #f1f5f6;
}
table td,.executive th{text-align: center;}
.sort-field td{
	font-size: 11px;
}
.border-left{
	border-left: 2px solid #ddd;
}
.border-right{
	border-right: 1px solid #ddd;
}
.link_more{
	text-align: right;
}
.link_more a{
	color: #337ab7;
    text-decoration: underline;
    font-size: 10.5px;
}
.text-align-right{
    text-align: right;
}
.futurevalue tr,.customerspend tr{
    border-bottom: 1px solid #ddd;
}
#return_content hr{
    border: 1px solid #484848;
}
.total td{
    font-weight: bold;
}
.type-report{
    font-size: 20pt;
    text-transform: uppercase;
    color: #7cc9ac;
    float: left;
}
.time-report{
    font-family: helveticaneue;
    float: right;margin-top: 15px
}
</style>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/excel/jquery.table2excel.min.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/excel/jquery.tabletoCSV.js" charset="utf-8"></script>

<div id="oSrchBar" class="col-md-12">
    <?php include_once('_frmSearch.php') ?>
</div>
<div id="idwaiting_search"></div>
<div class="col-md-12 margin-top-20" id="return_content" style="overflow: auto;">

</div>

<script type="text/javascript">
    $('.btn_excel').click(function(){
      $('#list_export').table2excel({
          name: "file",
          filename: "DanhSach",
          fileext: ".xls"
      });
    });  
    $('.word').click(function(){
      $('#list_export').table2excel({
          name: "file",
          filename: "DanhSach",
          fileext: ".doc"
      });
   });  
    $(function(){
      $(".csv").click(function(){
          $("#list_export").tableToCSV(
            );
      });
  });
</script>