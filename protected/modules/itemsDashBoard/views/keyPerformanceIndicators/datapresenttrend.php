<script>
    <?php if($presentday['revenue'] && is_array($presentday['revenue'])) { ?>
    datarevenue = {columns: ["Revenue"], 
    data: [
    <?php
    $i = 0;
    $tagertRevenueInDay = round($tongcot1/$toal_day_in_month,2);
    foreach($presentday['revenue'] as $k => $temp){
        $i++;
        $day = substr($temp['date'],8,2);
        if($i <= $toal_day_in_month && $day == $i ){
            if($temp['present_revenue']){
                $line  = round(($temp['present_revenue']/$tagertRevenueInDay),2)*100;
                echo '["Revenue", '.$i.', '.$line.'],';
            }
        }else{
            for($i ;$i < $day; $i++){
                echo '["Revenue", '.$i.', 1],';
            }
        	if($temp['present_revenue']){
        		$line  = round(($temp['present_revenue']/$tagertRevenueInDay),2)*100;
        		echo '["Revenue", '.$i.', '.$line.'],';
        	}else{
        		echo '["Revenue", '.$i.', 1],';
        	}
        }
    }
    if($now_target && $i <= $now_target){
        $i++;
        for($j=$i;$j <= $now_target;$j++ ){
            echo '["Revenue", '.$j.', 1],';
        }
    }else{
        if(isset($toal_day_in_month) && $i < $toal_day_in_month){
            $i++;
            for($j=$i;$j <= $toal_day_in_month;$j++ ){
                echo '["Revenue", '.$j.', 1],';
            }
        }
    }
    ?>
    ]};
    <? } ?>
    
    <?php if($presentday['newaccount'] && is_array($presentday['newaccount'])) { ?>
    dataaccounts = {columns: ["Accounts"], 
    data: [
    
    <?php
    $i = 0;
    $tagertNewAccountInDay = round($tongcot2/$toal_day_in_month,2);
  
    foreach($presentday['newaccount'] as $k => $temp){
        $i++;
        $day = substr($temp['date'],8,2);
        if($i <= $toal_day_in_month && $day == $i ){
            if($temp['present_new_account']){
                $line  = round(($temp['present_new_account']/$tagertNewAccountInDay),2)*100;
                echo '["Accounts", '.$i.', '.$line.'],';
            }
        }else{
            for($i ;$i < $day; $i++){
                echo '["Accounts", '.$i.', 1],';
            }
        	if($temp['present_new_account']){
        		$line  = round(($temp['present_new_account']/$tagertNewAccountInDay),2)*100;
        		echo '["Accounts", '.$i.', '.$line.'],';
        	}else{
        		echo '["Accounts", '.$i.', 1],';
        	}
        }
    }
    if(isset($now_target) && $i <= $now_target){
        $i++;
        for($j=$i;$j <= $now_target;$j++ ){
            echo '["Accounts", '.$j.', 1],';
        }
    }else{
        if(isset($toal_day_in_month) && $i < $toal_day_in_month){
            $i++;
            for($j=$i;$j <= $toal_day_in_month;$j++ ){
                echo '["Accounts", '.$j.', 1],';
            }
        }
    }
    ?>
    ]};
    <? } ?>
    
    <?php if($presentday['callsale'] && is_array($presentday['callsale'])) { ?>
    datasalecalls = {columns: ["Salecalls"], 
    data: [
    <?php
    $i = 0;
    $tagertCallSaleInDay = round($tongcot3/$toal_day_in_month);
    foreach($presentday['callsale'] as $k => $temp){
        $i++;
        $day = substr($temp['date'],8,2);
        if($i <= $toal_day_in_month && $day == $i ){
            if($temp['present_calls']){
                $line  = round(($temp['present_calls']/$tagertCallSaleInDay),2)*100;
                echo '["Salecalls", '.$i.', '.$line.'],';
            }
        }else{
            for($i ;$i < $day; $i++){
                echo '["Salecalls", '.$i.', 1],';
            }
        	if($temp['present_calls']){
        		$line  = round(($temp['present_calls']/$tagertCallSaleInDay),2)*100;
        		echo '["Salecalls", '.$i.', '.$line.'],';
        	}else{
        		echo '["Salecalls", '.$i.', 1],';
        	}
        }
    }
    if(isset($now_target) && $i <= $now_target){
        $i++;
        for($j=$i;$j <= $now_target;$j++ ){
            echo '["Salecalls", '.$j.', 1],';
        }
    }else{
        if(isset($toal_day_in_month) && $i < $toal_day_in_month){
            $i++;
            for($j=$i;$j <= $toal_day_in_month;$j++ ){
                echo '["Salecalls", '.$j.', 1],';
            }
        }
    }
    ?>
    ]};
    <?php } ?>
</script>