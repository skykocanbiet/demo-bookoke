<select class="custProfileInput yellow_hover blue_focus fl" name="providerCity" id="providerCity1" onchange="savecity(<?php echo $code; ?>)">
                        
                <?php  

                if(!empty($model))

        {         

               
                                foreach ($model as $k=>$v){ 
                            ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name_long'] ?></option>
                            <?php } 
                        } else{
    
                             ?>
                     <option>don't city</option>
                      <?php 
                 }
                 ?>
                    </select>