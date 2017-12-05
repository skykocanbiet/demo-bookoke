<script type="text/javascript">
   
    $( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var head = $('#oSrchBar').height();
   
    $('#return_content').height(windowHeight-header-head-37);
   
   
     detailreportdate(0);
});
</script>

<?php $baseUrl = Yii::app()->baseUrl;?>
<style type="text/css">
.sHeader {
    background: #e6e6e5;
    color: #5a5a5a;
    padding: 10px 15px 5px 15px;
    font-size: 18px;
    text-transform: uppercase;
}
#return_popup_content{
    padding: 25px;
}
#return_content{
    margin-top: 5px;
}
.headertable{
	background-color: #ddd;
}
.title-report{
	word-wrap: break-word;
    white-space: pre-wrap;
    padding-left: 0pt;
    padding-top: 0pt;
    padding-right: 0pt;
    padding-bottom: 0pt;
    border: 1pt none Black;
    background-color: Transparent;
    font-style: normal;
    font-family: Arial;
    font-size: 20pt;
    /*font-weight: 700;*/
    text-decoration: none;
    unicode-bidi: normal;
    color: Black;
    direction: ltr;
    layout-flow: horizontal;
    writing-mode: lr-tb;
    vertical-align: top;
    text-align: left;
}
.customer-name{
	word-wrap: break-word;
    white-space: pre-wrap;
    padding-left: 0pt;
    padding-top: 0pt;
    padding-right: 0pt;
    padding-bottom: 0pt;
    border: 1pt none Black;
    background-color: Transparent;
    font-style: normal;
    font-family: Arial;
    font-size: 15pt;
    font-weight: 700;
    text-decoration: none;
    unicode-bidi: normal;
    color: DimGray;
    direction: ltr;
    layout-flow: horizontal;
    writing-mode: lr-tb;
    vertical-align: top;
    text-align: left;
}
.id-report{
	font-family: Arial;
    font-size: 8pt;
    font-weight: 400;
    font-style: normal;
    text-decoration: underline;
    color: Blue;
}
.total-customer{
	word-wrap: break-word;
    white-space: pre-wrap;
    font-style: normal;
    font-family: Arial;
    font-size: 8pt;
    font-weight: 700;
    text-decoration: none;
    unicode-bidi: normal;
    color: Black;
    direction: ltr;
    layout-flow: horizontal;
    writing-mode: lr-tb;
    vertical-align: top;
    text-align: left;
}
#return_content .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{ padding: 3px;vertical-align: bottom; }
.text-align-center{
	text-align: center;
}
.sort-field td{
	font-size: 11px;
}
.border-left{
	border-left: 2px solid #ddd;
}
.border-right{
	border-right: 2px solid #ddd;
}
.ss{
    overflow-y: auto;
    height: 200px;
}
</style>
<div id="oSrchBar" class="col-md-12">
    <?php include_once('_frmSearch_date.php') ?>
</div>
<div class="col-md-12 margin-top-20 ss" id="return_content">
	<p class="title-report tt">Customer List</p>
	<!-- <p class="customer-name">Nguyen Huu Hanh</p> -->
	<p>Customers added between Sat, 7 Jan 2017 to Mon, 6 Feb 2017</p>
	<div class="table table-responsive">
	  <table class="table table-hover">
	  	<thead class="headertable">
	  		<tr>
	  			<th>Id</th>
	  			<th>Added</th>
	  			<th>First</th>
	  			<th>Last</th>
	  			<th>Company</th>
	  			<th>Email</th>
	  			<th>Tel</th>
	  			<th>Mobile</th>
	  			<th>Address1</th>
	  			<th>Address2</th>
	  			<th>Suburb</th>
	  			<th>City</th>
	  			<th>State</th>
	  			<th>Postcode</th>
	  			<th>DoB</th>
	  			<th class="text-align-center">VIP</th>
	  			<th class="text-align-center">Appts</th>
	  			<th>Last Appt</th>	
	  			<th>Sex</th>
	  			<th>Job</th>
	  			<th>Refer</th>  			
	  		</tr>
	  	</thead>
	  	<tbody>	  		
	  		<tr>
	  			<td colspan="21"><div class="total-customer">Total customers: 0</div></td>
	  		</tr>
	  	</tbody>
	  </table>
	</div>
</div>