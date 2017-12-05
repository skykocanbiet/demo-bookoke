 <!-- <select class="form-control" name="DealsService" id="DealsService">
 
 <?php  

                if(!empty($model))

        {         ?>
                <option value="">select service</option>
               <?php 
                                foreach ($model as $k=>$v){ 
                            ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                            <?php } 
                        } else{
    
                             ?>
                     <option>don't product</option>
                      <?php 
                 }
                 ?>
</select> -->
<style type="text/css">
    .example{
        position: absolute;
    }
</style>
                                    
    <select id="DealsService"  name="DealsService[]" class="form-control DealsService" onchange="servicedeal(this)"  >
        <option>select service</option>
        <?php 
            foreach ($model as $k=>$v){ 
        ?>
            <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
        <?php } ?>                                              
    </select>
                                    
                                   