<style>
.icon_out_of_date{
    color: red;
}
.icon_to_date{
    color: green;
}
.icon_furture_date{
    color: rgba(128, 128, 128, 0.45);
}
.icon_planned{
    color: green;
}
.icon_not_planned{
    color: yellow;
}
.bg_icon_not_planned{
    display: inline-block;
    width: 4px;
    height: 10px;
    position: absolute;
    top: 46%;
    right: 11px;
    background-color: #000;
    z-index: 1;
}
.value{
    min-width: 30px;
/*    display: inline-block;*/
    text-align: center;
    margin-right: 0px !important;
}
.add_schedule_activity{
    cursor: pointer;
    color: #3498db;
    padding: 9px 14px; 
    background-color: #f7f7f7;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}
.popover-title{
    padding: 4px 14px;
    text-align: center;
}
.DealActivity li.active_planned{
    cursor: pointer;
    border-bottom:1px solid #e0e4e7;
}
.DealActivity li.active_planned:hover{
   background-color: #3498db !important; 
   color: #fff;
} 
.DealActivity li.active_planned:hover .title{
   color: #fff;
} 
.DealActivity li.active_planned:hover .activity_overdue{
   color: #fff;
}
.DealActivity li.active_planned:hover .activity_planned_doday{
   color: #fff;
}
.DealActivity li.active_planned:hover .activity_planned{
   color: #fff;
}
.activity_overdue{
    color: #e84646;
    font-size: 12px;
}
.activity_planned_doday{
    color: #43c35e;
    font-size: 12px;
}
.activity_planned{
   color: #888e94;
   font-size: 12px;
}
.icon_change_meeting{
    font-size: 20px;
    margin-left: 5px;
}
</style>
<?php 
$baseUrl = Yii::app()->baseUrl;
$today = strtotime(date("Y-m-d H:i:s")); 
$icon_type_schedule = array('1'=>'fa-phone','2'=>'fa-users icon_change_meeting','3'=>'fa-clock-o','4'=>'fa-flag','5'=>'fa-envelope','6'=>'fa-coffee');
$exchange_rate = 22000;
?>
<table>
    <tbody>
        <tr id="tr" height="44">
    		<td style="padding: 0px;">
    			<div class="stages ready" style="padding-right:17px;background-color:rgb(115, 149, 158);">
    				<ul style="">
    					<li data-stage-id="1">
    						<div class="goalsWrapper" style="width: 147px; display: none;">
    							<div class="goals">
    								<div class="goalChart"></div>
    								<div class="goalSummary" style="width: 137px;">
    									<div class="chart"></div>
    									<span class="title">Results for Lead In</span>
    									<table class="stats"></table>
    									<span class="smallTitle"></span>
    									<table class="todo"></table>
    								</div>
    							</div>
    						</div>
    						<span class="stagename">Tiếp nhận thông tin</span>
                            <?php if(isset($stage['1']) && $stage['1']['number'] > 0){ ?>
                            <span class="stagevalue">
                                <span class="value">

                                    <span style="float:left;"><?php echo $stage['1']['number']; echo ' '; if($stage['1']['number']>1) echo "cơ hội"; else echo "cơ hội";?></span>
                     
                                    <span style="margin-right: 5px;float:right;"><?php echo number_format($stage['1']['value'],0,",",".")." VND"; ?></span>
                    
                                </span>
                            </span>
                            <?php } ?>
    					</li>
    					<li data-stage-id="2">
    						<div class="goalsWrapper" style="width: 148px; display: none;">
    							<div class="goals">
    								<div class="goalChart"></div>
    								<div class="goalSummary" style="width: 138px;">
    									<div class="chart"></div>
    									<span class="title">Results for Contact Made</span>
    									<table class="stats"></table>
    									<span class="smallTitle"></span>
    									<table class="todo"></table>
    								</div>
    							</div>
    						</div>
    						<span class="stagename">Liên hệ khách hàng</span>
                            <?php if(isset($stage['2']) && $stage['2']['number'] > 0){ ?>
                                <span class="stagevalue">
                                    <span class="value">

                                        <span style="float:left;"><?php echo $stage['2']['number']; echo ' '; if($stage['2']['number']>1) echo "cơ hội"; else echo "cơ hội";?></span>
                                  
                                        <span style="margin-right: 5px;float:right;"><?php echo number_format($stage['2']['value'],0,",",".")." VND"; ?></span>
                              
                                    </span>
                                </span>
                            <?php } ?>
    					</li>
    					<li data-stage-id="3">
    						<div class="goalsWrapper" style="width: 148px; display: none;">
    							<div class="goals">
    								<div class="goalChart"></div>
    								<div class="goalSummary" style="width: 138px;">
    									<div class="chart"></div>
    									<span class="title">Results for Needs Defined</span>
    									<table class="stats"></table>
    									<span class="smallTitle"></span>
    									<table class="todo"></table>
    								</div>
    							</div>
    						</div>
    						<span class="stagename">Làm rõ nhu cầu</span>
                            <?php if(isset($stage['3']) && $stage['3']['number'] > 0){ ?>
                                <span class="stagevalue">
                                    <span class="value">

                                        <span style="float:left;"><?php echo $stage['3']['number']; echo ' '; if($stage['3']['number']>1) echo "cơ hội"; else echo "cơ hội";?></span>
                      
                                        <span style="margin-right: 5px;float:right;"><?php echo number_format($stage['3']['value'],0,",",".")." VND"; ?></span>
                                 
                                    </span>
                                </span>
                            <?php } ?>
    					</li>
    					<li data-stage-id="4">
    						<div class="goalsWrapper" style="width: 148px; display: none;">
    							<div class="goals">
    								<div class="goalChart"></div>
    								<div class="goalSummary" style="width: 138px;">
    									<div class="chart"></div>
    									<span class="title">Results for Proposal Made</span>
    									<table class="stats"></table>
    									<span class="smallTitle"></span>
    									<table class="todo"></table>
    								</div>
    							</div>
    						</div>
    						<span class="stagename">Đề xuất kế hoạch</span>
    					    <?php if(isset($stage['4']) && $stage['4']['number'] > 0){ ?>
                                <span class="stagevalue">
                                    <span class="value">

                                        <span style="float:left;"><?php echo $stage['4']['number']; echo ' '; if($stage['4']['number']>1) echo "cơ hội"; else echo "cơ hội";?></span>
                             
                                        <span style="margin-right: 5px;float:right;"><?php echo number_format($stage['4']['value'],0,",",".")." VND"; ?></span>
                                 
                                    </span>
                                </span>
                            <?php } ?>
                        </li>
    					<li data-stage-id="5">
    						<div class="goalsWrapper" style="width: 149px; display: none;">
    							<div class="goals">
    								<div class="goalChart"></div>
    								<div class="goalSummary" style="width: 139px;">
    									<div class="chart"></div>
    									<span class="title">Results for Negotiations Started</span>
    									<table class="stats"></table>
    									<span class="smallTitle"></span>
    									<table class="todo"></table>
    								</div>
    							</div>
    						</div>
    						<span class="stagename">Đang thương lượng</span>
                            <?php if(isset($stage['5']) && $stage['5']['number'] > 0){ ?>
                                <span class="stagevalue">
                                    <span class="value">

                                        <span style="float:left;"><?php echo $stage['5']['number']; echo ' '; if($stage['5']['number']>1) echo "cơ hội"; else echo "cơ hội";?></span>

                                        <span style="margin-right: 5px;float:right;"><?php echo number_format($stage['5']['value'],0,",",".")." VND"; ?></span>                                        
                                    
                                    </span>
                                </span>
                            <?php } ?>
    					</li>
    				</ul>
    			</div>
    		</td>
    	</tr>
        <tr>
            <td style="height: 100%; display: inline-block; width:100%; margin: 0; padding: 0;">
                <div class="deals hasScrollbar ready">
                    <div class="dealsTable">
                    <?php                     
                    if($data['data'])
                    { 
                    ?>
                        <!-- Lead In -->
                        <div class="stage" data-stage-id="1" ondragenter="return dragEnter(event)" ondragend="return dragEnd(event)" ondragleave="return dragLeave(event)" ondrop="return dragDrop(event)" ondragover="return dragOver(event)">
                            <ul class="ul">
                                <?php
                                    foreach($data['data'] as $key => $temp )
                                    { 
                                        if($temp['stage'] == 1){
                                        ?>
                                        <li id="deal<?php echo $temp['id']; ?>" class="warning status-open" draggable="true" ondragstart="return dragStart(event)" style="display: list-item;">
                                            
                                            <div class="block">
                                            	<a class="front" href="" draggable="false">
                                            		<span class="icon_opp_user"><img src="<?php echo $baseUrl; ?>/upload/customer/no_avatar.png" style="border-radius:100%;"></span>
                                                    <span class="name_deal"><?php echo $temp['contact_person_name'];?></span>
                                                    <small>
                                                        <span class="detail value"><?php if($temp['currency']=="VND") echo number_format($temp['deal_value'],0,",",".")." VND"; else echo $model->money_format('%#10n',$temp['deal_value']/$exchange_rate); ?></span> 
                                                        <span class="detail org"><?php echo $temp['title'];?></span>
                                                    </small>
                                            	</a>
                                            </div>
                                            <div id="schedule_an_activity<?php echo $temp['id'];?>" class="labels">
                                            	<?php include('view_schedule_an_activity.php')  ?>
                                            </div>
                                            
                                        </li>
                                <?php } }  ?>
                            </ul>
                        </div>
                        <!-- Contact Made -->
                        <div class="stage" data-stage-id="2" ondragenter="return dragEnter(event)" ondragend="return dragEnd(event)" ondragleave="return dragLeave(event)" ondrop="return dragDrop(event)" ondragover="return dragOver(event)">
                            <ul class="ul">
                                <?php 
                                foreach( $data['data'] as $key => $temp )
                                { 
                                    if($temp['stage'] == 2){
                                    ?>
                                <li id="deal<?php echo $temp['id']; ?>" class="warning status-open" draggable="true" ondragstart="return dragStart(event)" style="display: list-item;">
                                    
                                    <div class="block">
                                    	<a class="front" href="" draggable="false">
                                    		<span class="icon_opp_user"><img src="<?php echo $baseUrl; ?>/upload/customer/no_avatar.png" style="border-radius:100%;"></span>
                                            <span class="name_deal"><?php echo $temp['contact_person_name'];?></span>
                                            <small>
                                                <span class="detail value"><?php if($temp['currency']=="VND") echo number_format($temp['deal_value'],0,",",".")." VND"; else echo $model->money_format('%#10n',$temp['deal_value']/$exchange_rate); ?></span> 
                                                <span class="detail org"><?php echo $temp['title'];?></span>
                                            </small>
                                    	</a>
                                    </div>
                                    <div id="schedule_an_activity<?php echo $temp['id'];?>" class="labels">
                                    	<?php include('view_schedule_an_activity.php')  ?>
                                    </div>
                                </li>
                                <?php } } ?>
                            </ul>
                        </div>
                        
                        <!-- Needs Defined -->
                        <div class="stage" data-stage-id="3" ondragenter="return dragEnter(event)" ondragend="return dragEnd(event)" ondragleave="return dragLeave(event)" ondrop="return dragDrop(event)" ondragover="return dragOver(event)">
                            <ul class="ul">
                                <?php 
                                foreach( $data['data'] as $key => $temp )
                                {
                                    if($temp['stage'] == 3){
                                    ?>
                                <li id="deal<?php echo $temp['id']; ?>" class="warning status-open" draggable="true" ondragstart="return dragStart(event)" style="display: list-item;">
                                    
                                    <div class="block">
                                    	<a class="front" href="" draggable="false">
                                    		<span class="icon_opp_user"><img src="<?php echo $baseUrl; ?>/upload/customer/no_avatar.png" style="border-radius:100%;"></span>
                                            <span class="name_deal"><?php echo $temp['contact_person_name'];?></span>
                                            <small>
                                                <span class="detail value"><?php if($temp['currency']=="VND") echo number_format($temp['deal_value'],0,",",".")." VND"; else echo $model->money_format('%#10n',$temp['deal_value']/$exchange_rate); ?></span> 
                                                <span class="detail org"><?php echo $temp['title'];?></span>
                                            </small>
                                    	</a>
                                    </div>
                                    <div id="schedule_an_activity<?php echo $temp['id'];?>" class="labels">
                                        <?php include('view_schedule_an_activity.php')  ?>
                                    </div>
                                    
                                </li>
                                <?php } } ?>
                            </ul>
                        </div>
                        
                        <!-- Proposal Made -->
                        <div class="stage" data-stage-id="4" ondragenter="return dragEnter(event)" ondragend="return dragEnd(event)" ondragleave="return dragLeave(event)" ondrop="return dragDrop(event)" ondragover="return dragOver(event)">
                            <ul class="ul">
                               <?php 
                               foreach( $data['data'] as $key => $temp )
                               {
                                    if($temp['stage'] == 4){                
                                    ?>
                                <li id="deal<?php echo $temp['id']; ?>" class="warning status-open" draggable="true" ondragstart="return dragStart(event)" style="display: list-item;">
                                    
                                    <div class="block">
                                    	<a class="front" href="" draggable="false">
                                    		<span class="icon_opp_user"><img src="<?php echo $baseUrl; ?>/upload/customer/no_avatar.png" style="border-radius:100%;"></span>
                                            <span class="name_deal"><?php echo $temp['contact_person_name'];?></span>
                                            <small>
                                                <span class="detail value"><?php if($temp['currency']=="VND") echo number_format($temp['deal_value'],0,",",".")." VND"; else echo $model->money_format('%#10n',$temp['deal_value']/$exchange_rate); ?></span> 
                                                <span class="detail org"><?php echo $temp['title'];?></span>
                                            </small>
                                    	</a>
                                    </div>
                                    <div id="schedule_an_activity<?php echo $temp['id'];?>" class="labels">
                                    	<?php include('view_schedule_an_activity.php')  ?>
                                    </div>
                                </li>
                                <?php } } ?>
                            </ul>
                        </div>
                        
                        <!-- Negotiations Started -->
                        <div class="stage" data-stage-id="5" ondragenter="return dragEnter(event)" ondragend="return dragEnd(event)" ondragleave="return dragLeave(event)" ondrop="return dragDrop(event)" ondragover="return dragOver(event)" style="border-right:none">
                            <ul class="ul">
                                <?php 
                                foreach( $data['data'] as $key => $temp )
                                {   
                                    if($temp['stage'] == 5){                                                                 
                                    ?>
                                <li id="deal<?php echo $temp['id']; ?>" class="warning status-open" draggable="true" ondragstart="return dragStart(event)" style="display: list-item;">
                                    
                                    <div class="block">
                                    	<a class="front" href="" draggable="false">
                                    		<span class="icon_opp_user"><img src="<?php echo $baseUrl; ?>/upload/customer/no_avatar.png" style="border-radius:100%;"></span>
                                            <span class="name_deal"><?php echo $temp['contact_person_name'];?></span>
                                            <small>
                                                <span class="detail value"><?php if($temp['currency']=="VND") echo number_format($temp['deal_value'],0,",",".")." VND"; else echo $model->money_format('%#10n',$temp['deal_value']/$exchange_rate); ?></span> 
                                                <span class="detail org"><?php echo $temp['title'];?></span>
                                            </small>
                                    	</a>
                                    </div>
                                    <div id="schedule_an_activity<?php echo $temp['id'];?>" class="labels">
                                    	<?php include('view_schedule_an_activity.php')  ?>
                                    </div>
                                    
                                </li>
                                <?php } } ?>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<script>
$(function(){
    $("[data-toggle=popover]").popover({
        html : true,
        content: function() {
          var content = $(this).attr("data-popover-content");
          return $(content).children(".popover-body").html();
        },
        title: function() {
          var title = $(this).attr("data-popover-content");
          return $(title).children(".popover-heading").html();
        }
    });
});
$('body').on('mouseup', function (e){
    $('[data-toggle="popover"]').each(function (){
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});
$(window).resize(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var oSrchBar     = $("#oSrchBar").height();
    var tr           = $("#tr").height();

    $('.hasScrollbar').height(windowHeight-header-oSrchBar-tr-80);

});
$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();  
    var oSrchBar     = $("#oSrchBar").height();
    var tr           = $("#tr").height();

    $('.hasScrollbar').height(windowHeight-header-oSrchBar-tr-80);

});
</script>