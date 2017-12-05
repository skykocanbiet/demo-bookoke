<?php $baseUrl = Yii::app()->baseUrl;?>
<form class="form-horizontal">



		<!-- BỆNH SỬ Y KHOA -->
		<div class="row margin-top-15">   
			<h4>1. BỆNH SỬ Y KHOA</h4>                        		
		</div>
		<div class="row">  
		   	<div class="col-md-5">
		   		<div class="form-group">                		
					<label class="col-md-5 col-md-offset-1 col-sm-5 col-sm-offset-1 control-label">Tình trạng sức khỏe chung:</label>
					<div class="col-md-6 col-sm-6">
						<label class="radio-inline"><input type="radio" name="optradio">Khỏe mạnh</label>											
					</div>						
				</div>	
				<div class="form-group">                		
					<label class="col-md-11 col-md-offset-1 col-sm-11 col-sm-offset-1 control-label">Bệnh nhân mắc phải:</label>
					
						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2">
							<div class="checkbox">
							  <label><input type="checkbox" value="">Chảy máu kéo dài</label>
							</div>
							<div class="checkbox">
							  <label><input type="checkbox" value="">Tiểu đường</label>
							</div>
							<div class="checkbox disabled">
							  <label><input type="checkbox" value="">Đau bao tử</label>
							</div>											
						</div>	

						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2">
							<div class="checkbox">
							  <label><input type="checkbox" value="">Chảy máu kéo dài</label>
							</div>
							<div class="checkbox">
							  <label><input type="checkbox" value="">Tiểu đường</label>
							</div>
							<div class="checkbox disabled">
							  <label><input type="checkbox" value="">Đau bao tử</label>
							</div>											
						</div>				

				</div>			
		   	</div>
					
		</div> 
		
		

		<!-- TÌNH TRẠNG RĂNG -->
		<div class="row">   
			<h4>2. TÌNH TRẠNG RĂNG</h4>                        		
		</div> 
		<div class="row">   
			 <div class="col-md-5">
			 	
			 </div> 
			 <div class="col-md-7">
			 	
			 </div>                     		
		</div> 

		<!-- QUÁ TRÌNH ĐIỀU TRỊ -->
		<div class="row">   
			<h4>3. CHẨN ĐOÁN ĐIỀU TRỊ</h4>                        		
		</div> 
		<div class="row">	
			<div class="col-md-10 col-md-offset-1">
				<div class="table-responsive">
				<table border="0">				    
				    <tbody>
				      <tr>
				        <td>1.</td>
				        <td>Phương pháp điều trị cho răng 35 (liệu trình 1 ngày).........................................................................................................................................................................................................</td>
				        <th><span id="btn-search-taxi" class="btn btn-dangerous" style="background: #00AADC;color: #ffffff;">Đồng ý áp dụng</span></th>				        
				      </tr>	
				      <tr>
				        <td>2.</td>
				        <td>Phương pháp điều trị cho răng 12 (liệu trình 1 ngày).........................................................................................................................................................................................................</td>
				        <th><span id="btn-search-taxi" class="btn btn-dangerous" style="background: #00AADC;color: #ffffff;">Đồng ý áp dụng</span></th>				        
				      </tr>	
				      <tr>
				        <td>3.</td>
				        <td>Phương pháp điều trị 34 (liệu trình 1 ngày)......................................................................................................................................................................................................................</td>
				        <th><span id="btn-search-taxi" class="btn btn-dangerous" style="background: #00AADC;color: #ffffff;">Đồng ý áp dụng</span></th>				        
				      </tr>	
				      <tr>
				        <td>4.</td>
				        <td>Phương pháp điều trị 11 (liệu trình 1 ngày)......................................................................................................................................................................................................................</td>
				        <th><span id="btn-search-taxi" class="btn btn-dangerous" style="background: #00AADC;color: #ffffff;">Đồng ý áp dụng</span></th>				        
				      </tr>				      
				    </tbody>
				</table>
				</div>
			</div>
			
		</div>							 
		
		<!-- QUÁ TRÌNH ĐIỀU TRỊ ĐỢT 4 -->
		<div class="row">   
			<h4>4. QUÁ TRÌNH ĐIỀU TRỊ ĐỢT 4</h4>                        		
		</div> 
		<div class="row">
			<div class="col-md-5">
				<div class="form-group">                		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Công tác điều trị:</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" value="Chữa viêm chân răng 23 Trám răng 17" />		
					</div>	
				</div>
				<div class="form-group">                		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Ngày tiến hành:</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" value="12/12/2016" />		
					</div>	
				</div>
				<div class="form-group">                		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Ngày hoàn tất:</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" value="Chưa hoàn tất" />		
					</div>	
				</div>
			</div>
			<div class="col-md-5 col-md-offset-1">
				<div class="form-group">                		
					<label class="col-md-4 col-sm-4 control-label text-align-right">BS phụ trách:</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" value="Nguyễn Văn Anh" />								
					</div>	
				</div>
				<div class="form-group">                		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Ghi chú:</label>
					<div class="col-md-8 col-sm-8">
						<textarea class="form-control" rows="3" style="height:100%;">Trước khi tiến hành điều trị phải tạo vôi răng Cho bệnh nhân sử dụng thêm thuốc abc. Cho bệnh nhân sử dụng thêm thuốc abc.</textarea>		
					</div>
				</div>
			</div>

			<div class="col-md-10 col-md-offset-1">
				<div class="table-responsive">
				<table class="table table-bordered">
				    <thead>
				      <tr>
				        <th>Lần</th>
				        <th>Ngày</th>
				        <th>Công tác điều trị</th>
				        <th>Thời gian</th>
				        <th>BS điều trị</th>
				        <th></th>
				      </tr>
				    </thead>
				    <tbody>
				      <tr>
				        <td>1</td>
				        <td>12/12/2016</td>
				        <th>Cạo vôi răng</th>
				        <th>60 phút</th>
				        <th>BS. Nguyễn Văn Anh</th>
				        <th>...</th>
				      </tr>
				      <tr>
				        <td>2</td>
				        <td>12/12/2016</td>
				        <th>Cạo vôi răng</th>
				        <th>60 phút</th>
				        <th>BS. Nguyễn Văn Anh</th>
				        <th>...</th>
				      </tr>
				      <tr>
				        <td>3</td>
				        <td>12/12/2016</td>
				        <th>Cạo vôi răng</th>
				        <th>60 phút</th>
				        <th>BS. Nguyễn Văn Anh</th>
				        <th>...</th>
				      </tr>
				    </tbody>
				</table>
				</div>
				<div style="background-color: #F2F4F4;margin-top:50px;">
					<div style="background-color: rgba(0, 0, 0, 0.5);">
						<h4 style="color: #fff;margin:0 10px;">CHI TIẾT LẦN 1</h4>
					</div>
					<div class="row">
				
						<div class="col-md-6" style="padding-top: 50px;border-right: 2px solid #fff;">							
							<div class="form-group">                        		
								<label class="col-md-4 col-sm-4 control-label text-align-right">Thời gian:</label>
								<div class="col-md-8 col-sm-8">
									<input type="text" class="form-control" value="12/12/2016" />		
								</div>								
							</div> 
							<div class="form-group">                        		
								<label class="col-md-4 col-sm-4 control-label text-align-right">Bác sĩ chữa trị:</label>
								<div class="col-md-8 col-sm-8">
									<input type="text" class="form-control" value="BS. Nguyễn Văn Anh" />		
								</div>								
							</div> 	
							<div class="form-group">                        		
								<label class="col-md-4 col-sm-4 control-label text-align-right">Bác sĩ chữa trị:</label>
								<div class="col-md-8 col-sm-8">
									<input type="text" class="form-control" value="BS. Nguyễn Văn Anh" />		
								</div>								
							</div> 
							<div class="form-group">                        		
								<label class="col-md-4 col-sm-4 control-label text-align-right">Thời gian tiến hành điều trị:</label>
								<div class="col-md-8 col-sm-8">
									<input type="text" class="form-control" value="60 phút" />		
								</div>								
							</div> 
							<div class="form-group">                        		
								<label class="col-md-4 col-sm-4 control-label text-align-right">Thuốc trong quá trình điều trị:</label>
								<div class="col-md-8 col-sm-8">
									<textarea class="form-control" rows="3" style="height:100%;">Loại thuốc A (liều lượng) Loại thuốc B (liều lượng)</textarea>		
								</div>								
							</div>	
							<div class="form-group">                        		
								<label class="col-md-4 col-sm-4 control-label text-align-right">Thuốc sau điều trị:</label>
								<div class="col-md-8 col-sm-8">
									<input type="text" class="form-control" value="Không" />		
								</div>								
							</div> 	
							<div class="form-group">                        		
								<label class="col-md-4 col-sm-4 control-label text-align-right">Kết quả điều trị:</label>
								<div class="col-md-8 col-sm-8">
									<input type="text" class="form-control" value="Tốt" />		
								</div>								
							</div> 
							<div class="form-group">                        		
								<label class="col-md-4 col-sm-4 control-label text-align-right">Ngày tái khám:</label>
								<div class="col-md-8 col-sm-8">
									<input type="text" class="form-control" value="Không" />		
								</div>								
							</div> 						
						</div>
					
				
						<div class="col-md-6 margin-top-15">							
							<div class="form-group" style="border-bottom: 2px solid #fff;padding-bottom: 30px;">                        		
								<label class="col-md-12 col-sm-12 control-label" style="padding-bottom: 15px;">Ghi chú</label>
								<div class="col-md-11 col-sm-11">
									<textarea class="form-control" rows="5" style="height:100%;">- Có 2 răng bệnh ( răng khôn số 7 hàm trên có dấu hiệu viêm chân răng, răng số 5 hàm dưới bể 1 góc nhỏ) - Tiến hành điều trị từng răng theo mức độ cần thiết.</textarea>		
								</div>								
							</div> 	
						</div>
			
					</div>
				</div>
				

			</div>

		</div>
	

	
	



</form>