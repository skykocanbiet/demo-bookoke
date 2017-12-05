<div id="oInfo" class="col-md-12">

    <div class="row">
        <div class="col-md-6">           

            <div class="row">
                <div class="col-md-7" id="pf_qh_tt">Chi tiết điều trị:</div>
                <div class="col-md-5"><?php echo $v['name'];?></div>
            </div>

            <div class="row">
                <div class="col-md-7" id="pf_qh_tt">Bác sĩ điều trị:</div>
                <div class="col-md-5">BS. <?php echo $v['gp_users_name'];?></div>
            </div> 
            
            <div class="row">   
                <div class="col-md-7" id="pf_qh_tt">Toa thuốc:</div>
                <div class="col-md-5"><?php if($v['medicine_during_treatment']!="") echo $v['medicine_during_treatment']; else echo "Không";?></div>                
            </div>       
                                                                                     
        </div>
        <div class="col-md-6">          

            <div class="row">   
                <div class="col-md-7" id="pf_qh_tt">Ngày tái khám:</div>
                <div class="col-md-5"><?php if($v['reviewdate']!=0) echo date('d/m/Y',strtotime($v['reviewdate'])); else echo "Không";?></div>
            </div> 

            <div class="row">   
                <div class="col-md-7" id="pf_qh_tt">Ghi chú:</div>
                <div class="col-md-5"><?php if($v['description']!="") echo $v['description']; else echo "Không";?></div>
            </div> 

        </div>
    </div>

</div>


