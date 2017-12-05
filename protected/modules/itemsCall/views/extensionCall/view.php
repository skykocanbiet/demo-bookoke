<style type="text/css">
	.radio-inline+.radio-inline{
		margin-left: 0px;
	}
	.extension{
		margin-bottom: 30px;
	}
	.margin-top-30{
		margin-top: 50px;
	}
	.listextension{
		margin-top: 50px;
	}
</style>
<div class="container margin-top-30">
	<p style="float: left;">Danh sách Extension: </p>
	<button style="float: right;" type="button" class="btn btn_bookoke register_extension" id="register_extension">Đăng kí</button>
	<div class="clearfix"></div>
	<div class="listextension">
		<?php foreach ($listextension as $value) {
			if ($value['id_user']) {
				$nameuser = GpUsers::model()->findByPk($value['id_user']);
			}else{
				$nameuser="";
			}
			 
		?>

			<label class="radio-inline col-lg-3 extension"><input name="extension" type="radio" <?php echo ($value['status']==1)?"disabled":""; ?> value="<?php echo $value['extension'] ?>">Extension <?php echo $value['name'] ?> <?php echo (isset($nameuser) && $nameuser)?"(".$nameuser['name'].")":""; ?></label>
		<?php } ?>
	</div>
</div>
<script>

	$(document).ready(function(){
		$('#register_extension').click(function(){
			var extension = $("input[name='extension']:checked").val();
			var id_user = <?php echo Yii::app()->user->getState('user_id')?>;
			$.ajax({
			    type:'POST',
			    url: "<?php echo CController::createUrl('ExtensionCall/RegisterExtension')?>",	
			    data: {"id_user":id_user,"extension":extension},   
			    success:function(data){  	
			    	if (data!=0) {
			    		$.jAlert({
		                    'title': "Thông báo !",
		                    'content': "Đăng kí thành công"
		                });
			    	}	         
			    },
			    error: function(data){
			    console.log("error");
			    console.log(data);
			    }
		    });
		});
	});
</script>