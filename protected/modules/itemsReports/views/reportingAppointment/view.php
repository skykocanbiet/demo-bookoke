
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/excel/jquery.table2excel.min.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/excel/jquery.tabletoCSV.js" charset="utf-8"></script>
<?php $baseUrl = Yii::app()->baseUrl;?>
<?php include_once('style.php'); ?>
<div id="oSrchBar" class="col-md-12">
    <?php include_once('_frmSearch.php'); ?>
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