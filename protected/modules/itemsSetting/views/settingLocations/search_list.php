 <?php $baseUrl = Yii::app()->baseUrl;?>

                                       
        <?php  
        if(!empty($list_data['data']))
        {               
        foreach($list_data['data'] as $k=> $value)
        {
        ?>
        <li id="c<?php echo $value['id'];?>" onclick="detailBranch(<?php echo $value['id'];?>);"  class="n" >
                                        
            <span class="jqTransformCheckboxWrapper" style="display:none;">
                <a href="#" class="jqTransformCheckbox"></a>
                <input type="checkbox" value="<?php echo $value['id'];?>" class="fl" style="display : none;">
            </span>
            
           
            <label class="fl"> <?php echo $value['name'];?> </label>
            <div class="clearfix"></div>
        </li>
        <?php
        }
        }
        else
        {   
        ?>
        <li>Không Tìm Thấy Chi Nhánh!!!</li>
        <?php
        } 
        ?>




