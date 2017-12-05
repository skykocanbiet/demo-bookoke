 <!-- <select class="form-control" name="DealsProduct" id="DealsProduct">
 
 <?php  

                if(!empty($model))

        {         ?>
            <option value="">Select product</option>
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
                                 
                                        </script>
                                        <select id="DealsProduct" name="DealsProduct[]" class="form-control product DealsProduct " onchange="productsdeal(this)">
                                           <option value="0">select Product</option>
                                            <?php 
                                            foreach ($model as $k=>$v){ 
                                            ?>
                                            <option value="<?php echo $v['id'] ?>">
                                                    <?php echo $v['name'] ?>
                                                
                                            </option>
                                            <?php 
                                                }  
                                             ?>
                                        </select>
                                    </div>