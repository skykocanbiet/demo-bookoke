<select class="form-control" name="providerCity" id="providerCity">
                        
                <?php      if(!empty($model))
        {           
               ?>          
                            <?php 
                                foreach ($model as $k=>$v){ 
                            ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name_long'] ?></option>
                            <?php } 
                        } else{

                             ?>
                     <option>Select City</option>
                      <?php 
                 }
                 ?>
                    </select>