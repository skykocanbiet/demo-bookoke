<?php 
$tooth_data               = new ToothData;
$listToothData            = $tooth_data->getListToothData($model->id,$id_mhg);
$listFaceTooth            = $tooth_data->getListFaceTooth($model->id,$id_mhg);
$listToothStatus          = $tooth_data->getListToothStatus($model->id,$id_mhg);
$listOnlyToothNote        = $tooth_data->getListOnlyToothNote($model->id,$id_mhg);

$evaluateStateOfTartar    = $model->getEvaluateStateOfTartar($id_mhg);
$checkExistImage          = $model->getListName($model->id,$id_mhg);
?>

<div class="row padding-left-15 padding-right-15">   
	<h4 style="display: inline-block;">TÌNH TRẠNG RĂNG</h4>	

    <a style="float:right;margin: 15px 5px;" href="javascript:void(0)"><div id="draw"></div></a>

    <a style="float:right;margin: 15px 5px;" href="javascript:void(0)"><div id="save"></div></a>
    
</div>

<input id="dental_status_change" type="hidden" value="0">
<input id="image_dental_status_change" type="hidden" value="<?php if(!empty($checkExistImage)) echo "1";?>">

<div class="blur" id="plupload-master-blur">
	<div id="plupload-master-container">			

			<div class="modal-header popHead" style="margin:-15px -15px 15px -15px;">
	           <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
	            <h5>Thư Viện Ảnh Tình Trạng Răng</h5>
	         </div> 

            <form id="form" method="post" action="../dump.php">
				<div id="uploader">
					<p>Trình duyệt của bạn không có Flash, Silverlight hoặc hỗ trợ HTML5.</p>
				</div>		
			</form>

	</div>	
</div>

<!-- Modal Note -->
<div class="modal fade" id="noteToothModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Thêm Ghi Chú</h4>
      </div>
      <form id="frmNoteTooth">
      <div class="modal-body">
        <input required id="txtNoteTooth" type="text" class="form-control">					 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-primary">Lưu</button>
      </div>
       </form>
    </div>
  </div>
</div>

<div style="margin:0px;position:relative;">

	<div id="mySidenav1" class="sidenav" style="z-index:10;">

		<div style="background-color: #6ec4a1;">
			<h3 style="background-color: #6ec4a1;display: inline-block;font-size: 17px;padding: 15px;color:#fff;">THÊM TÌNH TRẠNG RĂNG <span class="title_sidenav"></span></h3>
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><div class="ic_close_white"></div></a>
		</div>	
	  
	  <a href="javascript:void(0)" onclick="openNav2()"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/disease.png" style="width:10%;">   Bệnh</a>

		<div class="submenu">
			<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu11" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/crown.png" style="width:10%;">   Mão</a>	        
	        <div class="submenu-body collapse" id="submenu11">
	            <div class="list-group">
	                <a href="javascript:void(0)" onclick="maoKimLoai();" class="list-group-item crown"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade1.png" style="width:10%;">   Mão kim loại</a>
	                <a href="javascript:void(0)" onclick="maoSuKimLoai();" class="list-group-item crown"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade2.png" style="width:10%;">   Mão sứ kim loại</a>
	                <a href="javascript:void(0)" onclick="maoToanSu();" class="list-group-item crown"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade3.png" style="width:10%;">   Mão toàn sứ</a>	               
	            </div>
	        </div>                    
	    </div>

	    <div class="submenu">
			<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu12" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility.png" style="width:10%;">   Veneer</a>	        
	        <div class="submenu-body collapse" id="submenu12">
	            <div class="list-group">
	                <a href="javascript:void(0)" onclick="veneerComposite();" class="list-group-item veneer"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade1.png" style="width:10%;">   Veneer composite</a>
	                <a href="javascript:void(0)" onclick="veneerSu();" class="list-group-item veneer"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade2.png" style="width:10%;">   Veneer sứ</a>
               
	            </div>
	        </div>                    
	    </div>

	    <div class="submenu">
			<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu13" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/pontic.png" style="width:10%;">   Pontic</a>	        
	        <div class="submenu-body collapse" id="submenu13">
	            <div class="list-group">
	                <a href="javascript:void(0)" onclick="ponticKimLoai();" class="list-group-item pontic"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade1.png" style="width:10%;">   Pontic kim loại</a>
	                <a href="javascript:void(0)" onclick="ponticSuKimLoai();" class="list-group-item pontic"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade2.png" style="width:10%;">   Pontic sứ kim loại</a>
	                <a href="javascript:void(0)" onclick="ponticToanSu();" class="list-group-item pontic"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade3.png" style="width:10%;">   Pontic toàn sứ</a>	               
	            </div>
	        </div>                    
	    </div>

	    <a class="residual_crown" href="javascript:void(0)" onclick="residualCrownStatus()"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/residual-crown.png" style="width:10%;">   Răng bể</a>
	    
	  	<a class="missing" href="javascript:void(0)" onclick="missingStatus();"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/missing.png" style="width:10%;">   Răng mất</a>  
	 
	  	<a class="residual_root" href="javascript:void(0)" onclick="residualRootStatus();"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/residual-root.png" style="width:10%;">   Còn chân răng</a>
	
	  	<div class="submenu">
			<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu14" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/implant.png" style="width:10%;">   Implant</a>	        
	        <div class="submenu-body collapse" id="submenu14">
	            <div class="list-group">
	                <a href="javascript:void(0)" onclick="implantMao();" class="list-group-item implant"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade1.png" style="width:10%;">   Implant + mão</a>
	                <a href="javascript:void(0)" onclick="implantHealing();" class="list-group-item implant"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade2.png" style="width:10%;">   Implant + healing</a>
	                <a href="javascript:void(0)" onclick="implant();" class="list-group-item implant"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade3.png" style="width:10%;">   Implant</a>	               
	            </div>
	        </div>                    
	    </div>
	    
	</div>

	<div id="mySidenav2" class="sidenav" style="z-index:10;">

		<div style="background-color: #6ec4a1;">
			<h3 style="background-color: #6ec4a1;display: inline-block;font-size: 17px;padding: 15px;color:#fff;">THÊM TÌNH TRẠNG RĂNG <span class="title_sidenav"></span></h3>		
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><div class="ic_close_white"></div></a>
		</div>	
	  	
	  	<div style="height:600px;overflow-y: auto;">

	  		<div class="submenu">
				<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu1" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/restoration.png" style="width:10%;">   Phục hồi (miếng trám)</a>	        
		        <div class="submenu-body collapse" id="submenu1">
		            <div class="list-group">
		                <a href="javascript:void(0)" onclick="incisalUsal(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/incisal...usal.png" style="width:10%;">   Mặt nhai (X)</a>
		                <a href="javascript:void(0)" onclick="incisalSal(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/incisal...sal.png" style="width:10%;">   Mặt nhai (G)</a>
		                <a href="javascript:void(0)" onclick="distal(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/distal.png" style="width:10%;">   Mặt xa</a>
		                <a href="javascript:void(0)" onclick="mesial(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mesial.png" style="width:10%;">   Mặt gần</a>
		                <a href="javascript:void(0)" onclick="proximalD(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/proximal-d.png" style="width:10%;">   Mặt bên xa</a>
		                <a href="javascript:void(0)" onclick="proximalM(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/proximal-m.png" style="width:10%;">   Mặt bên gần</a>
		                <a href="javascript:void(0)" onclick="abfractionV(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/abfraction.png" style="width:10%;">   Cổ răng</a>
		                <a href="javascript:void(0)" onclick="facialBuccal(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/facial-buccal.png" style="width:10%;">   Mặt ngoài</a>
		                <a href="javascript:void(0)" onclick="palateLingual(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/palate-lingual.png" style="width:10%;">   Mặt trong</a>
		            </div>
		        </div>                    
		    </div> 	

		    <div class="submenu">
				<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu2" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/decay.png" style="width:10%;">   Sâu răng</a>	        
		        <div class="submenu-body collapse" id="submenu2">
		            <div class="list-group">
		                <a href="javascript:void(0)" onclick="incisalUsal(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/incisal...usal.png" style="width:10%;">   Mặt nhai (X)</a>
		                <a href="javascript:void(0)" onclick="incisalSal(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/incisal...sal.png" style="width:10%;">   Mặt nhai (G)</a>
		                <a href="javascript:void(0)" onclick="distal(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/distal.png" style="width:10%;">   Mặt xa</a>
		                <a href="javascript:void(0)" onclick="mesial(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mesial.png" style="width:10%;">   Mặt gần</a>
		                <a href="javascript:void(0)" onclick="proximalD(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/proximal-d.png" style="width:10%;">   Mặt bên (X)</a>
		                <a href="javascript:void(0)" onclick="proximalM(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/proximal-m.png" style="width:10%;">   Mặt bên (G)</a>
		                <a href="javascript:void(0)" onclick="abfractionV(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/abfraction.png" style="width:10%;">   Cổ răng</a>
		                <a href="javascript:void(0)" onclick="facialBuccal(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/facial-buccal.png" style="width:10%;">   Mặt ngoài</a>
		                <a href="javascript:void(0)" onclick="palateLingual(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/palate-lingual.png" style="width:10%;">   Mặt trong</a>
		            </div>
		        </div>                    
		    </div>

		    <div class="submenu">
				<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu3" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/toothache.png" style="width:10%;">   Đau răng</a>	        
		        <div class="submenu-body collapse" id="submenu3">
		            <div class="list-group">
		                <a href="javascript:void(0)" onclick="sensitive();" class="list-group-item toothache"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/sensitive.png" style="width:10%;">   Nhạy cảm</a>
		                <a href="javascript:void(0)" onclick="pulpitis();" class="list-group-item toothache"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/pulpitis.png" style="width:10%;">   Viêm tuỷ</a>		  
		                <a href="javascript:void(0)" onclick="chronicPeriapical();" class="list-group-item toothache"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/chroni...riapical.png" style="width:10%;">   Viêm quanh chóp</a>	                
		            </div>
		        </div>                    
		    </div>

			<div class="submenu">
				<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu4" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/fractured.png" style="width:10%;">   Nứt răng</a>	        
		        <div class="submenu-body collapse" id="submenu4">
		            <div class="list-group">
		                <a href="javascript:void(0)" onclick="crown();" class="list-group-item fractured"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/crown-sub.png" style="width:10%;">   Nứt thân răng</a>
		                <a href="javascript:void(0)" onclick="root();" class="list-group-item fractured"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/root.png" style="width:10%;">   Nứt chân răng</a>
		                <a href="javascript:void(0)" onclick="crownRoot();" class="list-group-item fractured"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/crown-root.png" style="width:10%;">   Nứt thân- chân răng</a>	               
		            </div>
		        </div>                    
		    </div>  

			<div class="submenu">
				<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu5" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/calculus.png" style="width:10%;">   Vôi răng</a>	        
		        <div class="submenu-body collapse" id="submenu5">
		            <div class="list-group">
		                <a href="javascript:void(0)" onclick="gradeI(1);" class="list-group-item calculus"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/calculus-grade1.png" style="width:10%;">   Độ 1</a>
		                <a href="javascript:void(0)" onclick="gradeII(1);" class="list-group-item calculus"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/calculus-grade2.png" style="width:10%;">   Độ 2</a>
		                <a href="javascript:void(0)" onclick="gradeIII(1);" class="list-group-item calculus"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/calculus-grade3.png" style="width:10%;">   Độ 3</a>	               
		            </div>
		        </div>                    
		    </div> 
		    
		    <div class="submenu">
				<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu6" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility.png" style="width:10%;">   Lung lay</a>	        
		        <div class="submenu-body collapse" id="submenu6">
		            <div class="list-group">
		                <a href="javascript:void(0)" onclick="gradeI(2);" class="list-group-item mobility"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade1.png" style="width:10%;">   Độ 1</a>
		                <a href="javascript:void(0)" onclick="gradeII(2);" class="list-group-item mobility"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade2.png" style="width:10%;">   Độ 2</a>
		                <a href="javascript:void(0)" onclick="gradeIII(2);" class="list-group-item mobility"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade3.png" style="width:10%;">   Độ 3</a>	               
		            </div>
		        </div>                    
		    </div>

		    <a href="javascript:void(0)" onclick="monRang();"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/disease.png" style="width:10%;">   Mòn răng</a>   
			
	    </div>
	</div>

	<div id="mySidenav3" class="sidenav" style="z-index:10;">

		<div style="background-color: #6ec4a1;">
			<h3 style="background-color: #6ec4a1;display: inline-block;font-size: 17px;padding: 15px;color:#fff;">THÊM TÌNH TRẠNG RĂNG <span class="title_sidenav"></span></h3>
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><div class="ic_close_white"></div></a>
		</div>	
	  
	  <a href="javascript:void(0)" onclick="openNav4()"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/disease.png" style="width:10%;">   Bệnh</a>

		<div class="submenu">
			<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu31" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/crown.png" style="width:10%;">   Mão</a>	        
	        <div class="submenu-body collapse" id="submenu31">
	            <div class="list-group">
	                <a href="javascript:void(0)" onclick="maoKimLoaiSSC();" class="list-group-item crown"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade1.png" style="width:10%;">   Mão kim loại SSC</a>
	                <a href="javascript:void(0)" onclick="maoNhua();" class="list-group-item crown"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade3.png" style="width:10%;">   Mão nhựa</a>	               
	            </div>
	        </div>                    
	    </div>	

	    <a class="residual_crown" href="javascript:void(0)" onclick="residualCrownStatus()"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/residual-crown.png" style="width:10%;">   Răng bể</a>
	    
	  	<a class="missing" href="javascript:void(0)" onclick="missingStatus();"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/missing.png" style="width:10%;">   Răng mất</a>  
	 
	  	<a class="residual_root" href="javascript:void(0)" onclick="residualRootStatus();"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/residual-root.png" style="width:10%;">   Còn chân răng</a>
		  		    
	</div>

	<div id="mySidenav4" class="sidenav" style="z-index:10;">

		<div style="background-color: #6ec4a1;">
			<h3 style="background-color: #6ec4a1;display: inline-block;font-size: 17px;padding: 15px;color:#fff;">THÊM TÌNH TRẠNG RĂNG <span class="title_sidenav"></span></h3>		
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><div class="ic_close_white"></div></a>
		</div>	
	  	
	  	<div style="height:600px;overflow-y: auto;">

	  		<div class="submenu">
				<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu41" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/restoration.png" style="width:10%;">   Phục hồi (miếng trám)</a>	        
		        <div class="submenu-body collapse" id="submenu41">
		            <div class="list-group">
		                <a href="javascript:void(0)" onclick="incisalUsal(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/incisal...usal.png" style="width:10%;">   Mặt nhai (X)</a>
		                <a href="javascript:void(0)" onclick="incisalSal(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/incisal...sal.png" style="width:10%;">   Mặt nhai (G)</a>
		                <a href="javascript:void(0)" onclick="distal(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/distal.png" style="width:10%;">   Mặt xa</a>
		                <a href="javascript:void(0)" onclick="mesial(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mesial.png" style="width:10%;">   Mặt gần</a>
		                <a href="javascript:void(0)" onclick="proximalD(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/proximal-d.png" style="width:10%;">   Mặt bên xa</a>
		                <a href="javascript:void(0)" onclick="proximalM(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/proximal-m.png" style="width:10%;">   Mặt bên gần</a>
		                <a href="javascript:void(0)" onclick="abfractionV(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/abfraction.png" style="width:10%;">   Cổ răng</a>
		                <a href="javascript:void(0)" onclick="facialBuccal(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/facial-buccal.png" style="width:10%;">   Mặt ngoài</a>
		                <a href="javascript:void(0)" onclick="palateLingual(1);" class="list-group-item restoration"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/palate-lingual.png" style="width:10%;">   Mặt trong</a>
		            </div>
		        </div>                    
		    </div> 	

		    <div class="submenu">
				<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu42" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/decay.png" style="width:10%;">   Sâu răng</a>	        
		        <div class="submenu-body collapse" id="submenu42">
		            <div class="list-group">
		                <a href="javascript:void(0)" onclick="incisalUsal(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/incisal...usal.png" style="width:10%;">   Mặt nhai (X)</a>
		                <a href="javascript:void(0)" onclick="incisalSal(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/incisal...sal.png" style="width:10%;">   Mặt nhai (G)</a>
		                <a href="javascript:void(0)" onclick="distal(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/distal.png" style="width:10%;">   Mặt xa</a>
		                <a href="javascript:void(0)" onclick="mesial(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mesial.png" style="width:10%;">   Mặt gần</a>
		                <a href="javascript:void(0)" onclick="proximalD(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/proximal-d.png" style="width:10%;">   Mặt bên (X)</a>
		                <a href="javascript:void(0)" onclick="proximalM(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/proximal-m.png" style="width:10%;">   Mặt bên (G)</a>
		                <a href="javascript:void(0)" onclick="abfractionV(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/abfraction.png" style="width:10%;">   Cổ răng</a>
		                <a href="javascript:void(0)" onclick="facialBuccal(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/facial-buccal.png" style="width:10%;">   Mặt ngoài</a>
		                <a href="javascript:void(0)" onclick="palateLingual(2);" class="list-group-item decay"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/palate-lingual.png" style="width:10%;">   Mặt trong</a>
		            </div>
		        </div>                    
		    </div>

		    <div class="submenu">
				<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu43" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/toothache.png" style="width:10%;">   Đau răng</a>	        
		        <div class="submenu-body collapse" id="submenu43">
		            <div class="list-group">
		                <a href="javascript:void(0)" onclick="sensitive();" class="list-group-item toothache"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/sensitive.png" style="width:10%;">   Nhạy cảm</a>
		                <a href="javascript:void(0)" onclick="pulpitis();" class="list-group-item toothache"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/pulpitis.png" style="width:10%;">   Viêm tuỷ</a>		  
		                <a href="javascript:void(0)" onclick="chronicPeriapical();" class="list-group-item toothache"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/chroni...riapical.png" style="width:10%;">   Viêm quanh chóp</a>	                
		            </div>
		        </div>                    
		    </div>	
		    
		    <div class="submenu">
				<a class="submenu-heading" data-parent="#nav-menu" data-toggle="collapse" data-target="#submenu44" href="javascript:void(0)"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility.png" style="width:10%;">   Lung lay</a>	        
		        <div class="submenu-body collapse" id="submenu44">
		            <div class="list-group">
		                <a href="javascript:void(0)" onclick="gradeI(2);" class="list-group-item mobility"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade1.png" style="width:10%;">   Độ 1</a>
		                <a href="javascript:void(0)" onclick="gradeII(2);" class="list-group-item mobility"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade2.png" style="width:10%;">   Độ 2</a>
		                <a href="javascript:void(0)" onclick="gradeIII(2);" class="list-group-item mobility"><img src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/mobility-grade3.png" style="width:10%;">   Độ 3</a>	               
		            </div>
		        </div>                    
		    </div>		   
			
	    </div>
	</div>

	<div class="row">

		<div id="teeth_model" class="col-md-5 margin-top-50">

			<div class="btn-group" style="float:left;z-index:9;">
			  <button id="typeTooth" type="button" class="btn btn_bookoke" value="FDI">FDI</button>
			  <button type="button" class="btn btn_bookoke dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
			  </button>
			  <ul class="dropdown-menu">
			  	<li style="margin:0px;"><a href="#" style="padding:5px 10px;">FDI</a></li>
			    <li style="margin:0px;"><a href="#" style="padding:5px 10px;">Universal</a></li>
			    <li style="margin:0px;"><a href="#" style="padding:5px 10px;">Universal Kid</a></li>			  		   
			  </ul>
			</div>


			<a id="note" style="position: absolute;right: 3%;z-index:9;" href="javascript:void(0)"></a>		

			<div id="notePopup" class="popover bottom" style="display: none;max-width:400px;">		

			      	<div style="background-color: #e6e6e5;">
				        <h3 class="popover-title" style="background-color: #e6e6e5;display: inline-block;font-size: 16px;padding: 15px;">CHÚ THÍCH MÀU RĂNG</h3>				        
			        
			        	<a style="float:right;margin: 10px;" href="javascript:void(0)"><div id="ic_close"></div></a>	
			        </div>
			      

			        <div class="popover-content" style="width:450px;margin: 10px;line-height:2;">

			            <div>1. Nhóm tình trạng sức khỏe răng:</div>
						<div class="row" style="margin:0px;line-height:2;font-size:12px;">
							<div class="col-md-6">
								<div><img width="10%" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/color_icon/rang-khoe.jpg">&nbsp;&nbsp;Răng khỏe mạnh</div>
								<div><img width="10%" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/color_icon/rang-benh.jpg">&nbsp;&nbsp;Răng bệnh</div>
							</div>
							<div class="col-md-6">
								<div><img width="10%" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/color_icon/rang-yeu.jpg">&nbsp;&nbsp;Răng yếu</div>
								<div><img width="10%" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/color_icon/rang-mat.jpg">&nbsp;&nbsp;Răng mất</div>
							</div>
						</div>

						<div>2. Nhóm tình trạng sau điều trị:</div>
						<div class="row" style="line-height:2;font-size:12px;">
							<div class="col-md-6">
								<div style="border-left: 2px solid;padding-left: 5px;margin-left: 8px;">
								<div>Răng phục hồi cố định</div>
								<div><img width="10%" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/color_icon/rang-gia-co-dinh.jpg">&nbsp;&nbsp;Răng giả cố định</div>
								<div><img width="10%" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/color_icon/vi-tri-cau-rang-gia.jpg">&nbsp;&nbsp;Vị trí cầu răng giả</div>
								</div>
								<div style="margin-left:15px;"><img width="10%" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/color_icon/rang-phuc-hoi-thao-lap.jpg">&nbsp;&nbsp;Răng phục hồi tháo lắp</div>
								<div style="margin-left:15px;"><img width="10%" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/color_icon/phuc-hoi-implant.jpg">&nbsp;&nbsp;Răng phục hồi Implant</div>
							</div>
							<div class="col-md-6">
								<div><img width="10%" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/color_icon/rang-tram-A.jpg">&nbsp;&nbsp;Răng trám</div>			
							</div>
						</div>
			        </div>			
			</div>				

		<div style="position:relative;width:360px;height:432px; margin:0px auto;">				

			<img id="rang-nguoi-lon-11" class="tooth" title="RĂNG 11" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/11.png" style="position:absolute;width:11%;left: 42%;" <?php if(array_key_exists(11,$listToothData)){echo "data-tooth=".$listToothData[11];}?>>
			<img id="rang-nguoi-lon-12" class="tooth" title="RĂNG 12" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/12.png" style="position:absolute;width:11%;top: 2%;left: 34.5%;" <?php if(array_key_exists(12,$listToothData)){echo "data-tooth=".$listToothData[12];}?>>
			<img id="rang-nguoi-lon-13" class="tooth" title="RĂNG 13" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/13.png" style="position:absolute;width:11%;top: 6%;left: 30%;" <?php if(array_key_exists(13,$listToothData)){echo "data-tooth=".$listToothData[13];}?>>
			<img id="rang-nguoi-lon-14" class="tooth" title="RĂNG 14" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/14.png" style="position:absolute;width:11%;top: 10.5%;left: 26%;" <?php if(array_key_exists(14,$listToothData)){echo "data-tooth=".$listToothData[14];}?>>
			<img id="rang-nguoi-lon-15" class="tooth" title="RĂNG 15" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/15.png" style="position:absolute;width:11%;top: 16.5%;left: 23.5%;" <?php if(array_key_exists(15,$listToothData)){echo "data-tooth=".$listToothData[15];}?>>
			<img id="rang-nguoi-lon-16" class="tooth" title="RĂNG 16" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/16.png" style="position:absolute;width:11%;top: 23.5%;left: 20.5%;" <?php if(array_key_exists(16,$listToothData)){echo "data-tooth=".$listToothData[16];}?>>
			<img id="rang-nguoi-lon-17" class="tooth" title="RĂNG 17" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/17.png" style="position:absolute;width:11%;top: 31%;left: 18.5%;" <?php if(array_key_exists(17,$listToothData)){echo "data-tooth=".$listToothData[17];}?>>
			<img id="rang-nguoi-lon-18" class="tooth" title="RĂNG 18" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/18.png" style="position:absolute;width:11%;top: 39%;left: 18%;" <?php if(array_key_exists(18,$listToothData)){echo "data-tooth=".$listToothData[18];}?>>									
			
			<img id="rang-nguoi-lon-21" class="tooth" title="RĂNG 21" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/21.png" style="position:absolute;width:11%;left: 50.7%;" <?php if(array_key_exists(21,$listToothData)){echo "data-tooth=".$listToothData[21];}?>>
			<img id="rang-nguoi-lon-22" class="tooth" title="RĂNG 22" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/22.png" style="position:absolute;width:11%;top: 1.5%;left: 58%;" <?php if(array_key_exists(22,$listToothData)){echo "data-tooth=".$listToothData[22];}?>>
			<img id="rang-nguoi-lon-23" class="tooth" title="RĂNG 23" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/23.png" style="position:absolute;width:11%;top: 6%;left: 62%;" <?php if(array_key_exists(23,$listToothData)){echo "data-tooth=".$listToothData[23];}?>>
			<img id="rang-nguoi-lon-24" class="tooth" title="RĂNG 24" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/24.png" style="position:absolute;width:11%;top: 10.5%;left: 66%;" <?php if(array_key_exists(24,$listToothData)){echo "data-tooth=".$listToothData[24];}?>>
			<img id="rang-nguoi-lon-25" class="tooth" title="RĂNG 25" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/25.png" style="position:absolute;width:11%;top: 16.5%;left: 69.3%;" <?php if(array_key_exists(25,$listToothData)){echo "data-tooth=".$listToothData[25];}?>>
			<img id="rang-nguoi-lon-26" class="tooth" title="RĂNG 26" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/26.png" style="position:absolute;width:11%;top: 23.3%;left: 71.7%;" <?php if(array_key_exists(26,$listToothData)){echo "data-tooth=".$listToothData[26];}?>>
			<img id="rang-nguoi-lon-27" class="tooth" title="RĂNG 27" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/27.png" style="position:absolute;width:11%;top: 30.7%;left: 74%;" <?php if(array_key_exists(27,$listToothData)){echo "data-tooth=".$listToothData[27];}?>>
			<img id="rang-nguoi-lon-28" class="tooth" title="RĂNG 28" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/28.png" style="position:absolute;width:11%;top: 39%;left: 74%;" <?php if(array_key_exists(28,$listToothData)){echo "data-tooth=".$listToothData[28];}?>>
			
			<img id="rang-nguoi-lon-31" class="tooth" title="RĂNG 31" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/31.png" style="position:absolute;width:11%;top: 91.2%;left: 50.7%;" <?php if(array_key_exists(31,$listToothData)){echo "data-tooth=".$listToothData[31];}?>>
			<img id="rang-nguoi-lon-32" class="tooth" title="RĂNG 32" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/32.png" style="position:absolute;width:11%;top: 89.3%;left: 58%" <?php if(array_key_exists(32,$listToothData)){echo "data-tooth=".$listToothData[32];}?>>
			<img id="rang-nguoi-lon-33" class="tooth" title="RĂNG 33" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/33.png" style="position:absolute;width:11%;top: 85%;left: 62%;" <?php if(array_key_exists(33,$listToothData)){echo "data-tooth=".$listToothData[33];}?>>
			<img id="rang-nguoi-lon-34" class="tooth" title="RĂNG 34" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/34.png" style="position:absolute;width:11%;top: 80.5%;left: 66%;" <?php if(array_key_exists(34,$listToothData)){echo "data-tooth=".$listToothData[34];}?>>
			<img id="rang-nguoi-lon-35" class="tooth" title="RĂNG 35" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/35.png" style="position:absolute;width:11%;top: 74.5%;left: 69.3%;" <?php if(array_key_exists(35,$listToothData)){echo "data-tooth=".$listToothData[35];}?>>
			<img id="rang-nguoi-lon-36" class="tooth" title="RĂNG 36" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/36.png" style="position:absolute;width:11%;top: 67.5%;left: 71.7%;" <?php if(array_key_exists(36,$listToothData)){echo "data-tooth=".$listToothData[36];}?>>
			<img id="rang-nguoi-lon-37" class="tooth" title="RĂNG 37" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/37.png" style="position:absolute;width:11%;top: 60%;left: 73.5%;" <?php if(array_key_exists(37,$listToothData)){echo "data-tooth=".$listToothData[37];}?>>
			<img id="rang-nguoi-lon-38" class="tooth" title="RĂNG 38" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/38.png" style="position:absolute;width:11%;top: 52%;left: 74%;" <?php if(array_key_exists(38,$listToothData)){echo "data-tooth=".$listToothData[38];}?>>

			<img id="rang-nguoi-lon-41" class="tooth" title="RĂNG 41" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/41.png" style="position:absolute;width:11%;top: 91.3%;left: 41.7%;" <?php if(array_key_exists(41,$listToothData)){echo "data-tooth=".$listToothData[41];}?>>
			<img id="rang-nguoi-lon-42" class="tooth" title="RĂNG 42" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/42.png" style="position:absolute;width:11%;top: 89.3%;left: 34.4%;" <?php if(array_key_exists(42,$listToothData)){echo "data-tooth=".$listToothData[42];}?>>
			<img id="rang-nguoi-lon-43" class="tooth" title="RĂNG 43" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/43.png" style="position:absolute;width:11%;top: 85.1%;left: 30.3%;" <?php if(array_key_exists(43,$listToothData)){echo "data-tooth=".$listToothData[43];}?>>
			<img id="rang-nguoi-lon-44" class="tooth" title="RĂNG 44" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/44.png" style="position:absolute;width:11%;top: 80.5%;left: 26.5%;" <?php if(array_key_exists(44,$listToothData)){echo "data-tooth=".$listToothData[44];}?>>
			<img id="rang-nguoi-lon-45" class="tooth" title="RĂNG 45" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/45.png" style="position:absolute;width:11%;top: 74.5%;left: 23%;" <?php if(array_key_exists(45,$listToothData)){echo "data-tooth=".$listToothData[45];}?>>
			<img id="rang-nguoi-lon-46" class="tooth" title="RĂNG 46" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/46.png" style="position:absolute;width:11%;top: 67.5%;left: 20.5%;" <?php if(array_key_exists(46,$listToothData)){echo "data-tooth=".$listToothData[46];}?>>
			<img id="rang-nguoi-lon-47" class="tooth" title="RĂNG 47" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/47.png" style="position:absolute;width:11%;top: 60.1%;left: 18.5%;" <?php if(array_key_exists(47,$listToothData)){echo "data-tooth=".$listToothData[47];}?>>
			<img id="rang-nguoi-lon-48" class="tooth" title="RĂNG 48" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/48.png" style="position:absolute;width:11%;top: 51.9%;left: 18.3%;" <?php if(array_key_exists(48,$listToothData)){echo "data-tooth=".$listToothData[48];}?>>
			<div id="universal_kid" class="hide">
				<img id="rang-nguoi-lon-51" class="tooth" title="RĂNG 51" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/51.png" style="position:absolute;width:11%;top: 23%;left: 43%;" <?php if(array_key_exists(51,$listToothData)){echo "data-tooth=".$listToothData[51];}?>>
				<img id="rang-nguoi-lon-52" class="tooth" title="RĂNG 52" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/52.png" style="position:absolute;width:11%;top: 25%;left: 38%;" <?php if(array_key_exists(52,$listToothData)){echo "data-tooth=".$listToothData[52];}?>>
				<img id="rang-nguoi-lon-53" class="tooth" title="RĂNG 53" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/53.png" style="position:absolute;width:11%;top: 28%;left: 34%;" <?php if(array_key_exists(53,$listToothData)){echo "data-tooth=".$listToothData[53];}?>>
				<img id="rang-nguoi-lon-54" class="tooth" title="RĂNG 54" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/54.png" style="position:absolute;width:11%;top: 32%;left: 31%;" <?php if(array_key_exists(54,$listToothData)){echo "data-tooth=".$listToothData[54];}?>>
				<img id="rang-nguoi-lon-55" class="tooth" title="RĂNG 55" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/55.png" style="position:absolute;width:11%;top: 39%;left: 28%;" <?php if(array_key_exists(55,$listToothData)){echo "data-tooth=".$listToothData[55];}?>>

				<img id="rang-nguoi-lon-61" class="tooth" title="RĂNG 61" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/61.png" style="position:absolute;width:11%;top: 23%;left: 50%;" <?php if(array_key_exists(61,$listToothData)){echo "data-tooth=".$listToothData[61];}?>>
				<img id="rang-nguoi-lon-62" class="tooth" title="RĂNG 62" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/62.png" style="position:absolute;width:11%;top: 25%;left: 55%;" <?php if(array_key_exists(62,$listToothData)){echo "data-tooth=".$listToothData[62];}?>>
				<img id="rang-nguoi-lon-63" class="tooth" title="RĂNG 63" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/63.png" style="position:absolute;width:11%;top: 28%;left: 58%;" <?php if(array_key_exists(63,$listToothData)){echo "data-tooth=".$listToothData[63];}?>>
				<img id="rang-nguoi-lon-64" class="tooth" title="RĂNG 64" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/64.png" style="position:absolute;width:11%;top: 32%;left: 61%;" <?php if(array_key_exists(64,$listToothData)){echo "data-tooth=".$listToothData[64];}?>>
				<img id="rang-nguoi-lon-65" class="tooth" title="RĂNG 65" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/65.png" style="position:absolute;width:11%;top: 39%;left: 64%;" <?php if(array_key_exists(65,$listToothData)){echo "data-tooth=".$listToothData[65];}?>>

				<img id="rang-nguoi-lon-71" class="tooth" title="RĂNG 71" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/71.png" style="position:absolute;width:11%;top: 69%;left: 50%;" <?php if(array_key_exists(71,$listToothData)){echo "data-tooth=".$listToothData[71];}?>>
				<img id="rang-nguoi-lon-72" class="tooth" title="RĂNG 72" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/72.png" style="position:absolute;width:11%;top: 67%;left: 55%;" <?php if(array_key_exists(72,$listToothData)){echo "data-tooth=".$listToothData[72];}?>>
				<img id="rang-nguoi-lon-73" class="tooth" title="RĂNG 73" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/73.png" style="position:absolute;width:11%;top: 64%;left: 58%;" <?php if(array_key_exists(73,$listToothData)){echo "data-tooth=".$listToothData[73];}?>>
				<img id="rang-nguoi-lon-74" class="tooth" title="RĂNG 74" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/74.png" style="position:absolute;width:11%;top: 59%;left: 61%;" <?php if(array_key_exists(74,$listToothData)){echo "data-tooth=".$listToothData[74];}?>>
				<img id="rang-nguoi-lon-75" class="tooth" title="RĂNG 75" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/75.png" style="position:absolute;width:11%;top: 52%;left: 64%;" <?php if(array_key_exists(75,$listToothData)){echo "data-tooth=".$listToothData[75];}?>>

				<img id="rang-nguoi-lon-81" class="tooth" title="RĂNG 81" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/81.png" style="position:absolute;width:11%;top: 69%;left: 43%;" <?php if(array_key_exists(81,$listToothData)){echo "data-tooth=".$listToothData[81];}?>>
				<img id="rang-nguoi-lon-82" class="tooth" title="RĂNG 82" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/82.png" style="position:absolute;width:11%;top: 67%;left: 38%;" <?php if(array_key_exists(82,$listToothData)){echo "data-tooth=".$listToothData[82];}?>>
				<img id="rang-nguoi-lon-83" class="tooth" title="RĂNG 83" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/83.png" style="position:absolute;width:11%;top: 64%;left: 34%;" <?php if(array_key_exists(83,$listToothData)){echo "data-tooth=".$listToothData[83];}?>>
				<img id="rang-nguoi-lon-84" class="tooth" title="RĂNG 84" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/84.png" style="position:absolute;width:11%;top: 59%;left: 31%;" <?php if(array_key_exists(84,$listToothData)){echo "data-tooth=".$listToothData[84];}?>>
				<img id="rang-nguoi-lon-85" class="tooth" title="RĂNG 85" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/medical/rang/85.png" style="position:absolute;width:11%;top: 52%;left: 28%;" <?php if(array_key_exists(85,$listToothData)){echo "data-tooth=".$listToothData[85];}?>>
			</div>
			<div id="toggle-dental">
				<center><h5 id="tooth_number"></h5></center>		
				<div onclick="openNav()"><span>THÊM TÌNH TRẠNG</span></div>
				<div data-toggle="modal" data-target="#noteToothModal"><span>THÊM GHI CHÚ</span></div>
				<div onclick="retype();"><span>NHẬP LẠI</span></div>
															 
			</div>
			
		
		</div>
		</div>
		<div class="col-md-7 margin-top-50">				
			<div style="background: url(<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/bg-rang.png) no-repeat; background-size: 100%;">
			<div class="row opacity-0" id="row_opacity">
			<h3 align="center" id="tooth_title">- RĂNG 17 -</h3>
				<div class="col-md-4">
					<div class="table" style="width:100%; height:432px; text-align:center;">
				      <div class="cell">
				      	<div id="nhai" style="position:relative;width:60%;margin: 0px auto;">
				        	<img id="mat-nhai" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matnhai-17.png" style="width: 100%;height: auto;">				        	
				        	<h5 style="color: #000;font-weight: normal;">MẶT NHAI</h5>
				        	<?php 
				        	if (!empty($listFaceTooth)) 
				        	{				        	
				        	foreach ($listFaceTooth as $vl) 
				        	{	
				        		$listToothImage = $tooth_data->getListToothImage($model->id,$id_mhg,$vl['tooth_number'],"matnhai");			        	
				        	?>
					        	<div id="mat_nhai_<?php echo $vl['tooth_number'];?>" class="mat">
					        	<?php 
					        	if (!empty($listToothImage)) 
					        	{				        	
					        	foreach ($listToothImage as $v) 
					        	{	
					        	?>
					        	<img id="<?php echo $v['id_image'];?>" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/<?php echo $v['src_image'];?>" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">
					        	<?php 
					        	}
					        	}				        	
					        	?>
					        	</div>	
				        	<?php 
				        	}
				        	}				        	
				        	?>
				        </div> 
				       </div>    
				    </div>
				</div>

				<div class="col-md-8">
					<div class="row">
						<div class="col-md-6">
							<div class="table" style="width:100%;text-align:center;">
				      			<div class="cell">
									<div id="ngoai" style="position:relative;width:60%;margin: 0px auto;">										
										<img id="mat-ngoai" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matngoai-17.png" style="width: 100%;height: auto;">										
										<h5 style="color: #000;font-weight: normal;">MẶT NGOÀI</h5>
										<?php 
										if (!empty($listFaceTooth)) 
				        				{
							        	foreach ($listFaceTooth as $vl) 
							        	{		
							        		$listToothImage = $tooth_data->getListToothImage($model->id,$id_mhg,$vl['tooth_number'],"matngoai");		        	
							        	?>
								        	<div id="mat_ngoai_<?php echo $vl['tooth_number'];?>" class="mat">
								        	<?php 
								        	if (!empty($listToothImage)) 
								        	{				        	
								        	foreach ($listToothImage as $v) 
								        	{	
								        	?>
								        	<img id="<?php echo $v['id_image'];?>" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/<?php echo $v['src_image'];?>" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">
								        	<?php 
								        	}
								        	}				        	
								        	?>	
								        	</div>	
							        	<?php 
							        	}
							        	}
							        	?>	
									</div>
								</div>
							</div>		
						</div>
						<div class="col-md-6">
							<div class="table" style="width:100%;text-align:center;">
				      			<div class="cell">
									<div id="trong" style="position:relative;width:60%;">
										<img id="mat-trong" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/mattrong-17.png" style="width: 100%;height: auto;">										
										<h5 style="color: #000;font-weight: normal;">MẶT TRONG</h5>
										<?php 
										if (!empty($listFaceTooth)) 
				        				{	
							        	foreach ($listFaceTooth as $vl) 
							        	{			
							        		$listToothImage = $tooth_data->getListToothImage($model->id,$id_mhg,$vl['tooth_number'],"mattrong");	        	
							        	?>
								        	<div id="mat_trong_<?php echo $vl['tooth_number'];?>" class="mat">
								        	<?php 
								        	if (!empty($listToothImage)) 
								        	{				        	
								        	foreach ($listToothImage as $v) 
								        	{	
								        	?>
								        	<img id="<?php echo $v['id_image'];?>" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/<?php echo $v['src_image'];?>" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">
								        	<?php 
								        	}
								        	}				        	
								        	?>			
								        	</div>	
							        	<?php 
							        	}
							        	}
							        	?>
									</div>
								</div>
							</div>		
						</div>
						<div class="col-md-6">
							<div class="table" style="width:100%;text-align:center;">
								<div class="cell">
									<div id="gan" style="position:relative;width:60%;margin: 0px auto;">										
										<img id="mat-gan" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matgan-17.png" style="width: 100%;height: auto;">
										<h5 style="color: #000;font-weight: normal;">MẶT GẦN</h5>
										<?php 
										if (!empty($listFaceTooth)) 
				        				{	
							        	foreach ($listFaceTooth as $vl) 
							        	{	
							        		$listToothImage = $tooth_data->getListToothImage($model->id,$id_mhg,$vl['tooth_number'],"matgan");			        	
							        	?>
								        	<div id="mat_gan_<?php echo $vl['tooth_number'];?>" class="mat">
								        	<?php 
								        	if (!empty($listToothImage)) 
								        	{				        	
								        	foreach ($listToothImage as $v) 
								        	{	
								        	?>
								        	<img id="<?php echo $v['id_image'];?>" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/<?php echo $v['src_image'];?>" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">
								        	<?php 
								        	}
								        	}				        	
								        	?>
								        	</div>	
							        	<?php 
							        	}
							        	}
							        	?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="table" style="width:100%;text-align:center;">
								<div class="cell">
									<div id="xa" style="position:relative;width:60%;">										
										<img id="mat-xa" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matxa-17.png" style="width: 100%;height: auto;">
										<h5 style="color: #000;font-weight: normal;">MẶT XA</h5>
										<?php 
										if (!empty($listFaceTooth)) 
				        				{
							        	foreach ($listFaceTooth as $vl) 
							        	{	
							        		$listToothImage = $tooth_data->getListToothImage($model->id,$id_mhg,$vl['tooth_number'],"matxa");			        	
							        	?>
							        		<div id="mat_xa_<?php echo $vl['tooth_number'];?>" class="mat">
							        		<?php 
								        	if (!empty($listToothImage)) 
								        	{				        	
								        	foreach ($listToothImage as $v) 
								        	{	
								        	?>
								        	<img id="<?php echo $v['id_image'];?>" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/<?php echo $v['src_image'];?>" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">
								        	<?php 
								        	}
								        	}				        	
								        	?>	
							        		</div>	
							        	<?php 
							        	}
							        	}	
							        	?>
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
			</div>
		</div>

		<input type="hidden" id="hidden_number">
		<input type="hidden" id="hidden_string_number">
		<input type="hidden" id="id_user" value="<?php echo yii::app()->user->getState('user_id');?>">

	</div>

	<div class="row">
		<div class="col-md-5 margin-top-30">
			<h5 style="color:#5e5e5e;font-size:18px;">Chỉ định</h5>
			<textarea id="evaluate_state_of_tartar" onchange="updateEvaluateStateOfTartar(<?php echo $id_mhg;?>);" class="form-control" rows="5" placeholder="Đánh giá..." style="height:100%;background-color: #f1f5f6;border:0;"><?php echo $evaluateStateOfTartar->evaluate_state_of_tartar;?></textarea>
			

		</div>
		<div class="col-md-7 margin-top-30">
			<h5 style="color:#5e5e5e;font-size:18px;">Tình trạng</h5>
			<div class="col-md-12 margin-bottom-50" style="background-color:#f1f5f6;border-radius: 4px;padding-top:15px;min-height: 115px;">
				
				

				<div id="div_conclude">
				<p id="voi_rang_do_1" class="hide"><i>Răng</i> <i class="tooth_numbers"></i><i>: Vôi răng, Độ 1</i></p>
				<p id="voi_rang_do_2" class="hide"><i>Răng</i> <i class="tooth_numbers"></i><i>: Vôi răng, Độ 2</i></p>
				<p id="voi_rang_do_3" class="hide"><i>Răng</i> <i class="tooth_numbers"></i><i>: Vôi răng, Độ 3</i></p>
				<p id="rang_mat" class="hide"><i>Răng</i> <i class="tooth_numbers"></i><i>: Răng mất</i></p>		
				<?php 
					if (!empty($listToothStatus)) {	
					foreach ($listToothStatus as $tooth_status) {
	
				?>										
						<p id="ket_luan_<?php echo $tooth_status['tooth_number'];?>" class="ket">
							<i>Răng <?php echo $tooth_status['tooth_number'];?>: </i>
							<?php 
							if (!empty($tooth_status['listToothConclude'])) {

							$data_flag = array();		

							foreach ($tooth_status['listToothConclude'] as $tooth_conclude) { 

								$type = explode("-", $tooth_conclude['id_i']);

									switch ($type[1]) {

									    case 108: case 109: case 110: case 111: case 112: case 113: case 114: case 115: case 116:

									    	$flag = 101;	

									    	$muc = '';								    	

									    	if (!in_array($flag, $data_flag, false)) {
									    	
									    		$data_flag[] = $flag;

										        $muc='<i id="muc-'.$flag.'-'.$type[2].'" data-toggle="tooltip" title="'.$model->getNameByIdDentist($tooth_conclude["id_user"]).'">Phục hồi miếng trám</i>';

									        }

									        break;

								        case 117: case 118: case 119: case 120: case 121: case 122: case 123: case 124: case 125:

									    	$flag = 102;	

									    	$muc = '';								   

									    	if (!in_array($flag, $data_flag, false)) {
									    	
									    		$data_flag[] = $flag;

										        $muc='<i id="muc-'.$flag.'-'.$type[2].'" data-toggle="tooltip" title="'.$model->getNameByIdDentist($tooth_conclude["id_user"]).'">Sâu răng</i>';
										        
									        }

									        break;	

									    case 126: case 127: case 128: 

									    	$flag = 103;	

									    	$muc = '';								   

									    	if (!in_array($flag, $data_flag, false)) {
									    	
									    		$data_flag[] = $flag;

										        $muc='<i id="muc-'.$flag.'-'.$type[2].'" data-toggle="tooltip" title="'.$model->getNameByIdDentist($tooth_conclude["id_user"]).'">Đau răng</i>';
										        
									        }

									        break;

									    case 129: case 130: case 131:

									    	$flag = 104;	

									    	$muc = '';								   

									    	if (!in_array($flag, $data_flag, false)) {
									    	
									    		$data_flag[] = $flag;

										        $muc='<i id="muc-'.$flag.'-'.$type[2].'" data-toggle="tooltip" title="'.$model->getNameByIdDentist($tooth_conclude["id_user"]).'">Nứt răng</i>';
										        
									        }

									        break; 

									     case 132: case 133: case 134: case 135:

									    	$flag = 105;	

									    	$muc = '';								   

									    	if (!in_array($flag, $data_flag, false)) {
									    	
									    		$data_flag[] = $flag;

										        $muc='<i id="muc-'.$flag.'-'.$type[2].'" data-toggle="tooltip" title="'.$model->getNameByIdDentist($tooth_conclude["id_user"]).'">Vôi răng</i>';
										        
									        }

									        break; 

									    case 136: case 137: case 138: 

									    	$flag = 106;	

									    	$muc = '';								   

									    	if (!in_array($flag, $data_flag, false)) {
									    	
									    		$data_flag[] = $flag;

										        $muc='<i id="muc-'.$flag.'-'.$type[2].'" data-toggle="tooltip" title="'.$model->getNameByIdDentist($tooth_conclude["id_user"]).'">Lung lay</i>';
										        
									        }

									        break;  									     	    

									    default:

									    	$muc = '';
									}

									if ($muc) echo $muc;

							?>
								<i id="<?php echo $tooth_conclude['id_i']?>" data-user="<?php echo $tooth_conclude['id_user'];?>" data-toggle="tooltip" title="<?php echo $model->getNameByIdDentist($tooth_conclude['id_user']);?>"><?php echo $tooth_conclude['conclude']?></i>
							<?php } } ?>
						</p> 
						<p id="ghi_chu_<?php echo $tooth_status['tooth_number'];?>" class="ghi"><?php if($tooth_status['note'] != "") echo "Ghi chú: ".$tooth_status['note'];?></p>	
				<?php }	}
				if (!empty($listOnlyToothNote)) {	
				foreach ($listOnlyToothNote as $tooth_note) {				
				?>
					<p id="ket_luan_<?php echo $tooth_note['tooth_number'];?>" class="ket">
						<i>Răng <?php echo $tooth_note['tooth_number'];?>:</i>						
					</p> 
					<p id="ghi_chu_<?php echo $tooth_note['tooth_number'];?>" class="ghi"><?php echo "Ghi chú: ".$tooth_note['note'];?></p>					
				<?php }	} ?>				
				</div>

			</div>
		</div>
	</div>
</div>
