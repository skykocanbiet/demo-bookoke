<select class="custProfileInput yellow_hover blue_focus fl" name="providerState" id="providerState1" onchange="savestate(<?php echo $code; ?>)">
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