 <?php
 //print_r(json_encode($list_data['data']));exit;   
  $baseUrl = Yii::app()->baseUrl;?>
   

                                       
        <?php  
        if(!empty($list_data['data']))
        {  

        foreach($list_data['data'] as $k=> $value)
        {
            $date = date("Y-m-d", strtotime($value['schedule_date']));
            if(strtotime($date) < strtotime(date('Y-m-d')) and strtotime($value['schedule_date']) != "0"){

        ?>

        <li id="c<?php echo $value['id_customer'];?>" onclick="detailCustomer(<?php echo $value['id_customer'];?>);"  class="n 1" >
                                        
                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                            <a href="#" class="jqTransformCheckbox"></a>
                                            <input type="checkbox" value="<?php echo $value['id_customer'];?>" class="fl" style="display : none;">
                                        </span>
                                        
                                        <img src="<?php echo $baseUrl; ?>/upload/customer/avatar/<?php if($value['image']!="") echo $value['image']; else echo "no_avatar.png";?>" class="fl" style="border-radius:100%;">
                                        <label class="fl"><?php echo $value['fullname'];?> </label>
                                        <div class="clearfix"></div>
        </li>
        
        <?php
    }

        }
        foreach($list_data['data'] as $k=> $value)
        {
            $date = date("Y-m-d", strtotime($value['schedule_date']));
            if(strtotime($date) == strtotime(date('Y-m-d'))){
?>
<li id="c<?php echo $value['id_customer'];?>" onclick="detailCustomer(<?php echo $value['id_customer'];?>);"  class="n 2" >
                                        
                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                            <a href="#" class="jqTransformCheckbox"></a>
                                            <input type="checkbox" value="<?php echo $value['id_customer'];?>" class="fl" style="display : none;">
                                        </span>
                                        
                                        <img src="<?php echo $baseUrl; ?>/upload/customer/avatar/<?php if($value['image']!="") echo $value['image']; else echo "no_avatar.png";?>" class="fl" style="border-radius:100%;">
                                        <label class="fl"><?php echo $value['fullname'];?> </label>
                                        <div class="clearfix"></div>
        </li>
            <?php 
            }
            }
            foreach($list_data['data'] as $k=> $value)
                    {
                        $date = date("Y-m-d", strtotime($value['schedule_date']));
                        if(strtotime($date) > strtotime(date('Y-m-d')) or strtotime($value['schedule_date']) == "0"){
            ?>
            <li id="c<?php echo $value['id_customer'];?>" onclick="detailCustomer(<?php echo $value['id_customer'];?>);"  class="n 3" >
                                                    
                                                    <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                        <a href="#" class="jqTransformCheckbox"></a>
                                                        <input type="checkbox" value="<?php echo $value['id_customer'];?>" class="fl" style="display : none;">
                                                    </span>
                                                    
                                                    <img src="<?php echo $baseUrl; ?>/upload/customer/avatar/<?php if($value['image']!="") echo $value['image']; else echo "no_avatar.png";?>" class="fl" style="border-radius:100%;">
                                                    <label class="fl"><?php echo $value['fullname'];?> </label>
                                                    <div class="clearfix"></div>
                    </li>
            <?php 
             }
            }
         }
        else
        {   
        ?>
        <li>Không Tìm Thấy Khách Hàng !</li>
        <?php
        } 
        ?>
        