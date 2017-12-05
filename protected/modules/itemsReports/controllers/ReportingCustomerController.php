<?php

class ReportingCustomerController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='/layouts/main_sup';

	/**
	* @return array action filters
	*/
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return parent::accessRules();
	}

	public function actionView()
	{
		$model = new Branch();
		$this->render('view',array("model"=>$model));
	}

	public function actionDate()
	{
		$model = new Branch();
		$this->render('date',array("model"=>$model));
	}

	public function actionBirthday()
	{
		$model = new Branch();
		$this->render('birthday',array("model"=>$model));
	}

	public function actionService()
	{
		$model = new Branch();
		$this->render('service',array("model"=>$model));
	}

	public function actionNote()
	{
		$model = new Branch();
		$this->render('note',array("model"=>$model));
	}

	public function actionSpend()
	{
		$model = new Branch();
		$this->render('spend',array("model"=>$model));
	}
	public function actionDetailReport()
	{	

		$model = new Customer;
		$time = $_POST['time'];
		$id_user = $_POST['id_user'];
		$location = $_POST['location'];
		$date = $_POST['date'];
		if($time == 0)
		{
			$date1 = explode('+', $date);
			$fromdate=date("d-m-Y", strtotime($date1[0]));
			$todate=date("d-m-Y", strtotime($date1[1]));
			
		}
		elseif ($time==1) // ngày hiện tại
		{
			$fromdate = date("d-m-Y");
			$todate= "";
			
		}
		elseif($time==2) // Tuần hiện tại
		{	
			$fromdate = date("d-m-Y",strtotime('monday this week'));
			$todate= date("d-m-Y",strtotime('sunday this week'));
			

		}
		elseif($time==3) //  tháng hiện tại
		{
		    $fromdate = date("01-m-Y", strtotime("first day of this month"));
		    $todate= date("t-m-Y", strtotime("last day of this month"));
		   
		}
		elseif($time==5) // tháng trước
		{
			$fromdate = date("d-m-Y", strtotime('first day of last month'));
    		$todate= date("d-m-Y", strtotime('last day of last month'));
    		
		}
		
		if($location != ""){
			$data = Branch::model()->findAll($location);
			$data =  $data[0]->name;
		}else {
			$data = "tất cả văn phòng";
		}
		if($id_user != ""){
			$nhanvien =  GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3, 'id'=>$id_user));
			$nhanvien =  $nhanvien[0]->name;
		}else {
			$nhanvien = "tất cả văn phòng";
		}
		$cs = $model->getselect($time, $id_user, $location, $date);
		$count = count($cs);
		$this->renderPartial('detail_report_customer',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien),false,true);
	}
	public function actionPrintreport()
	{
		$model = new Customer;
		$type = $_GET['type'];
		$time = $_GET['time']?$_GET['time']:false;
		$id_user = $_GET['id_user']?$_GET['id_user']:false;
		$location = $_GET['location']?$_GET['location']:false;

		$service = $_GET['service']?$_GET['service']:false;
		$group = $_GET['group']?$_GET['group']:false;
		$date_start = $_GET['date_start'];
		$date_end = $_GET['date_end'];
		$filename = 'test.pdf';
		$html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 3);
		if($time == 0)
		{

			/*$date1 = explode('+', $date);
			$fromdate=date("d-m-Y", strtotime($date1[0]));
			$todate=date("d-m-Y", strtotime($date1[1]));*/
			
		
			$fromdate =$date_start;
			$todate= $date_end;
			
		}
		elseif ($time==1) // ngày hiện tại
		{
			
			$fromdate = date("d-m-Y");
			$todate= "";
		}
		elseif($time==2) // Tuần hiện tại
		{	
			$fromdate = date("d-m-Y",strtotime('monday this week'));
			$todate= date("d-m-Y",strtotime('sunday this week'));
			

		}
		elseif($time==3) //  tháng hiện tại
		{
		    $fromdate = date("01-m-Y", strtotime("first day of this month"));
		    $todate= date("t-m-Y", strtotime("last day of this month"));
		   
		}
		elseif($time==5) // tháng trước
		{
			$fromdate = date("d-m-Y", strtotime('first day of last month'));
    		$todate= date("d-m-Y", strtotime('last day of last month'));
    		
		}
		if($location != ""){
			$data = Branch::model()->findAll($location);
			$data =  $data[0]->name;
		}else {
			$data = "tất cả văn phòng";
		}
		if($id_user != ""){
			$nhanvien =  GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3, 'id'=>$id_user));
			$nhanvien =  $nhanvien[0]->name;
		}else {
			$nhanvien = "tất cả văn phòng";
		}

		if ($type == 0) {
			$total = "DANH SÁCH KHÁCH HÀNG";
			$cs = Customer::model()->getselectprint($time, $id_user, $location, $date_start, $date_end);
			$count = count($cs);
			$html2pdf->WriteHTML($this->renderPartial('print_customer',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien, 'total'=>$total),true));
		}
		if($type == 1){
			$total = "DANH SÁCH KHÁCH HÀNG";
			$cs = Customer::model()->getselectprint($time, $id_user, $location, $date_start, $date_end);
			$count = count($cs);
			$html2pdf->WriteHTML($this->renderPartial('print_customer',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien, 'total'=>$total),true));
		}
		if($type == 2){
			$total = "DANH SÁCH SINH NHẬT KHÁCH HÀNG";
			$cs = $model->getselectbirthdateprint($time, $id_user, $location, $date_start, $date_end);
			$count = count($cs);
			$html2pdf->WriteHTML($this->renderPartial('print_customer',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien, 'total'=>$total),true));
		}
		if($type == 3){
			$total = "DANH SÁCH CHI TIÊU KHÁCH HÀNG";
			$cs = $model-> getselectprintspend($time, $id_user, $location, $date_start, $date_end);
			$count = count($cs);
			$html2pdf->WriteHTML($this->renderPartial('print_customer_spend',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien, 'total'=>$total),true));
		}
		if($type == 4){
			$total = "DANH SÁCH  KHÁCH HÀNG";
			
			$cs = $model-> getprintservice($time, $id_user, $location,$service,$group,$date_start, $date_end);
			$count = count($cs);
			$html2pdf->WriteHTML($this->renderPartial('print_customer_service',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien, 'total'=>$total),true));
		}
		if($type == 6){
			$total = "DANH SÁCH GHI CHÚ KHÁCH HÀNG";
			$cs = $model-> getPrintNote($time, $id_user, $location, $date_start, $date_end);
			$count = count($cs);
			$html2pdf->WriteHTML($this->renderPartial('print_note',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien, 'total'=>$total),true));
		}
		

		 $html2pdf->Output($filename, 'I');
	}
	/*export*/
	public function actionExportreport()
	{
		$model = new Customer;
		$type = $_GET['type'];
		$time = $_GET['time']?$_GET['time']:false;
		$id_user = $_GET['id_user']?$_GET['id_user']:false;
		$location = $_GET['location']?$_GET['location']:false;
		$date_start = $_GET['date_start'];
		$date_end = $_GET['date_end'];
		$filename = 'test.pdf';
		$html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 3);
		if($time == 0)
		{
			$fromdate =$date_start;
			$todate= $date_end;
			
		}
		elseif ($time==1) // ngày hiện tại
		{
			
			$fromdate = date("d-m-Y");
			$todate= "";
		}
		elseif($time==2) // Tuần hiện tại
		{	
			$fromdate = date("d-m-Y",strtotime('monday this week'));
			$todate= date("d-m-Y",strtotime('sunday this week'));
			

		}
		elseif($time==3) //  tháng hiện tại
		{
		    $fromdate = date("01-m-Y", strtotime("first day of this month"));
		    $todate= date("t-m-Y", strtotime("last day of this month"));
		   
		}
		elseif($time==5) // tháng trước
		{
			$fromdate = date("d-m-Y", strtotime('first day of last month'));
    		$todate= date("d-m-Y", strtotime('last day of last month'));
    		
		}
		if($location != ""){
			$data = Branch::model()->findAll($location);
			$data =  $data[0]->name;
		}else {
			$data = "tất cả văn phòng";
		}
		if($id_user != ""){
			$nhanvien =  GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3, 'id'=>$id_user));
			$nhanvien =  $nhanvien[0]->name;
		}else {
			$nhanvien = "tất cả văn phòng";
		}

		if ($type == 0) {
			$total = "DANH SÁCH KHÁCH HÀNG";
			$cs = Customer::model()->getselectprint($time, $id_user, $location, $date_start, $date_end);
			$count = count($cs);
			$html2pdf->WriteHTML($this->renderPartial('print_customer',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien, 'total'=>$total),true));
		}
		if($type == 1){
			$total = "DANH SÁCH KHÁCH HÀNG";
			$cs = Customer::model()->getselectprint($time, $id_user, $location, $date_start, $date_end);
			$count = count($cs);
			$html2pdf->WriteHTML($this->renderPartial('print_customer',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien, 'total'=>$total),true));
		}
		if($type == 2){
			$total = "DANH SÁCH SINH NHẬT KHÁCH HÀNG";
			$cs = $model->getselectbirthdateprint($time, $id_user, $location, $date_start, $date_end);
			$count = count($cs);
			$html2pdf->WriteHTML($this->renderPartial('print_customer',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien, 'total'=>$total),true));
		}
		if($type == 3){
			$total = "DANH SÁCH CHI TIÊU KHÁCH HÀNG";
			$cs = $model-> getselectprint($time, $id_user, $location, $date_start, $date_end);
			$count = count($cs);
			$html2pdf->WriteHTML($this->renderPartial('print_customer_spend',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien, 'total'=>$total),true));
		}
		if($type == 4){
			$total = "DANH SÁCH KHÁCH HÀNG";
			$cs = $model-> getselectservice($time, $id_user, $location, $date_start, $date_end);
			$count = count($cs);
			$html2pdf->WriteHTML($this->renderPartial('print_customer_service',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien, 'total'=>$total),true));
		}
		

		 $html2pdf->Output($filename, 'D');
	}
		/*------------------------------------------------------------------------------------------------------------------------------------------*/
	public function actionDetailReportDate()
	{	

		$model = new Customer;
		$time = $_POST['time'];
		$id_user = $_POST['id_user'];
		$location = $_POST['location'];
		$date = $_POST['date'];

		if($time == 0)
		{
			$date1 = explode('+', $date);
			$fromdate=date("d-m-Y", strtotime($date1[0]));
			$todate=date("d-m-Y", strtotime($date1[1]));
			
		}
		elseif ($time==1) // ngày hiện tại
		{
			$fromdate = date("d-m-Y");
			$todate= "";
			
		}
		elseif($time==2) // Tuần hiện tại
		{	
			$fromdate = date("d-m-Y",strtotime('monday this week'));
			$todate= date("d-m-Y",strtotime('sunday this week'));
			

		}
		elseif($time==3) //  tháng hiện tại
		{
		    $fromdate = date("01-m-Y", strtotime("first day of this month"));
		    $todate= date("t-m-Y", strtotime("last day of this month"));
		   
		}
		elseif($time==5) // tháng trước
		{
			$fromdate = date("d-m-Y", strtotime('first day of last month'));
    		$todate= date("d-m-Y", strtotime('last day of last month'));
    		
		}
		if($location != ""){
			$data = Branch::model()->findAll($location);
			$data =  $data[0]->name;
		}else {
			$data = "tất cả văn phòng";
		}
		if($id_user != ""){
			$nhanvien =  GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3, 'id'=>$id_user));
			$nhanvien =  $nhanvien[0]->name;
		}else {
			$nhanvien = "tất cả văn phòng";
		}
		$cs = $model->getselect($time, $id_user, $location, $date);
		$count = count($cs);
		$this->renderPartial('detail_report_customer_date',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien),false,true);
	}
	/*birthdate*/	
	public function actionDetailReportbirthdate()
	{	

		$model = new Customer;
		$time = $_POST['time'];
		$id_user = $_POST['id_user'];
		$location = $_POST['location'];
		$date = $_POST['date'];

		if($time == 0)
		{
			$date1 = explode('+', $date);
			$fromdate=date("d-m-Y", strtotime($date1[0]));
			$todate=date("d-m-Y", strtotime($date1[1]));
			
		}
		elseif ($time==1) // ngày hiện tại
		{
			$fromdate = date("d-m-Y");
			$todate= "";
			
		}
		elseif($time==2) // Tuần hiện tại
		{	
			$fromdate = date("d-m-Y",strtotime('monday this week'));
			$todate= date("d-m-Y",strtotime('sunday this week'));
			

		}
		elseif($time==3) //  tháng hiện tại
		{
		    $fromdate = date("01-m-Y", strtotime("first day of this month"));
		    $todate= date("t-m-Y", strtotime("last day of this month"));
		   
		}
		elseif($time==4) // tháng trước
		{
			$fromdate = date("d-m-Y", strtotime('first day of next month'));
    		$todate= date("d-m-Y", strtotime('last day of next month'));
    		
		}
		elseif($time==5) // tháng trước
		{
			$fromdate = date("d-m-Y", strtotime('first day of last month'));
    		$todate= date("d-m-Y", strtotime('last day of last month'));
    		
		}
		if($location != ""){
			$data = Branch::model()->findAll($location);
			$data =  $data[0]->name;
		}else {
			$data = "tất cả văn phòng";
		}
		if($id_user != ""){
			$nhanvien =  GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3, 'id'=>$id_user));
			$nhanvien =  $nhanvien[0]->name;
		}else {
			$nhanvien = "tất cả văn phòng";
		}
		$cs = $model->getselectbirthdate($time, $id_user, $location, $date);
		$count = count($cs);
		$this->renderPartial('detail_report_customer_birthdate',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien),false,true);
	}
	public function actionDetailReportspend()
	{	

		$model = new Customer;
		$time = $_POST['time'];
		$id_user = $_POST['id_user'];
		$location = $_POST['location'];
		$date = $_POST['date'];

		if($time == 0)
		{
			$date1 = explode('+', $date);
			$fromdate=date("d-m-Y", strtotime($date1[0]));
			$todate=date("d-m-Y", strtotime($date1[1]));
			
		}
		elseif ($time==1) // ngày hiện tại
		{
			$fromdate = date("d-m-Y");
			$todate= "";
			
		}
		elseif($time==2) // Tuần hiện tại
		{	
			$fromdate = date("d-m-Y",strtotime('monday this week'));
			$todate= date("d-m-Y",strtotime('sunday this week'));
			

		}
		elseif($time==3) //  tháng hiện tại
		{
		    $fromdate = date("01-m-Y", strtotime("first day of this month"));
		    $todate= date("t-m-Y", strtotime("last day of this month"));
		   
		}
		elseif($time==5) // tháng trước
		{
			$fromdate = date("d-m-Y", strtotime('first day of last month'));
    		$todate= date("d-m-Y", strtotime('last day of last month'));
    		
		}
		if($location != ""){
			$data = Branch::model()->findAll($location);
			$data =  $data[0]->name;
		}else {
			$data = "tất cả văn phòng";
		}
		if($id_user != ""){
			$nhanvien =  GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3, 'id'=>$id_user));
			$nhanvien =  $nhanvien[0]->name;
		}else {
			$nhanvien = "tất cả văn phòng";
		}
		$cs = $model-> getselectspent($time, $id_user, $location, $date);
		$count = count($cs);
		$this->renderPartial('detail_report_customer_spend',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien),false,true);
	}
	/*service*/
	public function actionDetailReportService()
	{	

		$model = new Customer;
		$time = $_POST['time'];
		$id_user = $_POST['id_user'];
		$location = $_POST['location'];
		$date = $_POST['date'];
		$service = $_POST['service'];
		$group 	= $_POST['group'];
		if($time == 0)
		{
			$date1 = explode('+', $date);
			$fromdate=date("d-m-Y", strtotime($date1[0]));
			$todate=date("d-m-Y", strtotime($date1[1]));
			
		}
		elseif ($time==1) // ngày hiện tại
		{
			$fromdate = date("d-m-Y");
			$todate= "";
			
		}
		elseif($time==2) // Tuần hiện tại
		{	
			$fromdate = date("d-m-Y",strtotime('monday this week'));
			$todate= date("d-m-Y",strtotime('sunday this week'));
			

		}
		elseif($time==3) //  tháng hiện tại
		{
		    $fromdate = date("01-m-Y", strtotime("first day of this month"));
		    $todate= date("t-m-Y", strtotime("last day of this month"));
		   
		}
		elseif($time==5) // tháng trước
		{
			$fromdate = date("d-m-Y", strtotime('first day of last month'));
    		$todate= date("d-m-Y", strtotime('last day of last month'));
    		
		}
		if($location != ""){
			$data = Branch::model()->findAll($location);
			$data =  $data[0]->name;
		}else {
			$data = "tất cả văn phòng";
		}
		if($id_user != ""){
			$nhanvien =  GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3, 'id'=>$id_user));
			$nhanvien =  $nhanvien[0]->name;
		}else {
			$nhanvien = "tất cả văn phòng";
		}
		$cs = $model->getselectservice($time, $id_user, $location, $date, $service, $group);
		
		
		
		$count = count($cs);
		$this->renderPartial('detail_report_service',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien),false,true);
	}
	public function actionDetailReportNote()
	{	

		$model = new Customer;
		$time = $_POST['time'];
		$id_user = $_POST['id_user'];
		$location = $_POST['location'];
		$date = $_POST['date'];
		if($time == 0)
		{
			$date1 = explode('+', $date);
			$fromdate=date("d-m-Y", strtotime($date1[0]));
			$todate=date("d-m-Y", strtotime($date1[1]));
			
		}
		elseif ($time==1) // ngày hiện tại
		{
			$fromdate = date("d-m-Y");
			$todate= "";
			
		}
		elseif($time==2) // Tuần hiện tại
		{	
			$fromdate = date("d-m-Y",strtotime('monday this week'));
			$todate= date("d-m-Y",strtotime('sunday this week'));
			

		}
		elseif($time==3) //  tháng hiện tại
		{
		    $fromdate = date("01-m-Y", strtotime("first day of this month"));
		    $todate= date("t-m-Y", strtotime("last day of this month"));
		   
		}
		elseif($time==5) // tháng trước
		{
			$fromdate = date("d-m-Y", strtotime('first day of last month'));
    		$todate= date("d-m-Y", strtotime('last day of last month'));
    		
		}
		
		if($location != ""){
			$data = Branch::model()->findAll($location);
			$data =  $data[0]->name;
		}else {
			$data = "tất cả văn phòng";
		}
		if($id_user != ""){
			$nhanvien =  GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3, 'id'=>$id_user));
			$nhanvien =  $nhanvien[0]->name;
		}else {
			$nhanvien = "tất cả văn phòng";
		}
		$cs = $model->getSelectNote($time, $id_user, $location, $date);
		$count = count($cs);
		$this->renderPartial('detail_note',array('cs'=>$cs,'count'=>$count, 'fromdate' => $fromdate,'todate'=>$todate, 'data' => $data, 'nhanvien'=>$nhanvien),false,true);
	}
	public function actionGetService(){
		$id = $_POST['id'];

        $listdata        = array();
        $listdata['']    = "Chọn dịch vụ";
        $User         = CsService::model()->findAllByAttributes(array('id_service_type'=>$id));
        foreach($User as $temp){
            $listdata[$temp['id']] =  $temp['name'];
        }
        echo CHtml::dropDownList('frm_search_dich_vu',3,$listdata,array('onChange'=>"search_cus(this);",'class'=>'Service form-control'));
	}

}
