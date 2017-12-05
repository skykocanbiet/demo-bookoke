
<?php
    $baseUrl = Yii::app()->getBaseUrl();
    // Yii::app()->clientScript->registerCssFile($baseUrl.'/assets_home/mini-website/css/reset.css');
    Yii::app()->clientScript->registerCssFile($baseUrl.'/css/book.css');

    // datetime bootstrap
    Yii::app()->clientScript->registerCssFile($baseUrl.'/css/bootstrap-datetimepicker.min.css');
    Yii::app()->clientScript->registerCssFile($baseUrl.'/js/select2/select2.min.css');
    Yii::app()->clientScript->registerCssFile($baseUrl.'/js/select2/select2-bootstrap.min.css');

    Yii::app()->clientScript->registerCoreScript('jquery.ui');
    Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/moment.js');
    Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/bootstrap-datetimepicker.min.js');
    Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/select2/select2.min.js');
?>

<style>
.error {color: red; font-style: italic;}
</style>

   <div id="lk-wr-header" class="" style="border-bottom: 2px solid #ccc;">
	    <div class="lk-wr-header-content container">
	        <div class="lk-wr-header-left">
	            <a href="<?php echo $baseUrl; ?>">
	            	<img src="<?php echo $baseUrl; ?>/images/logo_vi.png"/>
	            </a>
	        </div>
	    </div>
	</div><!--  End #lk-wr-header -->

    <div class="container" id="book_container">
		<div class="col-md-8 col-lg-8" id="book_info">
			<div id="book_process">
				<ul class="list-inline">
				  	<li><span class="process book_pc_tt">SERVICES</span></li>
				  	<li><span class="glyphicon glyphicon-menu-right"></span></li>
				  	<li><span class="process book_pc_tt">PROVIDER</span></li>
				  	<li><span class="glyphicon glyphicon-menu-right"></span></li>
				  	<li><span class="process book_pc_tt">DATE</span></li>
				  	<li><span class="glyphicon glyphicon-menu-right"></span></li>
				  	<li><span class="process book_pc_tt">YOUR INFO</span></li>
				  	<li><span class="glyphicon glyphicon-menu-right"></span></li>
				  	<li><span class="process book_pc_tt">VERITY</span></li>
				</ul>

				<div class="progress-container">
				    <div class="progress progress-striped active">
				        <div class="progress-bar progress-bar-success"></div>
				    </div>
				</div>
			</div>

			<div id="book_choose">
				<div id="book_choose_services">
					<div class="alert">
						Choose Service
					</div>
					<div class="book_choose_table">
						<table class="table services">
						<?php foreach ($services as $key => $v): 
							$color = ($key%2 == 0) ? 'col_grey' : '';
						?>
							<tr class="<?php echo $color; ?> choose_sv" data-sv="<?php echo $v['id']; ?>">
								<td class="t1"><?php echo $v['name']; ?></td>
								<td class="t2"><?php echo $v['length']; ?> mins</td>
								<td class="t3"><?php echo $v['code']; ?></td>
								<td class="t4">$ <?php echo $v['price']; ?></td>
							</tr>
						<?php endforeach ?>
						</table>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-4 col-lg-3 col-lg-offset-1" id="hour_work">			
			<div class="panel panel-default">
			  	<div class="panel-heading">HOURS WORKING</div>
			  	<div class="panel-body">
			    	<table class="table">
		    			<tr>
		    				<td>Sunday</td>
		    				<td><i>Closed</i></td>
		    			</tr>
		    			<tr>
		    				<td>Monday</td>
		    				<td>9:00 AM - 8:00 PM</td>
		    			</tr>
		    			<tr>
		    				<td>Tuesday</td>
		    				<td>9:00 AM - 8:00 PM</td>
		    			</tr>
		    			<tr>
		    				<td>Wednesday</td>
		    				<td>9:00 AM - 8:00 PM</td>
		    			</tr>
		    			<tr>
		    				<td>Thurday</td>
		    				<td>9:00 AM - 8:00 PM</td>
		    			</tr>
		    			<tr>
		    				<td>Tuesday</td>
		    				<td>9:00 AM - 8:00 PM</td>
		    			</tr>
		    			<tr>
		    				<td>Friday</td>
		    				<td>9:00 AM - 8:00 PM</td>
		    			</tr>
		    			<tr>
		    				<td>Saturday</td>
		    				<td><i>Closed</i></td>
		    			</tr>
			    	</table>
			  	</div>
			</div>
		</div>
	</div>


<script>
function runProcess(width) {
	$(".progress-bar").animate({
	    width: width
	}, 0 );
}
$(function () {

	$('.services').on('click','.choose_sv',function (e) {

		e.preventDefault();
		runProcess('18%');

		service_id 		= 	$(this).data('sv');
		service_name	=	$(this).find('.t1').text();
		service_len		=	$(this).find('.t2').text();
		len 			=	service_len.split(" ");
		service_price	=	$(this).find('.t4').text();

		$.ajax({
			url: "<?php echo CController::createUrl('book/book_provider'); ?>",
			type: 'POST',
			
			data : {
				id_company 		: 	<?php echo $id_company; ?>,
				service_id 		: 	service_id,
				service_name	: 	service_name,
				service_len		: 	len[0],
				service_price 	: 	service_price.substr(2),
			},
			success: function (data) {
				$('#book_choose').empty();
				$('#book_choose').html(data);
			}, 
		})
	});

})

</script>