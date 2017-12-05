
<div class="customerProfileContainer">

<div class="customerProfileHolder" style="display: block;margin:30px auto;">

<table class="table table-package table-boooke">

    <thead>

        <tr role="row">

        	<th tabindex="0" rowspan="1" colspan="1">Mã khách hàng</th>

            <th tabindex="0" rowspan="1" colspan="1">Tên khách hàng</th>

	        <th tabindex="0" rowspan="1" colspan="1">Giới tính</th>	        	

	        <th tabindex="0" rowspan="1" colspan="1">Số điện thoại</th>

        </tr>

    </thead>

    <tbody id="bodyTblContent">  
    <?php     
    if(!empty($data))
    {          
        foreach ($data as $key => $value) 
        {              
            
    ?>
        <tr class="background-color-f1f5f6">
            <td><?php echo $value['code_number'];?></td>
            <td><?php echo $value['fullname'];?></td>
            <td><?php if($value['gender']==0) echo "Nam"; else echo "Nữ";?></td>
            <td><?php echo $value['phone'];?></td>               
        </tr>        

    <?php 
        }
    }
    else
    {
    ?> 
    <tr role="row" class="odd">
        <td colspan="4" align="center">Không có dữ liệu!</td>
    </tr>             
    <?php 
    }
    ?>                    
    </tbody>
    </table>
<br>
<div style="clear:both"></div>

<div align="center"><?php echo $lst;?></div>
</div>
</div>
