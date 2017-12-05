<?php

$this->breadcrumbs=array(
	'Opportunities manager'=>'#',
	'Filter opportunity',
);


?>
<?php if(isset($this->breadcrumbs))?>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	))?><!-- breadcrumbs -->
    <div id="content" style="padding-right: 0;">
<ul id="menuk" class="menuk">
<?php
    include_once(Yii::app()->theme->basePath.'/views/layouts/tab.php');
    MyTab::getTab('searchopportunity', 'Search opportunity', 'opportunity/searchopportunity');
    MyTab::getTab('filteropportunity', 'Filter opportunity', 'opportunity/filteropportunity','active');
    MyTab::getTab('reportopportunity', 'Reports opportunity', 'opportunity/reportopportunity');
    ?>

</ul>
		<div id="description" class="contentk">
			<div class="bg_popup"  style="background-color: #f9f3ff;padding: 5px;" >
               
                
                
                <div style="margin-top:30px;" id="id_view_callingcardrates">


                </div>

            </div>
        </div>
        </div>
