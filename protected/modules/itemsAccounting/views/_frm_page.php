<style type="text/css">
   #box_page  i{
    font-size: 17px;
    margin-left: 5px;
    border: none;
    padding: 5px 10px;
    background: rgba(198, 197, 197, 0.27);

   }
</style>
<div id="box_page" style="color:#19427f">
    <div style="margin-top:3px;float:left">
    </div>
     <div style="margin-top:5px;float:right;">
            <!-- LEFT SEARCH -->
            <span class="icon_page" style="top:2px;position: relative;">
            <?php
                if($cur_page==1)
                {
                    ?>
                     <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                    <?php
                }
                else{
                    ?>
                     <a style="text-decoration: none; cursor: pointer;" onclick="search_cus('1')" >
                         <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                    </a>
                    <?php
                }

                $previous=$cur_page - 1;

                if($previous > 0 )
                {
                    ?>
                    <a style="text-decoration: none; cursor: pointer;" onclick="search_cus('<?php echo $previous?>')" >
                        
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                    </a>
                    <?php
                }
                else{
                    ?><i class="fa fa-angle-left" aria-hidden="true"></i>
                    <?php
                }

            ?>


            </span>

            <!-- INPUT SEARCH -->
            <span style="margin: 0px 10px;">
                <input type="text" value="<?php echo $cur_page?>" size="1" id="id_text_page" name="id_text_page" style="color:#0050c9;text-align: center;border: none;line-height: 25px;" onkeypress="runScript(event)" /> <span style="color: #333;">of <?php echo  $num_page?></span>
            </span>

            <!-- RIGHT NEXT -->
            <span style="top:2px;position: relative;">
                <?php $next=$cur_page + 1;
                    if($next <= $num_page )
                    {
                        ?>
                        <a class="icon_page"> style="text-decoration: none; cursor: pointer;" onclick="search_cus('<?php echo $next?>')" >
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                        <?php
                    }
                    else{
                        ?>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        <?php
                    }
                    if($cur_page==$num_page)
                    {
                        ?>
                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        <?php
                    }
                    else{
                        ?>
                         <a class="icon_page"> style="text-decoration: none; cursor: pointer;" onclick="search_cus('<?php echo $num_page?>')" >
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </a>
                        <?php
                    }
                ?>
            </span>
     </div>
</div>