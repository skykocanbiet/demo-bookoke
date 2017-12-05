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

        

        <h3 align="center" style="margin-top: 50px;">THÔNG TIN GIAO NHẬN LABO</h3>

        <div>
           
            <table>  
              	<tbody>

                  <tr>
                    <td>
                        <strong>Nha Khoa</strong>: <?php echo $model->getNameByIdBranch($data['id_branch']);?>
                    </td>
                  </tr>

                  <tr>
                    <td>
                        <strong>Labo</strong>: <?php echo $model->getNameByIdLaboElite($data['id_labo_elite']);?>
                    </td>
                  </tr>

                 	<tr>
	                    <td style="width:40%;"><strong>Bệnh Nhân</strong>: <?php echo $model->fullname;?></td>
                    	<td style="width:20%;"><strong>Tuổi</strong> <?php if($model->birthdate != '0000-00-00' && $model->birthdate != '') echo date("Y") - date('Y',strtotime($model->birthdate));?></td>
                      <td style="width:40%;"><strong>Giới tính</strong>: <?php if($model->gender==0) echo "Nam"; else echo "Nữ";?></td>                      
                	</tr>      

              </tbody>

            </table>

            <table>  

                <tbody>                  

                  <tr>
                      <td style="width:15%;"><strong>Ngày Gửi</strong>: <?php echo date('d',strtotime($data['sent_date']));?></td>
                      <td style="width:15%;"><strong>Tháng</strong>: <?php echo date('m',strtotime($data['sent_date']));?></td>
                      <td style="width:15%;"><strong>Năm</strong>: <?php echo date('Y',strtotime($data['sent_date']));?></td>                     
                  </tr> 

                   <tr>
                      <td><strong>Ngày Nhận</strong>: <?php echo date('d',strtotime($data['received_date']));?></td>
                      <td><strong>Tháng</strong>: <?php echo date('m',strtotime($data['received_date']));?></td>
                      <td><strong>Năm</strong>: <?php echo date('Y',strtotime($data['received_date']));?></td>                     
                  </tr> 

                  <tr>
                      <td><strong>Chỉ Định Của Bác Sĩ</strong> <?php echo $data['assign'];?></td>
                     
                  </tr> 

                   <tr>
                      <td><strong>Ghi Chú</strong>: <?php echo $data['note'];?></td>
                     
                  </tr> 

              </tbody>

            </table>
            
        </div>  

      
</div>
</page>

