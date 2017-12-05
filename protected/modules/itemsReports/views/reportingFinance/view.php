 <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/excel/jquery.table2excel.min.js"></script>
 <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/excel/jquery.tabletoCSV.js" charset="utf-8"></script> 
<?php
include 'style.php';
 $baseUrl = Yii::app()->baseUrl;
$today = date('m/d/Y ');
  $month = strtotime(date("m/d/Y", strtotime($today)) . " +1 month");
  $month = strftime("%m/%d/%Y", $month);
?>

<div id="oSrchBar" class="col-md-12">
    <?php include_once('_frmSearch.php') ?>
</div>
<div id="idwaiting_search"></div>
<div class="col-md-12 margin-top-20" id="return_content" style="overflow: auto;">

</div>
<script type="text/javascript">
$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#oSrchBar").height();
     $('#return_content').height(windowHeight-header-tab_menu-45);
});

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