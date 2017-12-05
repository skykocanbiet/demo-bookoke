<style>
.xoay_img3{
       transform: rotate(-180deg);
-ms-transform: rotate(-180deg); /* IE 9 */
-webkit-transform: rotate(-180deg); /* Safari and Chrome */
-o-transform: rotate(-180deg); /* Opera */
-moz-transform: rotate(-180deg); /* Firefox */ 
}
</style>
<?php

$this->breadcrumbs=array(
	'Opportunities manager'=>'#',
	'Search opportunity',
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
    MyTab::getTab('createnewopportunity', 'Create new opportunity', 'opportunity/createnewopportunity');
    MyTab::getTab('searchopportunity', 'Search opportunity', 'opportunity/searchopportunity');
	MyTab::getTab('specialopportunity', 'Special opportunity', 'opportunity/specialopportunity','active');
    //MyTab::getTab('filteropportunity', 'Filter opportunity', 'opportunity/filteropportunity');
    //MyTab::getTab('reportopportunity', 'Reports opportunity', 'opportunity/reportopportunity');
    ?>

</ul>
		<div id="description" class="contentk">
			<div style="padding: 3px;background-color: #f9f3ff;" >
				<div id="id_viewcontent">
				<table bgcolor="#98aec0" cellpadding="2" cellspacing="1" width="100%"  style="border-spacing: 1px;"  >
				<tbody >
				<tr style="background-color: #bca8d2;color: #5c2b95;" class="table_title" >
					<td ><strong>No.</strong></td>
					<td ><strong>First name</strong></td>
					<td ><strong>Last name</strong></td>
					<td ><strong>Phone number</strong></td>
					<td ><strong>Scheduled date</strong></td>
					<td ><strong>Potential Rating</strong></td>
					<td ><strong>Trial Balance</strong></td>
					<td ><strong>Referred by</strong></td>
			
				</tr>
				</tbody>
				</table>
				</div>
				<div id="id_view_cusinfo" style="margin-top:40px">
					
				</div>
				<div style="clear: both;"></div>
			</div>
			<div id="id_view_cusinfo" style="margin-top:40px">
				
			</div>
			<div style="clear: both;"></div>
		</div>
    </div>

<script>
</script>
