<?php

/**
 * This is the model class for table "v_schedule".
 *
 * The followings are the available columns in table 'v_schedule':
 * @property integer $id
 * @property integer $code_schedule
 * @property integer $id_customer
 * @property integer $code_number
 * @property string $fullname
 * @property string $phone
 * @property string $image_customer
 * @property integer $status_customer
 * @property integer $id_dentist
 * @property string $name_dentist
 * @property integer $id_author
 * @property integer $id_branch
 * @property string $name_branch
 * @property integer $id_chair
 * @property integer $id_service
 * @property string $name_service
 * @property string $code_service
 * @property integer $lenght
 * @property string $start_time
 * @property string $end_time
 * @property string $create_date
 * @property integer $status
 */
class VSchedule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_schedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code_schedule, code_number, phone, name_dentist, name_branch, name_service', 'required'),
			array('id, code_schedule, id_customer, code_number, status_customer, id_dentist, id_author, id_branch, id_chair, id_service,group_id, lenght, status', 'numerical', 'integerOnly'=>true),
			array('fullname, image_customer, name_branch, name_service', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>20),
			array('name_dentist', 'length', 'max'=>128),
			array('code_service', 'length', 'max'=>25),
			array('start_time, end_time, create_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code_schedule, id_customer, code_number, fullname, phone, image_customer, status_customer, id_dentist, name_dentist, id_author, id_branch, name_branch, id_chair, id_service, name_service, code_service, lenght, start_time, end_time, create_date, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code_schedule' => 'Code Schedule',
			'id_customer' => 'Id Customer',
			'code_number' => 'Code Number',
			'fullname' => 'Fullname',
			'phone' => 'Phone',
			'image_customer' => 'Image Customer',
			'status_customer' => 'Status Customer',
			'id_dentist' => 'Id Dentist',
			'name_dentist' => 'Name Dentist',
			'group_id'=>'Group Id',
			'id_author' => 'Id Author',
			'id_branch' => 'Id Branch',
			'name_branch' => 'Name Branch',
			'id_chair' => 'Id Chair',
			'id_service' => 'Id Service',
			'name_service' => 'Name Service',
			'code_service' => 'Code Service',
			'lenght' => 'Lenght',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'create_date' => 'Create Date',
			'status' => 'Status Schedule',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('code_schedule',$this->code_schedule);
		$criteria->compare('id_customer',$this->id_customer);
		$criteria->compare('code_number',$this->code_number);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('image_customer',$this->image_customer,true);
		$criteria->compare('status_customer',$this->status_customer);
		$criteria->compare('id_dentist',$this->id_dentist);
		$criteria->compare('name_dentist',$this->name_dentist,true);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('id_author',$this->id_author);
		$criteria->compare('id_branch',$this->id_branch);
		$criteria->compare('name_branch',$this->name_branch,true);
		$criteria->compare('id_chair',$this->id_chair);
		$criteria->compare('id_service',$this->id_service);
		$criteria->compare('name_service',$this->name_service,true);
		$criteria->compare('code_service',$this->code_service,true);
		$criteria->compare('lenght',$this->lenght);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name. 
	 * @return VSchedule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function searchAppointment($curpage,$limit,$type,$branch,$search_time,$lstUser,$fromtime="",$totime="")
    {
     	 $start_point=$limit*($curpage-1);
        $p = new VSchedule;         
        $q = new CDbCriteria(array(
        'condition'=>'published="true"'
        ));
        $v = new CDbCriteria();
        if($type==0){
        $v->addCondition('t.status >=-2');
    	}
    	elseif($type ==1)
    		{$v->addCondition('t.status =-1');}
    	elseif($type==2)
    		{$v->addCondition('t.status =-2');}
        $time = 0;

        if($search_time) {       // thời gian
            if($search_time == 1) {              // hôm nay
                $time = date('Y-m-d');
                $v->addCondition('DATE(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }
            elseif ($search_time == 2) {  //trong tuần
            	$time_fisrt = date('Y-m-d',strtotime('monday this week'));
				$time_last = date('Y-m-d',strtotime('sunday this week'));  

                $v->addCondition('DATE(create_date) >="'. $time_fisrt .'" AND DATE(create_date) <="'.$time_last.'"');
            }
            elseif($search_time == 3){                               // trong tháng 
                $time = date('m',strtotime(date('Y-m-d')));
                $v->addCondition('MONTH(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }
            elseif($search_time == 4){
            	$time = date('m',strtotime(date('Y-m-d') . ' - 1 month')); //tháng trước
                $v->addCondition('MONTH(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }elseif($search_time == 5){
            	$v->addCondition('DATE(create_date) >="'. $fromtime .'" AND DATE(create_date) <="'.$totime.'"');
            }
        }
        if($branch) {         
            $v->addCondition('id_branch ='. $branch);
        }
         if($lstUser) {         
            $v->addCondition('id_dentist ='. $lstUser);
        }

      	$count=count($p->findAll($v));

        $v->order= 'id ASC';
      
     	$v->limit = $limit;
     	$v->offset = $start_point;
        $q->mergeWith($v);      
         
        $data = $p->findAll($v);

        return array('count'=>$count,'data'=>$data);
    }

    public function searchExport_Appointment($type,$branch,$search_time,$lstUser,$fromtime="",$totime="")
    {
        $p = new VSchedule;         
        $q = new CDbCriteria(array(
        'condition'=>'published="true"'
        ));
        $v = new CDbCriteria();
        if($type==0){
        $v->addCondition('t.status >=-2');
    	}
    	elseif($type ==1)
    		{$v->addCondition('t.status =-1');}
    	elseif($type==2)
    		{$v->addCondition('t.status =-2');}
        $time = 0;

        if($search_time) {       // thời gian
            if($search_time == 1) {              // hôm nay
                $time = date('Y-m-d');
                $v->addCondition('DATE(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }
            elseif ($search_time == 2) {         // 7 ngày trước
                $time_fisrt = date('Y-m-d',strtotime('monday this week'));
				$time_last = date('Y-m-d',strtotime('sunday this week'));  

                $v->addCondition('DATE(create_date) >="'. $time_fisrt .'" AND DATE(create_date) <="'.$time_last.'"');
            }
            elseif($search_time == 3){                               // trong tháng 
                $time = date('m',strtotime(date('Y-m-d')));
                $v->addCondition('MONTH(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }
            elseif($search_time == 4){
            	$time = date('m',strtotime(date('Y-m-d') . ' - 1 month')); //tháng trước
                $v->addCondition('MONTH(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }
            elseif($search_time == 5){
            	$v->addCondition('DATE(create_date) >="'. $fromtime .'" AND DATE(create_date) <="'.$totime.'"');
            }
        }
        if($branch) {         
            $v->addCondition('id_branch ='. $branch);
        }
         if($lstUser) {         
            $v->addCondition('id_dentist ='. $lstUser);
        }

      	$count=count($p->findAll($v));

        $v->order= 'id ASC';
      
        $q->mergeWith($v);      
         
        $data = $p->findAll($v);

        return array('count'=>$count,'data'=>$data);
    }
    public function paging($page,$count,$limit,$action,$param)
	{
		$curpage = $page;
		$pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;

		$page_list = '';

		if(($curpage!=1)&&($curpage))
		{
			$page_list .= '<span onclick="'.$action.'(1,'. $param.');" style="cursor:pointer;" class="div_trang">';
			$page_list .= '<a style="color:#000000;" title="Trang đầu"><<</a></span>';
		}
		if(($curpage-1)>0)
		{
			$page_num = $curpage - 1;
			$page_list .= '<span onclick="'.$action.'('.$page_num.','.$param.');" style="cursor:pointer;" class="div_trang">';
			$page_list .= '<a style="color:#000000;" title="Về trang trước"><</a></span>';
		}				
		$vtdau=max($curpage-3,1);
		$vtcuoi=min($curpage+3,$pages);				
		for($i=$vtdau;$i<=$vtcuoi;$i++)
		{
			if($i==$curpage)
			{
				$page_list .= '<span style="background:rgba(115, 149, 158, 0.80);"  class="div_trang">'."<b style='color:#FFFFFF;'>".$i."</b></span>";
			}
			else
			{
				$page_list .= '<span onclick="'.$action.'('.$i.','.$param.');" style="cursor:pointer;" class="div_trang">';
				$page_list .= '<a style="color:#000000;" title="Trang' .$i.'">'.$i.'</a></span>';
			}
		}
		if(($curpage+1)<=$pages)
		{
			$page_list .= '<span onclick="'.$action.'('.$curpage.' + 1,'.$param.');" style="cursor:pointer;" class="div_trang"><a style="color:#000000;" title="Đến trang sau">></a></span>';
			$page_list.='<span onclick="'.$action.'('.$pages.','.$param.');" style="cursor:pointer;" class="div_trang"><a style="color:#000000;" title="Đến trang cuối">>></a></span>';
		}

		return $page_list;
	}

	//hoa don, cong no
	public function getSumInvoice($lstUser,$branch,$type_time,$fromdate,$todate)
	{
		$con = Yii::app()->db;
		$sql = "select sum(amount) as sumAmount from v_invoice_detail where 1 = 1 ";
		if ($lstUser) {
			$sql.=" and id_user=$lstUser";
		}
		if ($branch) {
			$sql.=" and id_branch=$branch";
		}
		if ($type_time) {
			if ($type_time == 1) {
				$time = date('Y-m-d');
				$sql.= " and DATE(create_date)='$time'";
			}
			else if ($type_time == 2)
			{
				$time_fisrt = date('Y-m-d',strtotime('monday this week'));
				$time_last = date('Y-m-d',strtotime('sunday this week'));
				$sql.= " and (DATE(v_schedule.`create_date`)>='$time_fisrt' and DATE(v_schedule.`create_date`)<='$time_last')";
			}
			else if ($type_time==3)
			{
				$time = date('m',strtotime(date('Y-m-d')));
				$sql.= " and MONTH(create_date)='$time'";
			}
			else if ($type_time==4)
			{
				$time = date('m',strtotime(date('Y-m-d') . ' - 1 month')); //tháng trước
	            $sql.=" and MONTH(create_date) ='$time'";
			}
			else if($type_time==5)
			{
				$sql.= " and (DATE(v_schedule.`create_date`)>='$fromdate' and DATE(v_schedule.`create_date`)<='$todate')";
			}
		}
		$data = $con->createCommand($sql)->queryAll();
		return $data[0]['sumAmount'];
	}

	
//////////////////////////////ReportingBusiness////////////////////////////

	public function reportMonth($month, $id_branch, $year){
		$data[]="";
		$i = 0;
		$totalSchedule1 	= 0;
		$NewCustomer1 		= 0;
		$totalQuotation1 	= 0;
		$sumQuotationVND1 	= 0;
		$sumQuotationUSD1 	= 0;
		$totalTreatmen1		= 0;
		$totalTreatmentComplete1 = 0;
		$totalTime1 		= 0;
		$sumOrderVND1		= 0;
		$sumOrderUSD1 		= 0;
		$sumInvoiceVND1		= 0;
		$sumInvoiceUSD1		= 0;
		$sumReceiptVND1		= 0;
		$sumReceiptUSD1	 	= 0;
		$sumBalanceVND1		= 0;
		$sumBalanceUSD1		= 0;

			foreach ($month as $v){
				$totalSchedule 		= CsSchedule::model()->getTotalSchedule($id_branch,$v,$year);
				$NewCustomer 		= VSchedule::model()->getNewCustomerByMonth($id_branch,$v,$year);
				$totalQuotation 	= VQuotations::model()->totalQuotation('count',$id_branch,$v,$year,'');
				$sumQuotationVND 	= VQuotations::model()->totalQuotation('sum',$id_branch,$v,$year,'VND');
				$sumQuotationUSD 	= VQuotations::model()->totalQuotation('sum',$id_branch,$v,$year,'USD');
				$totalTreatmen		= CsSchedule::model()->getTotalTimesCure($id_branch,"",$v,$year);
				$totalTreatmentComplete = CsSchedule::model()->getTotalTimesCure($id_branch,4,$v,$year);
				$totalTime 			= CsSchedule::model()->getTotalTimeCure($id_branch,$v,$year);
				$sumOrderVND 		= VQuotations::model()->totalOrder($id_branch,$v,$year,'VND');
				$sumOrderUSD 		= VQuotations::model()->totalOrder($id_branch,$v,$year,'USD');
				$sumInvoiceVND 		= VReceipt::model()->totalValueInvoice($id_branch,$v,$year,'VND');
				$sumInvoiceUSD 		= VReceipt::model()->totalValueInvoice($id_branch,$v,$year,'USD');
				$sumReceiptVND 		= VReceipt::model()->totalValueReceipt($id_branch,$v,$year,'VND');
				$sumReceiptUSD	 	= VReceipt::model()->totalValueReceipt($id_branch,$v,$year,'USD');
				$sumBalanceVND 		= VReceipt::model()->totalValueBalance($id_branch,$v,$year,'VND');
				$sumBalanceUSD 		= VReceipt::model()->totalValueBalance($id_branch,$v,$year,'USD');

				$data[$i] 		= array('totalSchedule'=>$totalSchedule, 'NewCustomer'=>$NewCustomer, 'totalQuotation'=>$totalQuotation[0]['totalQuotation'], 'sumQuotationVND'=>$sumQuotationVND[0]['totalSumAmount'], 'sumQuotationUSD'=>$sumQuotationUSD[0]['totalSumAmount'], 'totalTreatmen'=>$totalTreatmen, 'totalTreatmentComplete'=>$totalTreatmentComplete, 'totalTime'=>$totalTime, 'sumOrderVND'=>$sumOrderVND[0]['total'],'sumOrderUSD'=>$sumOrderUSD[0]['total'], 'sumInvoiceVND'=>$sumInvoiceVND,'sumInvoiceUSD'=>$sumInvoiceUSD, 'sumReceiptVND'=>$sumReceiptVND, 'sumReceiptUSD'=>$sumReceiptUSD, 'sumBalanceVND'=>$sumBalanceVND, 'sumBalanceUSD'=>$sumBalanceUSD);
				$totalSchedule1 	+= $totalSchedule;
				$NewCustomer1 		+= $NewCustomer;
				$totalQuotation1 	+= $totalQuotation[0]['totalQuotation'];
				$sumQuotationVND1 	+= $sumQuotationVND[0]['totalSumAmount'];
				$sumQuotationUSD1 	+= $sumQuotationUSD[0]['totalSumAmount'];
				$totalTreatmen1		+= $totalTreatmen;
				$totalTreatmentComplete1 += $totalTreatmentComplete;
				$totalTime1 		+= $totalTime;
				$sumOrderVND1		+= $sumOrderVND[0]['total'];
				$sumOrderUSD1 		+= $sumOrderUSD[0]['total'];
				$sumInvoiceVND1		+= $sumInvoiceVND;
				$sumInvoiceUSD1		+= $sumInvoiceUSD;
				$sumReceiptVND1		+= $sumReceiptVND;
				$sumReceiptUSD1	 	+= $sumReceiptUSD;
				$sumBalanceVND1		+= $sumBalanceVND;
				$sumBalanceUSD1		+= $sumBalanceUSD;
				$i++;
			}
			$data[$i] 		= array('totalSchedule'=>$totalSchedule1, 'NewCustomer'=>$NewCustomer1, 'totalQuotation'=>$totalQuotation1, 'sumQuotationVND'=>$sumQuotationVND1, 'sumQuotationUSD'=>$sumQuotationUSD1, 'totalTreatmen'=>$totalTreatmen1, 'totalTreatmentComplete'=>$totalTreatmentComplete1, 'totalTime'=>$totalTime1, 'sumOrderVND'=>$sumOrderVND1,'sumOrderUSD'=>$sumOrderUSD1, 'sumInvoiceVND'=>$sumInvoiceVND1,'sumInvoiceUSD'=>$sumInvoiceUSD1, 'sumReceiptVND'=>$sumReceiptVND1, 'sumReceiptUSD'=>$sumReceiptUSD1, 'sumBalanceVND'=>$sumBalanceVND1, 'sumBalanceUSD'=>$sumBalanceUSD1);
		return $data;
	}

	public function getLstStaffBussiess($lstUser,$branch,$type_time,$fromdate,$todate){
		$data[]="";
		if ($lstUser) {
			//lấy tên bác sĩ
			if ($branch) {
				$ListUser = GpUsers::model()->findAllByAttributes(array('id'=>$lstUser,'block'=>0,'group_id'=>3,'id_branch'=>$branch));
			}
			else{
				$ListUser = GpUsers::model()->findAllByAttributes(array('id'=>$lstUser,'block'=>0,'group_id'=>3));
			}
		}
		else{
			if ($branch) {
				$ListUser = GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3,'id_branch'=>$branch));
			}
			else{
				$ListUser = GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3));
			}
		}
		$i 				= 0;
		$total1 		= 0;
		$totalNew1 		= 0;
		$completed1 	= 0;
       	$leaving1 		= 0;
       	$online1 		= 0;
       	$totalOrder1 	= 0;
       	$totalOrderUSD1 = 0;
       	$totalInvoice1  = 0;
       	$totalInvoiceUSD1  = 0;
       	$totalDiscount1    = 0;
       	$totalDiscountUSD1 = 0;
       	$totalBalance1	   = 0;
       	$totalBalanceUSD1  = 0;
		foreach ($ListUser as $value) {
			$total = VSchedule::model()->getTotalCustomer($value['id'],"","",$fromdate,$todate); //khong id_branch, khong type_time
			$totalNew = VSchedule::model()->getTotalCustomer($value['id'],$branch,$type_time,$fromdate,$todate,''); // sua $value['id_branch'] thanh $branch
			$completed = VSchedule::model()->countStatusSchedule($value['id'],$branch,$type_time,4,$fromdate,$todate,'');// sua $value['id_branch'] thanh $branch
           	$leaving = VSchedule::model()->countStatusSchedule($value['id'],$branch,$type_time,"-1",$fromdate,$todate,'');// sua $value['id_branch'] thanh $branch
           	$online = VSchedule::model()->countStatusSchedule($value['id'],$branch,$type_time,"",$fromdate,$todate,'1');
           	$totalOrder = VSchedule::model()->getTotalOrder($value['id'],$branch,$type_time,$fromdate,$todate,'VND');
           	$totalOrderUSD = VSchedule::model()->getTotalOrder($value['id'],$branch,$type_time,$fromdate,$todate,'USD');
           	$totalInvoice = VSchedule::model()->getTotalInvoice($value['id'],$branch,$type_time,$fromdate,$todate,'VND');
           	$totalInvoiceUSD = VSchedule::model()->getTotalInvoice($value['id'],$branch,$type_time,$fromdate,$todate,'USD');
           	$totalDiscount = VSchedule::model()->getTotalDiscount($value['id'],$branch,$type_time,$fromdate,$todate,'VND');

           	$totalDiscountUSD = VSchedule::model()->getTotalDiscount($value['id'],$branch,$type_time,$fromdate,$todate,'USD');
           	$totalBalance = VSchedule::model()->getTotalBalance($value['id'],$branch,$type_time,$fromdate,$todate,'VND');

           	$totalBalanceUSD = VSchedule::model()->getTotalBalance($value['id'],$branch,$type_time,$fromdate,$todate,'USD');

			$data[$i] = array('name'=>$value['name'],'total'=>$total,'totalNew'=>$totalNew,'online'=>$online,'completed'=>$completed,"leaving"=>$leaving,'totalOrder'=>$totalOrder, 'totalOrderUSD'=>$totalOrderUSD,'totalInvoice'=> $totalInvoice, 'totalInvoiceUSD'=>$totalInvoiceUSD, 'totalDiscount'=>$totalDiscount,'totalDiscountUSD'=>$totalDiscountUSD, 'totalBalance'=>$totalBalance,'totalBalanceUSD'=>$totalBalanceUSD);
			$total1 		+= $total;
			$totalNew1		+= $totalNew;
			$completed1		+= $completed;
	       	$leaving1		+= $leaving ;
	       	$online1		+= $online;
	       	$totalOrder1 	+= $totalOrder;
       		$totalOrderUSD1 += $totalOrderUSD;
       		$totalInvoice1 	+= $totalInvoice;
       		$totalInvoiceUSD1 	+= $totalInvoiceUSD;
       		$totalDiscount1		+= $totalDiscount;
       		$totalDiscountUSD1	+= $totalDiscountUSD;
       		$totalBalance1		+= $totalBalance;
       		$totalBalanceUSD1	+= $totalBalanceUSD;

			$i++;
		}
		$data[$i] = array('name'=>'Tổng','total'=>$total1,'totalNew'=>$totalNew1,'completed'=>$completed1,"leaving"=>$leaving1,'online'=>$online1,'totalOrder'=>$totalOrder1, 'totalOrderUSD'=>$totalOrderUSD1, 'totalInvoice'=>$totalInvoice1,'totalInvoiceUSD'=>$totalInvoiceUSD1, 'totalDiscount'=>$totalDiscount1,'totalDiscountUSD'=>$totalDiscountUSD1, 'totalBalance'=>$totalBalance1,'totalBalanceUSD'=>$totalBalanceUSD1 );
		return $data;
		
	}
	public function getTotalCustomer($lstUser,$branch,$type_time,$fromdate,$todate)
	{
		
		$con = Yii::app()->db;
		$sql = "select count(*) as totalCus from v_schedule where 1 = 1 and group_id =3";
		if ($lstUser) {
			$sql.=" and id_dentist=$lstUser";
		}
		if ($branch) {
			$sql.=" and id_branch=$branch";
		}
		if ($type_time) {
			if ($type_time == 1) {
				$time = date('Y-m-d');
				$sql.= " and DATE(create_date)='$time'";
			}
			else if ($type_time == 2)
			{
				$time_fisrt = date('Y-m-d',strtotime('monday this week'));
				$time_last = date('Y-m-d',strtotime('sunday this week'));
				$sql.= " and (DATE(v_schedule.`create_date`)>='$time_fisrt' and DATE(v_schedule.`create_date`)<='$time_last')";
			}
			else if ($type_time==3)
			{
				$time = date('m',strtotime(date('Y-m-d')));
				$sql.= " and MONTH(create_date)='$time'";
			}
			else if ($type_time==4)
			{
				$time = date('m',strtotime(date('Y-m-d') . ' - 1 month')); //tháng trước
	            $sql.=" and MONTH(create_date) ='$time'";
			}
			else if($type_time==5)
			{
				$sql.= " and (DATE(v_schedule.`create_date`)>='$fromdate' and DATE(v_schedule.`create_date`)<='$todate')";
			}
		}
		$data = $con->createCommand($sql)->queryAll();
		return $data[0]['totalCus'];
	}
	public function countStatusSchedule($lstUser,$branch,$type_time,$status,$fromdate,$todate,$source)
	{
		$con = Yii::app()->db;
		$sql = "select count(v_schedule.code_schedule) as status from v_schedule where 1 = 1 and group_id =3 ";
		if ($status) {
			$sql.=" and status=$status";
		}
		if ($lstUser) {
			$sql.=" and id_dentist=$lstUser";
		}
		if ($branch) {
			$sql.=" and id_branch=$branch";
		}
		if ($source) {
			$sql.=" and source > 0";
		}
		if ($type_time) {
			if ($type_time == 1) {
				$time = date('Y-m-d');
				$sql.= " and DATE(create_date)='$time'";
			}
			else if ($type_time == 2)
			{
				$time_fisrt = date('Y-m-d',strtotime('monday this week'));
				$time_last = date('Y-m-d',strtotime('sunday this week'));
				$sql.= " and (DATE(v_schedule.`create_date`)>='$time_fisrt' and DATE(v_schedule.`create_date`)<='$time_last')";
			}
			else if ($type_time==3)
			{
				$time = date('m',strtotime(date('Y-m-d')));
				$sql.= " and MONTH(create_date)='$time'";
			}
			else if ($type_time==4)
			{
				$time = date('m',strtotime(date('Y-m-d') . ' - 1 month')); //tháng trước
	            $sql.=" and MONTH(create_date) ='$time'";
			}
			else if($type_time==5)
			{
				$sql.= " and (DATE(v_schedule.`create_date`)>='$fromdate' and DATE(v_schedule.`create_date`)<='$todate')";
			}		
		}
		
		$data = $con->createCommand($sql)->queryAll();
		return $data[0]['status'];
	}
	public function getNewCustomerByMonth($branch,$month,$year){ 
		$con = Yii::app()->db;
		$sql = "select count(id_customer) as totalCus from v_schedule where 1 = 1";
		if ($branch) {
			$sql.=" and id_branch=$branch";
		}
		if($month && $year){
			$sql.= " and (month(v_schedule.`create_date`)='$month' and year(v_schedule.`create_date`)='$year')";
		}
		
		$data = $con->createCommand($sql)->queryAll();
		if ($data) {
			return $data[0]['totalCus'];
		}
		else
			return 0;
	}
	public function getTotalTimeCure($lstUser,$branch,$type_time,$to_date)
	{
		$con = Yii::app()->db;
		$sql = "select SUM(TIME_TO_SEC(TIMEDIFF(end_time,start_time))/60/60) as totalTime from cs_schedule where 1 = 1 and (status=3 or status=4)";
		if ($lstUser) {
			$sql.=" and id_dentist=$lstUser";
		}
		if ($branch) {
			$sql.=" and id_branch=$branch";
		}
		if ($type_time) {
			if ($type_time == 1) {
				$time = date('Y-m-d');
				$sql.= " and DATE(create_date)=$time";
			}
			else if ($type_time == 2)
			{
				$time_fisrt = date('Y-m-d',strtotime('monday this week'));
				$time_last = date('Y-m-d',strtotime('sunday this week'));
				$sql.= " and (DATE(v_schedule.`create_date`)>='$time_fisrt' and DATE(v_schedule.`create_date`)<='$time_last')";
			}
			else if ($type_time==3)
			{
				$time = date('m',strtotime($to_date));
				$sql.= " and MONTH(create_date) = '$time'";
			}
			else if ($type_time==4)
			{
				$time = date('m',strtotime($to_date. ' - 1 month')); //tháng trước
	            $sql.=" and MONTH(create_date) = '$time'";
			}
		}
		
		$data = $con->createCommand($sql)->queryAll();
		if ($data) {
			return (int)$data[0]['totalTime'];
		}
		else
			return 0;
	}
//doanh số theo bán sĩ
	public function getTotalOrder($lstUser,$branch,$type_time,$fromdate,$todate,$currency_use)
	{
		
		$con = Yii::app()->db;
		$sql = "select sum(amount) as total from v_order_detail where 1 = 1 ";
		if ($lstUser) {
			$sql.=" and id_user=$lstUser";
		}
		if ($branch) {
			$sql.=" and id_branch=$branch";
		}
		if($currency_use){
			$sql.=" and currency_use = '$currency_use'";
		}
		if ($type_time) {
			if ($type_time == 1) {
				$time = date('Y-m-d');
				$sql.= " and DATE(create_date)='$time'";
			}
			else if ($type_time == 2)
			{
				$time_fisrt = date('Y-m-d',strtotime('monday this week'));
				$time_last = date('Y-m-d',strtotime('sunday this week'));
				$sql.= " and (DATE(v_order_detail.`create_date`)>='$time_fisrt' and DATE(v_order_detail.`create_date`)<='$time_last')";
			}
			else if ($type_time==3)
			{
				$time = date('m',strtotime(date('Y-m-d')));
				$sql.= " and MONTH(create_date)='$time'";
			}
			else if ($type_time==4)
			{
				$time = date('m',strtotime(date('Y-m-d') . ' - 1 month')); //tháng trước
	            $sql.=" and MONTH(create_date) ='$time'";
			}
			else if($type_time==5)
			{
				$sql.= " and (DATE(v_order_detail.`create_date`)>='$fromdate' and DATE(v_order_detail.`create_date`)<='$todate')";
			}
		}
		$data = $con->createCommand($sql)->queryAll();
		return $data[0]['total'];
	} 
	// thống kê hóa đơn theo bác sĩ 
	public function getTotalInvoice($lstUser,$branch,$type_time,$fromdate,$todate,$currency_use)
	{
		$con = Yii::app()->db;
		$sql = "select sum(amount) as total from v_invoice_detail where 1 = 1 ";
		if ($lstUser) {
			$sql.=" and id_user=$lstUser";
		}
		if ($branch) {
			$sql.=" and id_branch=$branch";
		}
		if($currency_use){
			$sql.=" and currency_use = '$currency_use'";
		}
		if ($type_time) {
			if ($type_time == 1) {
				$time = date('Y-m-d');
				$sql.= " and DATE(create_date)='$time'";
			}
			else if ($type_time == 2)
			{
				$time_fisrt = date('Y-m-d',strtotime('monday this week'));
				$time_last = date('Y-m-d',strtotime('sunday this week'));
				$sql.= " and (DATE(v_invoice_detail.`create_date`)>='$time_fisrt' and DATE(v_invoice_detail.`create_date`)<='$time_last')";
			}
			else if ($type_time==3)
			{
				$time = date('m',strtotime(date('Y-m-d')));
				$sql.= " and MONTH(create_date)='$time'";
			}
			else if ($type_time==4)
			{
				$time = date('m',strtotime(date('Y-m-d') . ' - 1 month')); //tháng trước
	            $sql.=" and MONTH(create_date) ='$time'";
			}
			else if($type_time==5)
			{
				$sql.= " and (DATE(v_invoice_detail.`create_date`)>='$fromdate' and DATE(v_invoice_detail.`create_date`)<='$todate')";
			}
		}
		$data = $con->createCommand($sql)->queryAll();
		return $data[0]['total'];
	} 

	//Thống kê khuyến mãi theo bác sĩ
	public function getTotalDiscount($lstUser,$branch,$type_time,$fromdate,$todate,$currency_use)
	{
		$con = Yii::app()->db;
		$sql = "select abs(sum(amount)) as total from v_invoice_detail where id_discount >0 ";
		if ($lstUser) {
			$sql.=" and id_user=$lstUser";
		}
		if ($branch) {
			$sql.=" and id_branch=$branch";
		}
		if($currency_use){
			$sql.=" and currency_use = '$currency_use'";
		}
		if ($type_time) {
			if ($type_time == 1) {
				$time = date('Y-m-d');
				$sql.= " and DATE(create_date)='$time'";
			}
			else if ($type_time == 2)
			{
				$time_fisrt = date('Y-m-d',strtotime('monday this week'));
				$time_last = date('Y-m-d',strtotime('sunday this week'));
				$sql.= " and (DATE(v_invoice_detail.`create_date`)>='$time_fisrt' and DATE(v_invoice_detail.`create_date`)<='$time_last')";
			}
			else if ($type_time==3)
			{
				$time = date('m',strtotime(date('Y-m-d')));
				$sql.= " and MONTH(create_date)='$time'";
			}
			else if ($type_time==4)
			{
				$time = date('m',strtotime(date('Y-m-d') . ' - 1 month')); //tháng trước
	            $sql.=" and MONTH(create_date) ='$time'";
			}
			else if($type_time==5)
			{
				$sql.= " and (DATE(v_invoice_detail.`create_date`)>='$fromdate' and DATE(v_invoice_detail.`create_date`)<='$todate')";
			}
		}
		$data = $con->createCommand($sql)->queryAll();
		return $data[0]['total'];
	} 
	//thống kê công nợ theo bác sĩ
	public function getTotalBalance($lstUser,$branch,$type_time,$fromdate,$todate,$currency_use)
	{
		$con = Yii::app()->db;
		$sql="select SUM(DISTINCT v_invoice.`balance`) AS total FROM (v_invoice JOIN v_invoice_detail ON v_invoice.`id`= v_invoice_detail.`id_invoice`) WHERE 1=1";
		if ($lstUser) {
			$sql.=" and v_invoice_detail.`id_user`=$lstUser";
		}
		if ($branch) {
			$sql.=" and v_invoice_detail.`id_branch`=$branch";
		}
		if($currency_use){
			$sql.=" and v_invoice.`currency_use` = '$currency_use'";
		}
		if ($type_time) {
			if ($type_time == 1) {
				$time = date('Y-m-d');
				$sql.= " and DATE(v_invoice_detail.`create_date`)='$time'";
			}
			else if ($type_time == 2)
			{
				$time_fisrt = date('Y-m-d',strtotime('monday this week'));
				$time_last = date('Y-m-d',strtotime('sunday this week'));
				$sql.= " and (DATE(v_invoice_detail.`create_date`)>='$time_fisrt' and DATE(v_invoice_detail.`create_date`)<='$time_last')";
			}
			else if ($type_time==3)
			{
				$time = date('m',strtotime(date('Y-m-d')));
				$sql.= " and MONTH(v_invoice_detail.`create_date`) = '$time'";
			}
			else if ($type_time==4)
			{
				$time = date('m',strtotime(date('Y-m-d'). ' - 1 month')); //tháng trước
	            $sql.=" and MONTH(v_invoice_detail.`create_date`) = '$time'";
			}
			else if($type_time==5)
			{
				$sql.= " and (DATE(v_invoice_detail.`create_date`)>='$fromdate' and DATE(v_invoice_detail.`create_date`)<='$todate')";
			}
		}
		$data = $con->createCommand($sql)->queryAll();
		
		return $data[0]['total'];
		
	}
	

}
