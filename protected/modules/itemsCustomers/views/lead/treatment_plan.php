						
<div class="row">	
	<div class="col-md-10 col-md-offset-1">
		<div class="table-responsive">
		<table id="table-diagnosis" border="0">				    
		    <tbody>
		    <?php 
		    $attribs = array('id_history_gourp'=>$id_history_group);
			$criteria = new CDbCriteria(array('order'=>'id DESC'));
		    $list_plan=CsMedicalHistoryPlan::model()->findAllByAttributes($attribs,$criteria);
		    foreach ($list_plan as $k_l_p => $l_p) 
		    {
		    ?>
		      <tr>
		        <td><?php echo $k_l_p+1;?>.</td>
		        <td class="td-apply1" style="text-align:left;"><?php echo $l_p['name'];?></td>
		        <td class="td-apply"><span class="btn btn-dangerous btn-apply">Đồng ý áp dụng</span></td>				        
		      </tr>
		    <?php 
		    }
		    ?>
		    </tbody>
		</table>
		</div>
	</div>								
</div>
