<div id="book_process">
	<ul class="list-inline">
		<!-- <li><span class="process book_pc_tt fbBr">VĂN PHÒNG</span></li>
	  	<li><span class="glyphicon glyphicon-menu-right"></span></li> -->
	  	<li><span class="process book_pc_tt fbSv"><?php echo Yii::t('translate','sv'); ?></span></li>
	  	<li><span class="glyphicon glyphicon-menu-right"></span></li>
	  	<li><span class="process book_pc_tt fbPv"><?php echo Yii::t('translate','pv'); ?></span></li>
	  	<li><span class="glyphicon glyphicon-menu-right"></span></li>
	  	<li><span class="process book_pc_tt fbDt"><?php echo Yii::t('translate','date'); ?></span></li>
	  	<li><span class="glyphicon glyphicon-menu-right"></span></li>
	  	<li><span class="process book_pc_tt fbIf"><?php echo Yii::t('translate','infor'); ?></span></li>
	  	<li><span class="glyphicon glyphicon-menu-right"></span></li>
	  	<li><span class="process book_pc_tt fbCf"><?php echo Yii::t('translate','confirm');; ?></span></li>
	</ul>

	<div class="progress-container">
	    <div class="progress progress-striped active">
	        <div class="progress-bar progress-bar-success"></div>
	    </div>
	</div>
</div>

<div id="book_choose">
</div>

<script>
	$('.book_pc_tt').click(function (e) {
		clsNSpan = $(this).parents('span').context.className.split(' ');

		actCls = clsNSpan[2];

		if(clsNSpan[3] != 'cur') {
			return;
		}

		switch(actCls) {
			case 'fbBr': 		// chon chi nhanh
				calBranch();
				break;
			case 'fbSv': 		// chon dich vu
				calService();
				break;
			case 'fbPv': 		// chon nguoi thuc hien
				calProvider();
				break;
			case 'fbDt': 		// chon ngay gio
				calDate();
				break;
			default:
				console.log(actCls);
				break;
		}
	})
</script>