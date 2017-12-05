<style>

h3, h4 {
  color:#000;
}

table {
  width: 100%;
}

table tbody tr td {
  color: #222;
  padding-top: 20px;
}  

</style>
<page backtop="5mm" backbottom="5mm" backleft="5mm" backright="5mm" format="Letter" backcolor="#fff" style="font: arial;font-family:freeserif;font-size:16px;">
<div style="padding-left: 20px;padding-right: 20px;">

        <div>
            <table style="margin-top: 20px;">             
              <tbody>
                <tr>
                    <td style="width:30%;">    
                   		<?php echo CHtml::image('images/logo_vi.png', 'DORE', array('width'=>200)); ?>	
                    </td>                     
                    <td style="width:70%;"> 
                      <?php $branch = $model->getBranchById(1);?>   
                      Cơ sở 1: <br>
                      <?php echo $branch->address;?> <br>
                      T: <?php echo $branch->hotline1;?> <br>   
                      E: <?php echo $branch->email;?> <br>           
                    </td> 
                </tr>            
              </tbody>
            </table>
            
        </div> 

        <h3 align="center" style="margin-top: 50px;">TOA THUỐC</h3>

        <div>
           
            <table>  
              	<tbody>

                 	<tr>
	                    <td style="width:60%;">Họ và tên bệnh nhân: <?php echo $model->fullname;?></td>
                    	<td style="width:40%;">tuổi: <?php if($model->birthdate != '0000-00-00' && $model->birthdate != '') echo date("Y") - date('Y',strtotime($model->birthdate));?></td>
                	</tr>  

	                <tr>
		                <td>
		                    Địa chỉ: <?php echo $model->address;?>
		                </td>
	                </tr>

	                <tr>
		                <td>
		                    Chẩn đoán: <?php echo $data['diagnose'];?>
		                </td>
	                </tr>

              </tbody>
            </table>
            
        </div> 

        <h4 align="center" style="margin-top: 30px;">THUỐC VÀ CÁCH SỬ DỤNG</h4>

        <div>
           
            <table>  
              	<tbody style="li">
                <?php 
                foreach ($data['listDrugAndUsage'] as $key => $value) 
                {       
                ?>
                	<tr>
	                    <td>
	                    <?php echo $key+1;?>. <?php echo $value['drug_name'];?>
	                    </td>                   
                	</tr>               
                	<tr>		               
                    <td style="width: 12.5%;">Sáng:</td>
                    <td style="width: 12.5%;"><?php echo $value['morning'];?></td>
                    <td style="width: 12.5%;">Trưa:</td>
                    <td style="width: 12.5%;"><?php echo $value['noon'];?></td>
                    <td style="width: 12.5%;">Chiều:</td>
                    <td style="width: 12.5%;"><?php echo $value['afternoon'];?></td>
                    <td style="width: 12.5%;">Tối:</td>
                    <td style="width: 12.5%;"><?php echo $value['night'];?></td>
                	</tr>  
                <?php 
                }
                ?>

              </tbody>
            </table>
            
        </div>         


        <div style="margin-top: 30px;">
           
            <table>  
              	<tbody>
                	<tr>
	                    <td style="width: 50%;">
	                    	<strong>Lời dặn</strong>: <?php echo $data['advise'];?>
	                    </td> 
	                    
	                    <td style="width: 50%;">
	                    	Tp. HCM, ngày <?php echo date('d',strtotime($data['createdate']));?> tháng <?php echo date('m',strtotime($data['createdate']));?> năm <?php echo date('Y',strtotime($data['createdate']));?>
	                    </td>                  
                	</tr> 
                  <?php 
                  if ($data['examination_after'] != "") 
                  {                    
                  ?>  
                  <tr>
                      <td>
                      Tái khám sau <?php echo $data['examination_after'];?> ngày
                      </td>                   
                  </tr>   
                  <?php 
                  }
                  ?>
                  <tr>
                    <td>Nhớ mang theo toa này.</td>
                    <td><strong>Bác sĩ</strong>: <?php echo $data['dentist'];?></td>
                  </tr>   
              	</tbody>
            </table>
            
        </div>   
        
      
</div>
</page>

