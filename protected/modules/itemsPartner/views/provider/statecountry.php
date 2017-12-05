<label>State</label>
<select class="form-control" name="providerState" id="providerState">
       <?php      if(!empty($model))
        {           
               ?>       
                 <?php 
                           
                            foreach ($model as $k=>$v){ 
                        ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name_long'] ?></option>
                     <?php }

                 } else {

                      ?>
                      <option value= "0">No State</option>
                      <?php 
                 }
                 ?>
</select>