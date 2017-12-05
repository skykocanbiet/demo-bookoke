<?php $baseUrl = Yii::app()->baseUrl;?>
<!--Font Awesome and Bootstrap Main css  -->


<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/jqtransform.css" />
<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/setting.css" />
<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/customers_new.css" />

<?php
	$baseUrl = Yii::app()->getBaseUrl();
    // Yii::app()->clientScript->registerCssFile($baseUrl.'/assets_home/lk/css/reset.css');

    //  jQuery Tabs
    Yii::app()->clientScript->registerCssFile($baseUrl.'/assets_home/mini-website/pws-tabs/font-awesome/css/font-awesome.min.css');

    //	My style
    Yii::app()->clientScript->registerCssFile($baseUrl.'/assets_home/mini-website/css/management.css');


    
    Yii::app()->clientScript->registerCssFile($baseUrl.'/assets_home/mini-website/robo-crop/font-awesome.min.css');

    //	cropit css
    Yii::app()->clientScript->registerCssFile($baseUrl.'/assets_home/mini-website/cropit/styles/index.css');
?>

<script type="text/javascript">
    $( document ).ready(function() {
        var browserHeight = 0;
        
        if( typeof( window.innerWidth ) == 'number' ) {
            //Non-IE
            browserHeight = window.innerHeight;
        } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
            //IE 6+ in 'standards compliant mode'
            browserHeight = document.documentElement.clientHeight;
        } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
            //IE 4 compatible
            browserHeight = document.body.clientHeight;
        }
        
        var hHeader = $('#headerMenu').height();
		var height = browserHeight - hHeader;
    });
</script>

<style>
	.crop-area {
		margin-top: -200px !important;
	}
	.btn-open {
	    position: relative;
	    overflow: hidden;
	    margin: 10px;
	}
	.btn-open input.upload {
	    position: absolute;
	    top: 0;
	    right: 0;
	    margin: 0;
	    padding: 0;
	    font-size: 20px;
	    cursor: pointer;
	    opacity: 0;
	    filter: alpha(opacity=0);
	}
	.col-centered{
	    float: none;
	    margin: 0 auto;
	}
	h1 { color: #666; font-family: 'Lato', sans-serif; font-size: 54px; font-weight: 300; line-height: 58px; margin: 0 0 58px; padding-top:20px;}
	p { color: #666; font-family: 'Raleway',sans-serif; font-size: 18px; font-weight: 500; line-height: 32px; margin: 0 0 24px; }
	#robocrop{
		min-height:500px;
		background-color:#333;
	}

	#robocrop1{
		min-height:400px;
		background-color:#333;
	}

	#robocrop2{
		min-height:400px;
		background-color:#333;
		overflow: hidden;
	}

	#robocrop{
		min-height:400px;
		background-color:#333;
	}

	.img-preview{
		border: 0px solid #ddd !important;
	}

	#current-logo {
		text-align: center;
	}
</style>


<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>

<style type="text/css">
#profileSideNav ul li a i{
    font-size:2em;  

}
#profileSideNav ul li a .glyphicon{
    font-size:2em;
}
  

</style>


                

                <!-- Detail Customer -->
                    <div id="wr-miniweb">
				    	<div id="miniweb-content">
				    		<div class="miniweb-header">
								<div class="miniweb-header-left">
									Your free mini website
								</div>
								<div class="miniweb-header-right">
									<button class="btn-header-save">Save</button>
								</div>
							</div>

							<div class="current-domain">
								<span>Your current Timely website address:</span><br/><br/>
								<a href="<?php echo $baseUrl; ?>/">
									
									<a href="<?php echo $baseUrl;?>/<?php echo $data['sub_domain']; ?>/index.html" target="_blank">
										<!-- <?php //echo $miniwebsite; ?> -->
										<?php echo $baseUrl;?>/<?php echo $data['sub_domain']; ?>/index.html
									</a>
								</a>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="#" id="edit-domain">(Edit)</a>
								<div class="update-domain" style="display: none;">
									<div class="input-group" style="width: 450px">
										<div class="input-group-addon">
											<!-- <?php
												echo Yii::app()->getBaseUrl(true).'/';
											?> -->
										</div>
		                                <input class="form-control" type="text" value="<?php //echo $website['sub_domain']; ?>">
		                            </div>
		                            <div class="edit-domain-footer">
		                            	<button type="button" class="download-btn btn btn-default btn-sm">
			                            	<i class="fa fa-floppy-o"></i>&nbsp;Update
			                            </button>&nbsp;&nbsp;&nbsp;&nbsp;
			                            <button type="button" class="download-btn btn btn-default btn-sm" id="cancel-update-domain">
			                            	<i class="fa fa-times"></i>&nbsp;Cancel
			                            </button>
		                            </div>
								</div>
							</div>

							<div class="miniweb-settings">
								<table>
									<tr>
										<td>
											<?php
												if ($data['cover_photo'] == '') {
												?>
													<i class="fa fa-remove error-text"></i>
												<?php
												}else{
												?>
													<i class="fa fa-check success-text"></i>
												<?php
												}
											?>
										</td>
										<td style="padding-left: 10px !important;">Cover Image</td>
										<td>Choose an awesome cover photo to showcase your business</td>
										<td class="last-column">
											<button type="button" class="button btn btn-info btn-lg btn-open-modal" 
													data-toggle="modal" data-target="#myModal" id="btn-edit-cover">Edit</button>
										</td>
									</tr>
									<tr>
										<td>
											<?php
												if ($data['logo'] == '') {
												?>
													<i class="fa fa-remove error-text"></i>
												<?php
												}else{
												?>
													<i class="fa fa-check success-text"></i>
												<?php
												}
											?>
										</td>
										<td style="padding-left: 10px !important;">Logo</td>
										<td>Upload your business logo or a small image that is iconic to your business</td>
										<td class="last-column">
											<button type="button" class="button btn btn-info btn-lg btn-open-modal" 
													data-toggle="modal" data-target="#myModal2" id="btn-edit-logo">Edit</button>
										</td>
									</tr>

									<!-- ABOUT US -->
									<tr>
										<td><i class="fa fa-remove error-text"></i></td>
										<td style="padding-left: 10px !important;">About Us</td>
										<td>lorem ipsum generator lorem ipsum generator lorem ipsum generator</td>
										<td class="last-column">
											<button class="button">Edit</button>
										</td>
									</tr>

									<!-- SERVICES -->
									<tr>
										<td><i class="fa fa-remove error-text"></i></td>
										<td style="padding-left: 10px !important;">Services</td>
										<td>lorem ipsum generator lorem ipsum generator lorem ipsum generator</td>
										<td class="last-column">
											<button class="button">Edit</button>
										</td>
									</tr>

									<!-- OUR STAFF -->
									<tr>
										<td><i class="fa fa-remove error-text"></i></td>
										<td style="padding-left: 10px !important;">Our staff</td>
										<td>lorem ipsum generator lorem ipsum generator lorem ipsum generator</td>
										<td class="last-column">
											<button class="button">Edit</button>
										</td>
									</tr>

									<!-- BOOK -->
									<tr>
										<td><i class="fa fa-remove error-text"></i></td>
										<td style="padding-left: 10px !important;">Book</td>
										<td>lorem ipsum generator lorem ipsum generator lorem ipsum generator</td>
										<td class="last-column">
											<button class="button">Edit</button>
										</td>
									</tr>

									<!-- GALLERY -->
									<tr>
										<td><i class="fa fa-remove error-text"></i></td>
										<td style="padding-left: 10px !important;">Gallery</td>
										<td>lorem ipsum generator lorem ipsum generator lorem ipsum generator</td>
										<td class="last-column">
											<button class="button">Edit</button>
										</td>
									</tr>

									<!-- REVIEW -->
									<tr>
										<td><i class="fa fa-remove error-text"></i></td>
										<td style="padding-left: 10px !important;">Review</td>
										<td>lorem ipsum generator lorem ipsum generator lorem ipsum generator</td>
										<td class="last-column">
											<button class="button">Edit</button>
										</td>
									</tr>
								</table>
							</div>
				    	</div>

				    	<!-- Modal crop cover -->
						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg btns-robocrop1">
							    <!-- Modal content-->
							    <div class="modal-content">
									<div class="modal-header">
										Choose cover photo for mini website
							        	<button type="button" class="close" data-dismiss="modal">&times;</button>
							      	</div>
							      	<div class="modal-body">
								      	<div class="splash">
								      
							      		<div class="demo-wrapper">
									            <div class="preview-wrapper">
									                <div class="cropit-preview">
									                    <div class="spinner">
									                        <div class="spinner-dot"></div>
									                        <div class="spinner-dot"></div>
									                        <div class="spinner-dot"></div>
									                    </div>
									                    <div class="error-msg"></div>
									                </div>
									                <div class="controls-wrapper">
									                    <div class="rotation-btns"><span class="icon icon-rotate-left rotate-ccw-btn"></span><span class="icon icon-rotate-right rotate-cw-btn"></span></div>
									                    <div class="slider-wrapper"><span class="icon icon-image small-image"></span><input type="range" class="cropit-image-zoom-input custom"><span class="icon icon-image large-image"></span></div>
									                </div>
									            </div>
									        </div>
									        <div id="current-cover-photo">
									        	<div>
									        
									        	</div>
									    	</div>

									        <div class="btns-wrapper">
									        	<div class="select-image-btn btn-open btn btn-default btn-sm">
													<span><i class="fa fa-folder-open-o"></i>&nbsp;Open Image</span>  
												</div>
												<button type="button" data-dismiss="modal" class="download-btn btn btn-default btn-sm"><i class="fa fa-picture-o"></i>&nbsp;Save cover photo</button>

									            <div class="btns">
									            	<input type="file" class="cropit-image-input custom">
									            </div>
									        </div>
									        <input type="hidden" name="cover_value" value="<?php //echo $websiteInfo['cover_photo']; ?>"/>
											<input type="hidden" name="user_folder" value="<?php //echo $website['folder']; ?>"/>
									    </div>
									</div>
							    </div>
						 	</div>
						</div>

				    	<!-- Modal crop avatar -->
						<div id="myModal2" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg btns-robocrop2">
							    <!-- Modal content-->
							    <div class="modal-content">
									<div class="modal-header">
										Choose logo for mini website
							        	<button type="button" class="close" data-dismiss="modal">&times;</button>
							      	</div>
							      	<div class="modal-body">
										<?php
										//	if ($websiteInfo['logo'] == '') {
											?>
												<div id="robocrop2"></div>
											<?php
											//}else{
											?>
												<div id="robocrop2" style="display: none;"></div>
												<div id="current-logo">
								        			
								        		</div>
											<?php
											//}
										?>
										<div class="row" style="padding: 10px 0px; background: #fcfcfc; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
											<div class="col-md-12 text-center" style="text-align: center;">
												<!-- <button type="button" class="btn-crop btn btn-default btn-sm"><i class="fa fa-scissors"></i>&nbsp;Crop</button> -->
												<div class="btn-open btn btn-default btn-sm">
													<span><i class="fa fa-folder-open-o"></i>&nbsp;Open Image</span>  
													<input class="upload" type="file"/>
												</div>
												<button type="button" data-dismiss="modal"  class="btn-get-img btn btn-default btn-sm"><i class="fa fa-picture-o"></i>&nbsp;Save logo</button>
											</div>
										</div>
										<input type="hidden" name="logo_value" value="<?php /*echo $websiteInfo['logo'];*/ ?>"/>
										<input type="hidden" name="user_folder" value="<?php //echo //$website['folder']; ?>"/>
							      </div>
							    </div>
						 	</div>
						</div>

						<input type="hidden" id="base_url" value="<?php echo $baseUrl; ?>"/>

				  		<script src="<?php echo $baseUrl; ?>/assets_home/mini-website/robo-crop/jquery.min.js"></script>
						<script src="<?php echo $baseUrl; ?>/assets_home/mini-website/robo-crop/bootstrap.min.js"></script>

						<script src="<?php echo $baseUrl; ?>/assets_home/mini-website/robo-crop/robocrop.js"></script>
						<script src="<?php echo $baseUrl; ?>/assets_home/mini-website/robo-crop/test.js"></script>

						<script src="<?php echo $baseUrl; ?>/assets_home/mini-website/cropit/scripts/vendor.js"></script>
						<script src="<?php echo $baseUrl; ?>/assets_home/mini-website/cropit/scripts/index.js"></script>

						<script type="text/javascript">
							$(document).ready(function(){
								//	Click chỉnh sửa logo
								$('#btn-edit-logo').click(function(){
									var logo = $('[name=logo_value]').val();

									if (logo != '') {
										$('#robocrop2').attr('style','display: none;');
										$('#current-logo').attr('style','display: block;');
									}else{
										$('#robocrop2').attr('style','display: block;');
										$('#current-logo').attr('style','display: none;');
									}
								});

								$('#btn-edit-cover').click(function(){
									var coverPhoto = $('[name=cover_value]').val();

									if (coverPhoto != '') {
										$('.demo-wrapper').attr('style','display: none;');
										$('#current-cover-photo').attr('style','display: table;');
									}else{
										$('.demo-wrapper').attr('style','display: block;');
										$('#current-cover-photo').attr('style','display: none;');
									}
								});
							});

						</script>
					</div>
               


               
            



<script type="text/javascript">

$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();
    var customer_action = $(".customersActionHolder").height();  
    var customer_search = $(".customerSearchHolder").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-tab_menu-45);     

    $('#customerList').css('max-height', windowHeight-header-customer_action-customer_search-80);

});
$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();
    var customer_action = $(".customersActionHolder").height();  
    var customer_search = $(".customerSearchHolder").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-tab_menu-45);     

    $('#customerList').css('max-height', windowHeight-header-customer_action-customer_search-80);
});
</script>

